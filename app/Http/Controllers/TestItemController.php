<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sample;
use App\Uom;
use App\TestItem;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

class TestItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Uom::all()->count() == 0) {
            Session::flash('error', 'You need a Unit of Measurement to add an Test Item');
            return redirect()->route('uom.create');
        }
        return view('testitem.create')->with(['samples' => Sample::all()])->with(['uoms' => Uom::all()]);
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
        
        $rule = [
            'name' => 'required',
            'sample_id' => 'required',
            'isstandard_id' => 'required',
            'uom_id' => 'required',
            'price' => 'required|integer',
            'specified_range_from' => 'required',
            'specified_range_to' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rule);

        // dd($request);

        $data = $request->all();

        // dd($data);

        $testItem = TestItem::create($data);

        return redirect()->route('sample.show', ['id' => $data['sample_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testItem = TestItem::findOrfail($id)->with('uom')->get();

        return response()->json(['data' => $testItem]);
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

    /**
     * gives test items for sample and is_standards
     * @param Request $request
     * 
     * @return array
     */
    public function getTestItemsQuery(Request $request) {
        $rules = [
            'sample_id' => 'required',
            'isstandard_id' => 'required'
        ];
        $this->validate($request, $rules);

        if($request->has('sample_id') && $request->has('isstandard_id'))
        {
            $testItems = DB::table('test_items')->where('sample_id', $request->sample_id)->where('isstandard_id', $request->isstandard_id)->get(); 
            
            if(empty($testItems)) {
                return response()->json(['data' => '', 'code' => 404]);
            } else {
                return response()->json(['data' => $testItems]);
            }
        } else {
            return response()->json(['data' => '', 'code' => 404]); 
        } 
    }

    public function testItemShow($id)
    {
        $isstandard = ISStandard::findOrFail($id);
        $testItems = DB::table('test_items')->where('isstandard_id', $isstandard->id)->get();
        // dd($testItems);
        if(empty($testItems)) {
            return response()->json(['data' => '', 'code' => 404]);
        } else {
            return response()->json(['data' => $testItems]);
        }
    }
}
