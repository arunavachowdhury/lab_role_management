@extends('layouts.app')

@section('title')
Add a Lab
@endsection

@section('content')

<form action="{{route('lab.store')}}" method="post">
{{csrf_field()}}
    <div class="form-group">
        <label for="name">Lab Name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="description">Address:</label>
        <textarea name="address" id="address" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="contact_person">Contact Person:</label>
        <input type="text" class="form-control" id="contact_person" name="contact_person">
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

@endsection
