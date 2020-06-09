@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Models</div>


            </div>
        </div>
    </div>
    <br>
    <a href="{{route('fan.own.review')}}">My Review</a>
  <table class="table" id="sampleTable">
    <thead>
      <tr>
        <th>Model Name</th>
        <th>Rating</th>
        <th>Write a review</th>
      </tr>
    </thead>
    <tbody>

      @if($models)
        @foreach($models as $model)
          <tr>
            <td><a href="{{route('fan.review.models',$model->id)}}">{{$model->name}}</a></td>
            <td>{{number_format($model->rating,1)}} ({{$model->total}}) </td>
            <td><a href="{{route('fan.review.create',$model->id)}}">Write a review</a></td>
          </tr>

        @endforeach
      @else
        <tr><td>No Record Found<td></tr>
      @endif
    </tbody>
  </table>

</div>
@endsection
