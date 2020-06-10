@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as
                    @if(Auth::User()->usertype==1) Admin
                    @elseif(Auth::User()->usertype==2) Model
                    @else Fan
                    @endif

                    <br>
                    @if(Auth::User()->usertype==1)
                        <a href="{{route('admin.review.index')}}"> Go to review section </a>
                    @elseif(Auth::User()->usertype==2)
                        <a href="{{route('fan.review.models',['model_id' =>Auth::User()->id])}}"> Go to review section </a>
                    @else
                        <a href="{{route('fan.review.index')}}"> Go to review section </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
