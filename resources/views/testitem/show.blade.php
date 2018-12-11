@extends('layouts.app')

@section('content')

<h1>{{$sample->name}}</h1>

<ul class="list-group">
@foreach($isstandards as $isstandard)
<li class="list-group-item">
    {{$isstandard->value}}
</li>
@endforeach
</ul>
@endsection