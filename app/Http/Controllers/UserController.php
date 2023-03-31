<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Exception;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Contracts\View\View;
//use Illuminate\Support\Facades\View;

//use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
           $users = $this->userRepository->index();
            return view('backend.users.index',compact('users'));
          //  return View::make('backend.users.index')->with('users', $users); //also working
        } catch(Exception $e){
            dd('user index catche');
            return view('backend.users.index');
        }
        //return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checkRole = Auth::user()->hasRole('Super-Admin') ? true : null;
        if($checkRole) {
            $roles = Role::pluck('name','name')->all();
            return view('backend.users.create',compact('roles'));
        } else {
            return redirect()->route('backend.users.index')->with('info',"Your role doesn't enough to create user");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $this->userRepository->store($request->all());
            //dd("in cont");
            return redirect()->route('backend.users.index')->with('success','User created successfully');
           //return View::make('backend.users.index')->with('users', $users); //also working
         } catch(Exception $e){
            dd('user store catche');
             return view('backend.users.index');
         }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->show($id);
            return view('backend.users.show',compact('user'));
        } catch(Exception $e){
            dd('user contro delete catche');
            return view('backend.users.index')->with('error','Something went wrong');
        }
        // $user = User::find($id);
        // return view('backend.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkRole = Auth::user()->hasRole('Super-Admin') ? true : null;
        if($checkRole) {
            try {
                $user = $this->userRepository->edit($id);
                $roles = Role::pluck('name','name')->all();
                $userRole = $user->roles->pluck('name','name')->all();
                return view('backend.users.edit',compact('user','roles','userRole'));
            }
            catch(Exception $e){
                dd('user edit catche');
                return view('backend.users.index');
            }
        } else {
            return redirect()->route('backend.users.index')->with('info',"Your role doesn't enough to edit user");
        }
        // return view('backend.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $this->userRepository->update($request->all(),$id);
            return redirect()->route('backend.users.index')->with('success','User updated successfully');
        } catch(Exception $e){
            dd('user contro store catche');
             return view('backend.users.index')->with('error','Something went wrong');
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
        $checkRole = Auth::user()->hasRole('Super-Admin') ? true : null;
        if($checkRole) {
            try {
                $this->userRepository->destroy($id);
                return redirect()->route('backend.users.index')->with('success','User deleted successfully');
            } catch(Exception $e){
                dd('user contro delete catche');
                return view('backend.users.index')->with('error','Something went wrong');
            }
        } else {
            return redirect()->route('backend.users.index')->with('info',"Your role doesn't enough to destroy user");
        }
    }
}
//laarvel debugger?
