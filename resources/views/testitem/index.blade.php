@extends('layouts.app')

@section('content')

@foreach($samples as $sample)
<div class="panel panel-primary">
    <div class="panel-heading">{{$sample->name}}</div>
    <div class="panel-body">{{$sample->description}}</div>
</div>
@endforeach

@endsection