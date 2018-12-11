@extends('layouts.app')

@section('title')
Allocate Test
@endsection

@section('content')

<div class="row">
    <div class="masonry-sizer col-md-12">
        <div class="masonry-item col-md-12" style="position: absolute; left: 0%; top: 0px;">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Allocate Test</h6>
                <div class="mT-30">
                    <h1>Test name: {{$test->customer_name}}</h1>
                    <form action="{{route('allocate')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="test_id" value="{{$test->id}}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="value">Select Lab:</label>
                                    <select class="form-control" id="lab_id" name="lab_id">
                                        @foreach($labs as $lab)
                                        <option value="{{$lab->id}}">{{$lab->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="value">Select Technician:</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        <option value="">Select Technician</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container-fluid">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $("#lab_id").on('change click', function () {
            var value = $(this).val();

            $.post("http://127.0.0.1:8000/api/get_user_for_lab/", {
                lab_id: value,
            }, function (data, status) {

                content = '';
                $.each(data.data, function (key, value) {
                    content += '<option value="' + value.id + '">' + value.name +
                        '</option>';

                });
                $('#user_id').html(content);
            });
        });

    });

</script>
@endpush
