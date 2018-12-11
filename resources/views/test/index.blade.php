@extends('layouts.app')

@section('title')
All Tests List
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">All Tests</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Sample Name</th>
                        <th>Sample Recived On</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tests as $test)
                    <tr>
                        <td><a href="{{route('test.show', ['id' => $test->id])}}">{{$test->customer_name}}</a></td>
                        <td>{{$test->sample_name}}</td>
                        <td>{{$test->sample_received_on}}</td>
                        <td>
                        @switch($test->status)
                                @case('draft')
                                    <span class="btn cur-p btn-warning">Draft copy, Click to regsiter</span>
                                @break
                                @case('registered')
                                    <span class="btn cur-p btn-primary">Registered, allocate job</span>
                                @break
                                @case('in_progress')
                                    <span class="btn cur-p btn-primary">In Progress</span>
                                @break
                                @case('allocated')
                                    <span class="btn cur-p btn-secondary">Sent to Lab</span>
                                @break
                                @case('completed')
                                    <span class="btn cur-p btn-success">Completed</span>
                                @break                                    
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection