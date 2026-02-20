<?php

namespace App\Http\Controllers\v4\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\roles;
use App\Models\model_has_roles;
use Carbon\Carbon;
use Auth, Redirect;

class AkunPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->can('akun_pengguna') || $user->hasRole('karu-it')) {
            return view('pages.v4.akun.akunpengguna.index');
        }

        abort(403);
    }

    function get()
    {
        $user = User::with('roles')
                    ->select('id','name','nip','nama','nama_lengkap','email','updated_at')
                    ->whereNotIn('name',['admin','it','demo'])
                    ->whereNull('deleted_at')
                    ->whereNull('status')
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return response()->json($user, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = roles::where('name', '<>','administrator')->get();

        return view('pages.v4.akun.akunpengguna.tambah')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255|unique:users,name,NULL,id,deleted_at,NULL',
            'email'    => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|min:8',
            'role'     => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

            // ✅ CREATE USER
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
            ]);

            // ✅ ASSIGN ROLE (Spatie)
            $roles = Role::whereIn('id', $request->role)->pluck('name');
            $user->assignRole($roles);

            DB::commit();

            app(PermissionRegistrar::class)->forgetCachedPermissions();

            return response()->json([
                'message' => 'Akun pengguna berhasil dibuat',
                'time'    => $tgl
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menyimpan data: '.$e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('roles')
                    ->select('id','nip','name','nama','nama_lengkap','email')
                    ->where('id', $id)
                    ->whereNull('deleted_at')
                    ->whereNull('status')
                    ->first();

        $roles = roles::where('name', '<>','administrator')->get();

        if ($roles->isEmpty()) {
            return response()->json([
                'message' => 'Roles tidak ditemukan'
            ], 404);
        }

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json(['user' => $user, 'roles' => $roles], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        // ✅ VALIDATION
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255|unique:users,name,'.$id.',id,deleted_at,NULL',
            'email' => 'required|email|max:255|unique:users,email,'.$id.',id,deleted_at,NULL',
            'password' => 'nullable|min:8',
            'role'  => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

            $user->name  = $request->name;
            $user->email = $request->email;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // ✅ Sync Roles (otomatis hapus lama + insert baru)
            $roles = Role::whereIn('id', $request->role)->pluck('name');
            $user->syncRoles($roles);

            DB::commit();

            app(PermissionRegistrar::class)->forgetCachedPermissions();

            return response()->json([
                'message' => 'Akun berhasil diperbarui',
                'time'    => $tgl
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal memperbarui data: '.$e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan pada database'
            ], 404);
        }

        DB::beginTransaction();

        try {

            $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

            // Update metadata
            $user->status = 1;
            $user->user_hapus = Auth::id();
            $user->save();

            // ✅ Lepas semua role (cara resmi)
            $user->syncRoles([]);

            // Soft delete
            $user->delete();

            DB::commit();

            app(PermissionRegistrar::class)->forgetCachedPermissions();

            return response()->json([
                'message' => 'Penghapusan User berhasil dan Jabatan berhasil ditangguhkan',
                'time'    => $tgl
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Gagal menghapus user, silakan ulangi sekali lagi'
            ], 500);
        }
    }

    // API
    public function verifName($name)
    {
        $data = User::where('name',$name)->first();

        if (!empty($data)) {
            $retur = 1;
        } else {
            $retur = 0;
        }

        return response()->json($retur, 200);
    }
}
