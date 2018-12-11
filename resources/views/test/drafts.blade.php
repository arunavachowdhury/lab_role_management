@extends('layouts.app')

@section('title')
Drafts
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Draft list</h4>
            <table class="table table-bordered">
                <tbody>
                    @if($drafts->count() == 0)
                    <p>Drafts list is empty</p>
                    @else
                        @foreach($drafts as $draft)
                        <tr>
                            <td>
                            <a href="{{route('test.show', ['id' => $draft->id])}}">Test Draft || {{$draft->id}} || {{Carbon\Carbon::parse($draft->created_at)->format('Y-m-d')}} </a>
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