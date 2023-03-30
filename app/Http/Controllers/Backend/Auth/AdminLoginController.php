<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
     /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('guest');
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): View
    {
        //dd("lllll");
       // return view('backend.auth.login');
        try {
            return view('backend.auth.login');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //$roles = empty($user->roles) ? [null] : $user->roles;

        // foreach ($roles as $role) {
        //     dd($role->name);
        // }
        // if (empty($user->roles)) {
        //     auth()->logout();
        // }
       
       // return redirect('/backend/login');
       //--------------------------------------------------------------
        if (($user->roles->isEmpty())) {
           //dd("empty role");
            auth()->logout();
           // return redirect(RouteServiceProvider::ADMIN);
           //return redirect('/backend/login')->with('fail', 'You have not access to login!');
           return redirect('/backend/login')->with('info','You have not access to login!');
          //return redirect()->route('backend.adminlogin')->with('info','You have not access to login!'); //return with route anme

        }
        // else {
        //     dd("had role");
        // }
    }

    // /**
    //  * The user has logged out of the application.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return mixed
    //  */
    // protected function loggedOut(Request $request)
    // {
    //     return view('backend.auth.login');
    // }


      /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        

        return $request->wantsJson()
           ? new JsonResponse([], 204)
           : redirect('/backend/login');

           // return $request->wantsJson()
        // ? new JsonResponse([], 204)
        // : redirect('/');

    }

}
