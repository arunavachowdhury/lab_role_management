@extends('layouts.app')

@section('title')
{{$sample->name}}
@endsection

@section('content')

<div class="bgc-light-green-500 c-white p-20">
    <div class="peers ai-c jc-sb gap-40">
        <div class="peer peer-greed">
            <h1>{{$sample->name}}</h1>
        </div>
    </div>
</div>
<div class="bdT pX-40 pY-30">
    <p>{{$sample->description}}</p>
</div>
<br>
<a href="{{route('sample.edit', ['sample' => $sample->id])}}" class="btn cur-p btn-primary">Edit Sample/Product</a>
<br>
<br>
<div class="bgc-white p-20 bd">
<h4 class="c-grey-900 mB-20">Test Method Specification against which tests are performed</h4>
    <div class="mT-30">
        <ul class="list-group">
            @foreach($isstandards as $isstandard)
            <li class="list-group-item list-group-item-action" data-value="{{$isstandard->id}}" class=isstandard_id>{{$isstandard->value}}</li>
            @endforeach
        </ul>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Specific Test Performed</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="min-width: 150px">Test Item</th>
                        <th style="min-width: 200px">Specified value range</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($testItems as $testItem)
                    <tr>
                        <td>{{$testItem->name}}</td>
                        <td>{{$testItem->specified_range_from}} {{$testItem->uom->unit}} - {{$testItem->specified_range_to}}
                            {{$testItem->uom->unit}}</td>
                        <td>{{$testItem->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>

$(document).ready(function(){
    $('.isstandard_id').on('click',function(){
        alert('denger');
        var value = $(this).attr('data-value');
        console.log(value);
        // $.get("http://127.0.0.1:8000/api/test_items_show/" + value, function (data){
        //     var content = '';
        //     $.each(data.data, function (index, value) {

        //     });
        // });
    });
});

</script>

@endpush

