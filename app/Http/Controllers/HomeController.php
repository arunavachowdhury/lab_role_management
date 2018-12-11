<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * 
     */
    public function home() {
        if(Auth::check()) {
           return redirect()->route('dashboard');
        }
        return view('welcome');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $drafts = DB::table('tests')
        ->where('status', 'draft')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        $registereds = DB::table('tests')
        ->where('status', 'registered')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        $myTests = Auth::user()
                        ->jobs()
                        ->with('test')
                        ->get()
                        ->pluck('test')
                        ->unique('id')
                        ->values();
        // dd($myJobs);
        return view('includes.dashboard')
                    ->with(['drafts' => $drafts])
                    ->with(['registereds' => $registereds])
                    ->with(['myTests' => $myTests]);
    }
}
