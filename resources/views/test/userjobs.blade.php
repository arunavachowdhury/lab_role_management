@extends('layouts.app')

@section('title')
My Jobs
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">My Jobs</h4>
            <table class="table table-bordered">
                <tbody>
                    @if($myTests->count() == 0)
                    <p>Jobs list is empty</p>
                    @else
                        @foreach($myTests as $myTest)
                        <tr>
                            <td>
                            <a style="color: #666" href="{{route('test.show', ['id' => $myTest->id])}}">
                                   <!-- {{$myTest->sample_name}} || {{$myTest->customer_name}} -->
                                   {{$myTest->sample_name}} || {{$myTest->id}} || {{Carbon\Carbon::parse($myTest->updated_at)->format('Y-m-d')}} 
                            </a>
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