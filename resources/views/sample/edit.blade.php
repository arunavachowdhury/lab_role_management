@extends('layouts.app')

@section('title')
Edit : {{$sample->name}}
@endsection

@section('content')
<div class="row">
<div class="masonry-sizer col-md-12">
    <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 0px;">
        <div class="bgc-white p-20 bd"> 
            <h6 class="c-grey-900">Edit Sample / Product</h6>
            <div class="mT-30">
  
    <form action="{{ route('sample.update', ['sample' => $sample->id]) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $sample->name }}" class="form-control" >
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" rows="6" name="description" >{{ $sample->description }}</textarea>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>     
    </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
