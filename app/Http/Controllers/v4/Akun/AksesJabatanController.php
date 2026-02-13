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


    function store(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $role = Role::findOrFail($request->jabatan);
        $role->syncPermissions($request->akses);

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
            'guard_name' => 'web'
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

    // API
    function table() // Tabel Utama
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $permission = permissions::orderBy('name','asc')->get();
        $show = role_has_permissions::select('role_id','roles.name')
                ->join('roles','roles.id','=','role_has_permissions.role_id')
                ->groupBy('role_id','roles.name')
                ->orderBy('roles.name')
                ->get();
        $selection = role_has_permissions::join('permissions','permissions.id','=','role_has_permissions.permission_id')
                ->join('roles','roles.id','=','role_has_permissions.role_id')
                ->select('roles.id as id_role','permissions.id as id_permission','permissions.name as name_permission','role_has_permissions.*')
                ->get();

        $data = [
            'role' => $role,
            'permission' => $permission,
            'selection' => $selection,
            'show' => $show
        ];

        return response()->json($data, 200);
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
        $show = roles::get();

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

    function destroy($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $role = Role::findOrFail($id);
        $role->syncPermissions([]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json($tgl, 200);
    }

}
