@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Write a review</div>


            </div>
        </div>
    </div>
    <br>

  <form action="{{route('fan.review.store')}}" method="POST" role="form" id="reviewForm">
    @csrf
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="model_name">Model Name</label>
          <input type="input" value="{{$model_details->name}}" class="form-control" id="model_name" name="model_name" readonly="">
          @if($errors->has('model_name'))
            <span><label class="error pull-right">{{$errors->first('model_name')}}</label></span>
          @endif
          <input type="hidden" name="model_id" value="{{$model_details->id}}">
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="rating">Rating</label>

          <select class="form-control" id="rating" name="rating">
            <option value="">Select</option>
            <option {{ (old('rating') == 1) ? 'selected':'' }} value="1">1</option>
            <option {{ (old('rating') == 2) ? 'selected':'' }} value="2">2</option>
            <option {{ (old('rating') == 3) ? 'selected':'' }} value="3">3</option>
            <option {{ (old('rating') == 4) ? 'selected':'' }} value="4">4</option>
            <option {{ (old('rating') == 5) ? 'selected':'' }} value="5">5</option>
          </select>
          @if($errors->has('rating'))
            <span><label class="error pull-right">{{$errors->first('rating')}}</label></span>
          @endif
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="headline">Title</label>
          <input type="input" class="form-control" id="headline" name="title" value="{{ old('title') }}">
          @if($errors->has('title'))
            <span><label class="error pull-right">{{$errors->first('title')}}</label></span>
          @endif
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="description">Description</label>

          <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
          @if($errors->has('description'))
            <span><label class="error pull-right">{{$errors->first('description')}}</label></span>
          @endif

        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('fan.review.index')}}">Back</a>
      </div>
      <div class="col-sm-3"></div>
    </div>

  </form>

</div>
@endsection
