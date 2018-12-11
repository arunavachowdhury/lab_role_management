@extends('layouts.app')

@section('title')
Customers
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Customers list</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Customer/Company Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->phone_number}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
