@extends('layouts.app')

@section('title')
Add User
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
                    <form action="{{route('user.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email">                      
                        </div>
                        <div class="form-group">
                            <label for="password">Pasword:</label>
                                <input type="password" class="form-control" name="password" id="password">                      
                        </div>
                        <!-- <div class="form-group">
                            <div class="checkbox">
                            <label><input type="checkbox" class="form-control" value="technician" name="usertype">Technician</label> 
                            </div>
                            <div class="checkbox">
                            <label><input type="checkbox" class="form-control" value="employee" name="usertype">Employee</label> 
                            </div>
                        </div> -->
                        <input type="hidden" name="usertype" value="employee">
                         <button type="submit" class="btn btn-success" style="cursor: pointer">Submit</button>
                    </form>
        </div>
    </div>               
</div>


@endsection
