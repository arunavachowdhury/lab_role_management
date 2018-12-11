@extends('layouts.app')

@section('title')
Registerds
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Registerd Test list</h4>
            <table class="table table-bordered">
                <tbody>
                    @if($registereds->count() == 0)
                    <p>Registerd Test list is empty</p>
                    @else
                        @foreach($registereds as $registered)
                        <tr>
                            <td>
                            <a href="{{route('test.show', ['id' => $registered->id])}}">Test Registerd || {{$registered->id}} || {{Carbon\Carbon::parse($registered->created_at)->format('Y-m-d')}} </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection