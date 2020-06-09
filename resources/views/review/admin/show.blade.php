@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
      <div class="row ">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Review Details</div>

              </div>
          </div>
      </div>

      <div class="box-body">

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Fan Name</b>
            </div>
            <div class="col-md-8 card-even">
                {{$review->fan_name}}
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Model Name</b>
            </div>
            <div class="col-md-8 card-even">
                {{$review->model_name}}
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Rating</b>
            </div>
            <div class="col-md-8 card-even">
                {{$review->rating}}
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Title</b>
            </div>
            <div class="col-md-8 card-even">
                {{$review->title}}
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Body</b>
            </div>
            <div class="col-md-8 card-even">
                {{$review->body}}
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Approaval Status</b>
            </div>
            <div class="col-md-8 card-even">
                @if($review->is_approved) Approved @else Not Approved @endif
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 card-even">
                <b>Posted On</b>
            </div>
            <div class="col-md-8 card-even">
                {{\Carbon\Carbon::parse($review->created_at)->diffForHumans()}}, On : {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}
            </div>
          </div>
        </div>

      </div>

      <a href="{{route('admin.review.index')}}">Back to list</a>

    </div>
</div>
@endsection
