<?php

namespace App\Http\Controllers\v4\Akun;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\users;
use App\Models\roles;
use App\Models\permissions;
use App\Models\model_has_roles;
use App\Models\role_has_permissions;
use Redirect;
use Carbon\Carbon;
use Auth;

class AksesJabatanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->can('akses_jabatan') || $user->hasRole('karu-it')) {
            return view('pages.v4.akun.aksesjabatan.index');
        }

        abort(403);
    }

    // public function getRolePermission()
    // {
    //     $role = roles::where('name','<>','administrator')
    //                 ->orderBy('updated_at','desc')
    //                 ->get();

    //     $permissions = permissions::orderBy('updated_at','desc')->get();

    //     return response()->json([
    //         'role' => $role,
    //         'permissions' => $permissions,
    //     ],200);
    // }

    function getAkses($id)
    {
        $role = Role::findOrFail($id);

        return response()->json(
            $role->permissions()->select('id','name')->get()
        );
    }

    function storeAksesJabatan(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $role = Role::findOrFail($request->jabatan);

        // ambil permission berdasarkan ID
        $permissions = Permission::whereIn('id', $request->akses)->get();

        $role->syncPermissions($permissions);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

    function storeAkses(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        Permission::create([
            'name' => $request->akses,
            'guard_name' => 'web'
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

    function storeJabatan(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        Role::create([
            'name' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'guard_name' => 'web'
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

    // API
    function table() // Tabel Utama
    {
        $roles = Role::where('name','<>','administrator')
            ->with([
                'permissions:id,name',
                'users:id,name,nama',
                'users.foto:id,user_id,filename'
            ])
            ->orderBy('updated_at','desc')
            ->get([
                'id',
                'name',
                'deskripsi',
                'guard_name',
                'created_at',
                'updated_at'
            ]);

        return response()->json($roles, 200);
    }

    function tableAkses()
    {
        $show = permissions::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tableJabatan()
    {
        $show = roles::where('name', '<>','administrator')->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function hapusAkses($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $perm = Permission::findOrFail($id);
        $perm->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

    function hapusJabatan($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

    function hapusAksesJabatan($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $role = Role::findOrFail($id);
        $role->syncPermissions([]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

}
