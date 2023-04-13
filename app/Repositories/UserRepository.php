<?php

namespace App\Repositories;

use App\Repositories\Core\Repository;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;



class UserRepository extends Repository
{
    /**
     * @var $user
     */
    //protected $user;

    /**
     * @param User $user
     */
    // public function __construct(User $user)
    // {
    //     //$this->user = $user;
    // }


    public function __construct()
    {
        $this->model = config('model-variables.models.user.class');
    }

     /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        try {
            //$users = $this->user->all();
            //$users = $this->model->all();//not working
            
            //$users = $this->model::all()->toArray();//working
            //$all_users_with_all_their_roles = User::with('roles')->get();
            $users = $this->model::with('roles')->get()->toArray();
           // dd($users);
            return $users;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

     /**
     * storing of the resource.
     *
     * @return
     */
    public function store(array $data)
    {
        try {
            $user = $this->model::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->assignRole($data['roles']);
            return $user;
        } catch (Exception $e) {
            Log::info($e->getMessage());
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
        try {
            $user = $this->model::find($id);
            return $user;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * editing of the resource.
     *
     * @return 
     */
    public function edit(int $id)
    {
        try {
            $user = $this->model::find($id);
            // $roles = Role::pluck('name','name')->all();
            // $userRole = $user->roles->pluck('name','name')->all();


            // return view('users.edit',compact('user','roles','userRole'));
            return $user;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * upadting of the resource.
     *
     * @return
     */
    public function update(array $data,$id)
    {
        try {
            $user = $this->model::find($id);
           // $user->update($data);
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                //'password' => Hash::make($data['password']),
            ]);
            //way 1
             // DB::table('model_has_roles')->where('model_id',$id)->delete();
            // $user->assignRole($request->input('roles'));
            //way 2
            $user->syncRoles($data['roles']);
           
           // return $user;
        } catch (Exception $e) {
           
            Log::info($e->getMessage());
            dd("user upadte repo");
        }
    }

     /**
     * destroying of the resource.
     *
     * @return 
     */
    public function destroy(int $id)
    {
        try {
            $user = $this->model::find($id)->delete();
            return $user;
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}



