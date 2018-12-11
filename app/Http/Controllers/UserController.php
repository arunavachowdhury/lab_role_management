<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\User;
use Session;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index')->with(['users'=> User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'name'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            // 'usertype'=> 'required'
        ];
        $this->validate($request, $rules);
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            // 'usertype'=> $request->usertype
        ]);
        return route('user.show')->with('user', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show')->with('user', $user);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function makeTechnician($id)
    {
        if(Auth::user()->id == $id)
        {
            Session::flash('error', "An admin could not change himself as an Technician");
            return redirect()->back();
        }
        $user = User::findOrFail($id);
        $user->usertype = User::USER_TECHNICIAN;
        $user->save();
        return redirect()->back();
    }

    public function makeEmployee($id)
    {
        if(Auth::user()->id == $id)
        {
            Session::flash('error', "An admin could not change himself as an Employee");
            return redirect()->back();
        }
        $user = User::findOrFail($id);
        $user->usertype = User::USER_EMPLOYEE;
        $user->save();
        return redirect()->back();
    }
   
}
