@extends('layouts.app')

@section('title')
Add Test
@endsection

@section('content')

<form action="{{route('test.store')}}" method="post">
    {{csrf_field()}}
    @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
    @endif
 
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="customer_id">Select Customer:</label>
                <select class="form-control" id="customer_id" name="customer_id">
                    @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="value">Sample:</label>
                <select class="form-control" id="sample_id" name="sample_id">
                    @if($samples->count() == 0)
                    <p>Please add a sample first</p>
                    @else
                    @foreach($samples as $sample)
                    <option value="{{$sample->id}}">{{$sample->name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="value">ISStandards:</label>
                <select class="form-control" name="isstandard_id" id="isstandard_id">
                    <option value="">Select IS Standard</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="checkbox" id="test_items">
                <ul class="list-task list-group" data-role="tasklist">
                    
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="bmd-label-floating">Sample Received on:</label>
                <input type="date" class="form-control" name="sample_received_on" value="{{Carbon\Carbon::today()->toDateString()}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="sample_reference_no">Sample Reference no:</label>
                <input type="text" class="form-control" id="sample_reference_no" name="sample_reference_no">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="bmd-label-floating">Date of Disposal</label>
                <input type="date" class="form-control" name="date_of_disposal">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="payment_details">Price</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="payment_details">Payment Details:</label>
                <input type="text" class="form-control" id="payment_details" name="payment_details">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <input type="text" class="form-control" id="remarks" name="remarks">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var sample_provided;
        var is_standard_provided;
        var sample_id = '';
        var is_standard_id = '';
        $("#sample_id").on('change click', function () {
            var value = $(this).val();
            sample_id = value;
            sample_provided = true;

            $.get("http://127.0.0.1:8000/api/sample/" + value, function (data) {
                var content = '';
                $.each(data.data, function (index, value) {
                    content += '<option value="' + value.id + '" >' + value.value +
                        '</option>'
                });
                // console.log(content);
                $("#isstandard_id").html(content);
                if (sample_provided == true && is_standard_provided == true) {
                    $.post("http://127.0.0.1:8000/api/test_items_query/", {
                        sample_id: sample_id,
                        isstandard_id: is_standard_id
                    }, function (data, status) {
                        if (data.data.length < 1) {
                            $('#test_items ul').html('');
                        }
                        var content = '';
                        $.each(data.data, function (key, value) {
                            // content += '<label style="margin-right:5px"><input name="test_items[]" type="checkbox" value="' + value.id + '">' + value.name + '</label>';

                            content += '<li class="list-group-item bdw-0" data-role="task"><div class="checkbox checkbox-circle checkbox-info peers ai-c"> <input name="test_items[]" type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer" value="'+value.id+'"><label for="inputCall1" class="peers peer-greed js-sb ai-c"> <span class="peer peer-greed">'+value.name+'</span\> </label> </div> </li>';
                        });
                        $('#test_items ul').html(content);
                    });
                }
            });
        });

        $("#isstandard_id").on('change click', function () {
            var value = $(this).val();
            is_standard_provided = true;
            is_standard_id = value;

            if (sample_provided == true && is_standard_provided == true) {
                $.post("http://127.0.0.1:8000/api/test_items_query/", {
                    sample_id: sample_id,
                    isstandard_id: is_standard_id
                }, function (data, status) {
                    if (data.data.length < 1) {
                        $('#test_items').html('');
                    }
                    var content = '';
                    $.each(data.data, function (key, value) {
                        // content += '<label style="margin-right:5px"><input name="test_items[]" type="checkbox" value="' + value.id + '">' + value.name + '</label>';
                        content += '<li class="list-group-item bdw-0" data-role="task"><div class="checkbox checkbox-circle checkbox-info peers ai-c"> <input name="test_items[]" type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer" value="'+value.id+'"><label for="inputCall1" class="peers peer-greed js-sb ai-c"> <span class="peer peer-greed">'+value.name+'</span\> </label> </div> </li>';
                        
                    });
                    $('#test_items').html(content);
                });
            }
        });
    });

</script>
@endpush
