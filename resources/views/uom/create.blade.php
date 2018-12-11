@extends('layouts.app')

@section('title')
Create Unit
@endsection

@section('content')
<div class="row">
<div class="masonry-sizer col-md-12">
    <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 0px;">
        <div class="bgc-white p-20 bd"> 
            <h6 class="c-grey-900">Add a Sample/Product</h6>
            <div class="mT-30">
                <form action="{{route('uom.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Unit:</label>
                        <input type="text" class="form-control" id="unit" name="unit">
                        @if ($errors->has('unit'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('unit') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success" style="cursor: pointer">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
