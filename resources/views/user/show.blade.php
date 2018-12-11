@extends('layouts.app')

@section('title')
{{$lab->name}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4> Name</h4></div>
                    <div class="panel-body">{{$user->name}}</div>
                </div>
                <hr>
                <div class="panel panel-primary">
                    <div class="panel-heading"><h4>Email</h4></div>
                    <div class="panel-body">{{$user->email}}</div>
                </div>
                <!-- <div class="panel panel-primary">
                    <div class="panel-heading"><h4>Add Technician</h4></div>
                    <div class="panel-body">
                        <form action="{{route('allocate.user',['id'=> $lab->id])}}" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="technician_id">Technician List:</label>
                                <select class="form-control" id="technician_id" name="technician_id">
                                    @foreach($technicians as $technician)
                                    <option value=" {{ $technician->id }}"> {{$technician->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>


@endsection
