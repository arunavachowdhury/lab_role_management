@extends('layouts.app')

@section('title')
Add a Sample/Product
@endsection

@section('content')
<div class="row">
<div class="masonry-sizer col-md-12">
    <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 0px;">
        <div class="bgc-white p-20 bd"> 
            <h6 class="c-grey-900">Add IS Standard to Sample/Product</h6>
            <div class="mT-30">
            <form action="{{route('isstandard.store')}}" method="post">
            {{csrf_field()}}
                <div class="form-group">
                    <label for="value">IS Standard:</label>
                    <input type="text" class="form-control" id="value" name="value">
                    @if ($errors->has('value'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('value') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="value">Sample:</label>
                    <select class="form-control" name="sample_id">
                        @if($samples->count() == 0)
                        <p>Please add a sample first</p>
                        @else
                            @foreach($samples as $sample)
                                <option value="{{$sample->id}}">{{$sample->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection


