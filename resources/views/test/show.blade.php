@extends('layouts.app')

@section('title')

{{$sample->name}} | {{$customer->name}}

@endsection

@section('content')

<div class="bgc-light-green-500 c-white p-20">
    <div class="peers ai-c jc-sb gap-40">
        <div class="peer peer-greed">
            <h1>{{$sample->name}} || {{$customer->name}}</h1>
        </div>
    </div>
</div>
<!-- <a href="{{route('sample.edit', ['sample' => $sample->id])}}" class="btn cur-p btn-primary">Edit Sample/Product</a> -->
<br>
<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Test details</h4>
            <div class="mT-30">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action">
                        <b>Test status :</b>
                        <div style="display:inline; margin-left: 5px" class="peer">
                            @switch($test->status)
                            @case('draft')
                            <a href="{{route('test.regsiter', ['id' => $test->id])}}" class="btn cur-p btn-warning">Draft
                                copy, Click to regsiter</a>
                            @break
                            @case('registered')
                            <a href="{{route('allocate.get', ['id' => $test->id])}}" class="btn cur-p btn-primary">Registered,
                                allocate job</a>
                            @break
                            @case('in_progress')
                            <a href="{{route('test.regsiter', ['id' => $test->id])}}" class="btn cur-p btn-primary">In
                                Progress</a>
                            @break
                            @case('allocated')
                            <a href="{{route('test.regsiter', ['id' => $test->id])}}" class="btn cur-p btn-secondary">Sent
                                to Lab</a>
                            @break
                            @case('completed')
                            <a href="{{route('test.regsiter', ['id' => $test->id])}}" class="btn cur-p btn-success">Completed</a>
                            @break
                            @endswitch
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <b>Customer/Comany name :</b> {{$customer->name}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <b>Product/Sample name:</b> {{$sample->name}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <b>Product/Sample desciption:</b> {{$sample->description}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <b>IS Standard:</b> {{$isStandard->value}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <b>Sample recieved on:</b> {{$test->sample_received_on}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <b>Sample disposal date:</b>
                    </li>
                    <!-- <li class="list-group-item list-group-item-action">
                        <b>Price: {{$test->price}} </b> 
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Specific Test Performed</h4>
            @if($test->status == 'allocated')
            <a class="btn btn-primary" href="{{route('test.report', ['id' => $test->id])}}">Generate report</a>
            @endif
            <div class="mT-30">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Test Item</th>
                            <th scope="col">Specified value range</th>
                            <th scope="col">Observed value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{$job->testItem->name}}</td>
                            <!-- <td></td> -->
                            <td>{{$job->specified_range_from}} {{$job->testItem->uom->unit}} -
                                {{$job->specified_range_to}}
                                {{$job->testItem->uom->unit}}</td>
                            <td class="fill_up_job_values">
                                @if($job->observed_value)
                                    <span class=
                                        @if($job->in_range == '1')
                                            "btn cur-p btn-success"
                                        @else
                                            "btn cur-p btn-danger"
                                        @endif
                                        >{{$job->observed_value}}
                                    </span>
                                @else
                                    <span id="span-{{$job->id}}" class="btn cur-p btn-warning">empty</span>
                                @endif

                                @if($test->status == 'allocated')
                                    @if(!$job->observed_value)
                                        <button class="btn btn-primary fill_up_values">Fill up test values</button>
                                    @endif
                                @endif
                                <input type="hidden" value="{{$job->id}}" id="hidden_job_id">
                                <input type="hidden" value="{{Auth::user()->id}}" id="hidden_user_id">
                                <div class="hidden">
                                    <br>
                                    <div class="form-group"><input class="form-control final_value_feild" type="text"></div>
                                    <div class="form-group"><button class="btn btn-success final_fill_up_btn" type="button">Submit</button></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $(".fill_up_values").on('click', function () {
            // $(this).closest('.fill_up_job_values').find('span').hide();
            $(this).hide();
            $(this).closest('.fill_up_job_values').find('.hidden').show();
        });

        $(".final_fill_up_btn").click(function () {
            var this_job_feild_value = $(this).closest('.fill_up_job_values').find('.final_value_feild')
                .val();
            var my_job_id = $(this).closest('.fill_up_job_values').find("#hidden_job_id").val();
            var my_user_id = $(this).closest('.fill_up_job_values').find("#hidden_user_id").val();

            if (this_job_feild_value == '' || this_job_feild_value == null) {
                console.log('error: empty observed value value');
            } else {
                $(this).closest('.hidden').hide();
                $.post("http://127.0.0.1:8000/api/fill_up_observed_value/", {
                    job_id : my_job_id,
                    modified_by : my_user_id,
                    observed_value : this_job_feild_value
                }, function (data, status) {
                    $(this).closest('.hidden').hide();
                    var span_id = 'span-' + data.data.id;
                    $('#'+span_id).html(data.data.observed_value);
                });
            }
        });
    });

</script>
@endpush
