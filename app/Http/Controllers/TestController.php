<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use Illuminate\Http\Request;
use App\Customer;
use App\Sample;
use App\Test;
use Illuminate\Support\Facades\DB;
use App\TestItem;
use App\Job;
use App\Lab;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test.index')->with(['tests' => Test::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Customer::all()->count() == 0) {
            Session::flash('error', 'You need a Customer to add a Test');
            return redirect()->route('customer.create');
        }
        if(Sample::all()->count() == 0) {
            Session::flash('error', 'You need a Sample to add a Test');
            return redirect()->route('customer.create');
        }
        return view('test.create')->with(['customers'=> Customer::all(), 'samples' => Sample::all()]);
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
        $customer = Customer::findOrFail($request->customer_id);
        $sample = Sample::findOrFail($request->sample_id);

        $validator = Validator::make($request->all(), [
            'customer_id'=> 'required',
            'sample_id'=> 'required',
            'isstandard_id'=> 'required',
            'sample_received_on'=> 'required',  
            'sample_reference_no'=>'reruired', 
        ]);

        $test = Test::create([
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'sample_id' => $sample->id,
            'sample_name' => $sample->name,
            'is_standard_id'=> $request->isstandard_id,
            'sample_received_on' => $request->sample_received_on,
            'sample_reference_no' => $request->sample_reference_no,
        ]);
        
        foreach ($request->test_items as $test_item) {
            $testItem = TestItem::findOrFail($test_item);

            $jobs = Job::create([
                'test_id' => $test->id,
                'test_item_id' => $test_item,
                'test_item_name' => $testItem->name,
                'specified_range_from' => $testItem->specified_range_from,
                'specified_range_to' => $testItem->specified_range_to,
                'price' => $testItem->price,
                'is_new' => $testItem->is_new
            ]);
        }
        // dd($test);

        return redirect()->route('test.show', ['id' => $test->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::findOrFail($id);
        $jobs = $test->jobs;
        $testItems = $test->jobs()->with('testItem')->get()->pluck('testItem');
        $sample = $test->sample;
        $customer = $test->customer;
        $isStandard = $test->isStandard;

        // Session::flash('error', 'oyy');

        return view('test.show')->with(['test'=> $test,
                                        'jobs'=> $jobs,
                                        'sample'=> $sample,
                                        'customer'=> $customer,
                                        'isStandard'=> $isStandard]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('test.show')->with(['test'=> $test,
                                        'jobs'=> Job::all(),
                                        'samples'=> Sample::all(),
                                        'customers'=> Customer::all()]);
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
     * 
     * 
     */
    public function drafts() {
        $drafts = DB::table('tests')->where('status', 'draft')->orderBy('created_at', 'desc')->get();
        return view('test.drafts')->with(['drafts' => $drafts]);
    }

    /**
     * 
     * 
     */

    public function registeredTests() {
        $registereds = DB::table('tests')->where('status', 'registered')->orderBy('created_at', 'desc')->get();
        return view('test.registereds')->with(['registereds' => $registereds]);
    }


    public function register($id) {
        $test = Test::findOrFail($id);
        if($test->status == 'draft' || $test->status == 'Draft') {
            $test->status = 'registered';
            $test->save();
        } else {
            redirect()->back();
        }
        return redirect()->route('test.show', ['id' => $test->id]);
    }

    /**
     * 
     */
    public function allocateView($id) {
        $test = Test::findOrFail($id);

        if(Lab::all()->count() == 0) {
            Session::flash('error', 'You need a Lab to allocate a Job');
            return redirect()->route('lab.create');
        }

        $testJobs = DB::table('jobs')->where('test_id', $test->id)->get();
        return view('test.allocate')
        ->with(['test' => $test])
        ->with(['jobs' => $testJobs])
        ->with(['labs' => Lab::all()]);
    }

    /**
     * 
     */
    public function allocateAction(Request $request) {
        $test = Test::findOrFail($request->test_id);
        
        $jobs = $test->jobs;

        foreach ($jobs as $job) {
            DB::table('jobs')
            ->where('id', $job->id)
            ->update(['lab_id' => $request->lab_id, 'user_id' => $request->user_id]);
        }        
        $test->status = 'allocated';
        $test->save();
        return redirect()->route('test.show', ['id' => $test->id]);
    }

    /**
     * Show all tests of authenticate user
     * 
     * @return \Illuminate\Http\Response
     */

    public function myJobs()
    {
        // dd(Auth::user);
        $myTests = Auth::user()
                    ->jobs()
                    ->with('test')
                    ->get()
                    ->pluck('test')
                    ->unique('id')
                    ->values();
        // dd($myTests);

        return view('test.userjobs')->with('myTests', $myTests);
    }

    /**
     * 
     */
    public function fillUpJobObservedValue(Request $request) {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'modified_by' => 'required',
            'observed_value' => 'required'
        ]);

        $job = Job::findOrFail($request->job_id);

        if($job->specified_range_from < $request->observed_value && $job->specified_range_to > $request->observed_value) {
            $in_range = 1;
        } else {
            $in_range = 0;
        }

        DB::table('jobs')
            ->where('id', $request->job_id)
            ->update(['modified_by' => $request->modified_by, 'observed_value' => $request->observed_value, 'in_range' => $in_range]);

        $job = Job::findOrFail($request->job_id);

        return response()->json(['data' => $job]);
    }

    /**
     * 
     */
    public function report($id) {

        $test = Test::findOrFail($id);

        $customer_name = $test->customer_name;

        $pdf = \App::make('dompdf.wrapper');
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        $pdf->loadHTML($this->generatePdfContent(
            $customer_name,
            $test->id,
            $test->sample_received_on,
            $test->sample_name,
            $test->jobs,
            env('APP_NAME')
        ))->setPaper('a4');
        return $pdf->stream("Test-Order-Form");
    }

    public function generatePdfContent($customer_name, $test_no, $sample_receive_date, $sample_name,$jobs, $app_name)
    {

        $table = '';
        $counter = 1;
        foreach ($jobs as $job) {
            $table .= '
            <tr>
                <td>'.$counter.'</td>
                <td>'.$job['test_item_name'].'</td>
                <td>'.$job['observed_value'].'</td>
                <td>'.$job['specified_range_from'] .' - '. $job['specified_range_from'] .'</td>
            </tr>
            ';
            $counter++;
        }


        $output = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <title>TEST REPORT</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
          
          <style>
            html {
                padding: 0 !important
            }
            h6 {
                padding: 10px;
            }
            td, th {
                border: 1px solid #000;
                padding: 1px 2px;
            }
          </style>
          
        </head>
        <body>
        
        
        <div class="container-fluid">
            <br><br>
            <div class="text-center">
              <h4 >TEST REPORT</h4> 
            </div>
            <br><br>
          
          
        <div class="row">
            <div class="col-sm-12">
                <h6>  Customer name: '.$customer_name.'</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
                <h6>Test no.  : '.$test_no.'</h6>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
                <h6>Sample receive data  : '.$sample_receive_date.'</h6>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
                <h6>Sample name  : '.$sample_name.'</h6>
            </div>
          </div>
          
            <div class="text-center">
              <h4><u>TEST RESULTS</u></h4> 
              <p>The sample has been tested with the following results:-</p>
            </div>
            
            <div class="row">
            <table class="" style="Width:100%">
            <thead>
              <tr>
                <th>Sl. No.</th>
                <th>Test Item</th>
                <th>Observed Value</th>
                <th>Specified Value</th>
              </tr>
            </thead>
            <tbody>
              '.$table.'
            </tbody>
          </table>
          </div>
          <br><br>
          <br><br>
          
            <div class="row float-right">
                <h6>Aglow Quality Control Laboratory Pvt. Ltd.</h6>
            </div>
            <br>
            <br>
            <div class="row float-right">
                
                <h6>(Authorised Singnatory)</h6>
            </div>
            
        </div>
        
        </body>
        </html>
        
        ';

        return $output;
    }
}
