<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
     /**
     * Dashboard constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application backend dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        //return view('home');

       // dd("in admin index fun");
       // return view('backend.auth.login');
       try {
        return view('backend.dashboard.dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
