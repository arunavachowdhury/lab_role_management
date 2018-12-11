@extends('layouts.app')

@section('content')


<div class="container">  
<h2>Users</h2>  
<div class="row">
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Director</th>
        <th>Admin</th>
        <th>Employee</th>
        <th>Technician</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
      <form action="#" method="post">
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td><input type="checkbox" {{ $user->hasRole('Director') ? 'Checked' : '' }} ></td>
        <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'Checked' : '' }} ></td>
        <td><input type="checkbox" {{ $user->hasRole('Employee') ? 'Checked' : '' }} ></td>
        <td><input type="checkbox" {{ $user->hasRole('Technician') ? 'Checked' : '' }} ></td>
        {{ csrf_field() }}
        <td><button type="submit">Assign Roles</button></td>
        </form>
        <!-- <td>
        @if($user->usertype == "employee")
        <a href="{{route('user.technician',['id'=> $user->id])}}" class="btn btn-primary">Make Technician</a>
        @else($user->usertype == "technician")
        <a href="{{route('user.employee',['id'=> $user->id])}}" class="btn btn-primary">Make Employee</a>
        @endif
        </td> -->
      </tr>
  @endforeach
    </tbody>
  </table>
  </div>
</div>



@endsection