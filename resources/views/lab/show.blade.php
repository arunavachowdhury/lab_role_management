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
                    <div class="panel-heading">
                        <h4>Lab Name</h4>
                    </div>
                    <div class="panel-body">{{$lab->name}}</div>
                </div>
                <hr>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Lab Address</h4>
                    </div>
                    <div class="panel-body">{{$lab->address}}</div>
                </div>
                <hr>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Contact Person</h4>
                    </div>
                    <div class="panel-body">{{$lab->contact_person}}</div>
                </div>
                <hr>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Phone Number</h4>
                    </div>
                    <div class="panel-body">{{$lab->phone_number}}</div>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <h2>Technician list</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Technician Name</th>
                                        <th>Technician Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lab->users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <hr>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Add Technician</h4>
                    </div>
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
                </div>
            </div>
        </div>



    </div>
</div>


@endsection
