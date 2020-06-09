@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Review of {{$model_details->name}}, Rating {{number_format($model_rating,1)}}({{$total_rating}})</div>


            </div>
        </div>
    </div>
    <br>
    <a href="{{route('fan.review.index')}}">Back</a>
  <table class="table" id="sampleTable">
    <thead>
      <tr>
        <th>Fan Name</th>
        <th>Rating</th>
        <th>Title</th>
        <th>Body</th>
        <th>Posted On</th>
      </tr>
    </thead>
    <tbody>

      @if($reviews->count())
        @foreach($reviews as $review)
          <tr>
            <td>{{$review->fan_name}}</td>
            <td>{{$review->rating}}</td>
            <td>{{$review->title}}</td>
            <td>{{$review->body}}</td>
            <td>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</td>
          </tr>
        @endforeach
      @else
        <tr><td>No Record Found<td></tr>
      @endif
    </tbody>


  </table>

</div>
@endsection
