@extends('layouts.app')

@section('title')
Product / Material of Test
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Product / Material of Test</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="min-width: 200px">Sample/Product name</th>
                        <th>Description</th>
                        <!-- <th>Show</th> -->
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($samples as $sample)
                    <tr>
                        <td><a href="{{route('sample.show', ['sample' => $sample->id])}}" class="btn btn-success">{{$sample->name}}</a></td>
                        <td>{{$sample->description}}</td>
                        <!-- <td><a href="{{route('sample.show', ['sample' => $sample->id])}}" class="btn btn-primary">Show</a></td> -->
                        <td><a href="{{route('sample.edit', ['sample' => $sample->id])}}" class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection