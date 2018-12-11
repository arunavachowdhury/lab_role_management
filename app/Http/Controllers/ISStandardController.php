<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ISStandard;
use App\Sample;
use Session;
use Illuminate\Support\Facades\DB;

class ISStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('isstandard.index')->with(['samples' => ISStandard::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Sample::all()->count() == 0) {
            Session::flash('error', 'You need a Sample/Product to add an IS Standard');
            return redirect()->route('sample.create');
        }
        return view('isstandard.create')->with(['samples' => Sample::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'value' => 'required',
            'sample_id' => 'required'
        ];

        $this->validate($request, $rule);

        $isstandard = ISStandard::create([
            'value' => $request->value,
            'sample_id' => $request->sample_id
        ]);
        
        // dd($isstandard);
        return redirect()->route('sample.show', ['id' => $isstandard->sample_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
// 
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
}
