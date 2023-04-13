<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    // /**
    //  * @var $roleRepository
    //  */
    // protected $roleRepository;

    // /**
    //  * @param RoleRepository $roleRepository
    //  */
    // public function __construct(RoleRepository $roleRepository)
    // {
    //     $this->roleRepository = $roleRepository;
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
           $roles = Role::all();
           //$roles = $this->roleRepository->index();
            return view('backend.roles.index',compact('roles'));
         } catch(Exception $e) {
            Log::info($e->getMessage());
         }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$permission = Permission::get();
       // dd($permission);
        $permissions = Permission::pluck('name','name')->all();
        return view('backend.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permissions' => 'required',
            ]);

            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));

            return redirect()->route('backend.roles.index')
                            ->with('success','Role created successfully');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            //dd("fggggggg");
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
        $role = Role::find($id);
        // $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        //     ->where("role_has_permissions.role_id",$id)
        //     ->pluck('permissions.name','permissions.name')
        //     ->get(); //not working with get
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->pluck('permissions.name','permissions.name')
            ->all();
           // dd($role);
            //dd($rolePermissions);
        return view('backend.roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        //$permissions = Permission::get();
        $permissions = Permission::pluck('name','id')->all();
        //dd($permissions);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        //dd($rolePermissions);
        return view('backend.roles.edit',compact('role','permissions','rolePermissions'));
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
        //dd($request);
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('backend.roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('backend.roles.index')
                        ->with('success','Role deleted successfully');
    }
}
