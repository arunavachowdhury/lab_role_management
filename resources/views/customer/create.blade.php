@extends('layouts.app')

@section('title')
Add Customer
@endsection

@section('content')

<div class="row">
    <div class="masonry-sizer col-md-12">
        <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 0px;">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Add Customer</h6>
                <div class="mT-30">
                    <form action="{{route('customer.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="contact_person">Contact Person:</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
