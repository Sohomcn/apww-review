@extends('layouts.app')

@section('content')

<style type="text/css">
  .topPadding{
    padding-top: 30px;
  }
  .pageBG{
    background-color: #000;
  }
  .optionBG{
    background-color: #ededed;
  }
  .vl {
    border: 1px solid #969696;
    height: auto;
  }
  .fullBlock{
    border-radius: 8px;
    background-color: #fff;
  }
  .pullRight{
    float: right;
  }

.userImg {
  display: inline-block;
  width: 30px;
  height: 30px;
  border-radius: 50%;

  object-fit: cover;
}

.prflPadding{
  padding: 8px;
}

.loader{
  text-align: center;
  padding:50px;
}
</style>

<div class="container optionBG">
    <div class="row topPadding">

      <div class="col-sm-3"></div>
      <div class="col-sm-5 fullBlock">

          <form action="{{route('model.post.store')}}" method="POST" enctype="multipart/form-data" id="postForm">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="description"></label>
                    <textarea class="form-control" id="description" name="description" placeholder="Write Something Here ..."></textarea>
                    @if($errors->has('description'))
                      <span><label class="error pull-right">{{$errors->first('description')}}</label></span>
                    @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="price_type">Price Type</label>
                    <div class="radio">
                      <label><input type="radio" name="price_type" value="0" checked>Free</label>
                      <label><input type="radio" name="price_type" value="1">Paid</label>
                    </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group amountDiv">
                  <input type="number" class="form-control" id="amount" name="amount" placeholder="amount">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="upload_file"></label>
                  <input type="file" id="upload_file" name="upload_file">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <button style="width: 100%" type="submit" class="btn btn-info">Post</button>
                </div>
              </div>
            </div>

          </form>
      </div>
      <div class="col-sm-4"></div>
    </div>

    @if($posts->count())
        @foreach($posts as $post)
          <div class="row topPadding">
            <div class="col-sm-3"></div>
            <div class="col-sm-5 fullBlock">
              <div class="prflPadding">
                <img src="https://lh3.googleusercontent.com/-Ke1tjhaYe7I/XuIlS5QQnkI/AAAAAAAAANg/hHBbPWp2mfQ2RRg8bugM0_rU4Rw2LBp8ACLcBGAsYHQ/s0/modelimg5.jpg" class="userImg">
                <span><b>{{$model_detail->name}}</b></span>
                <span class="pullRight">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </span>
              </div>
                @if($post->price_type)
                  <img width="100%" height="400px" src="{{ asset('storage/post/paid-content.jpg') }}">
                  <div>
                    Type :
                    @if($post->post_type==1) Image
                    @elseif($post->post_type==2) Video
                    @endif
                    , Price : ${{number_format($post->post_type,2)}}

                  </div>
                @else
                  @if($post->post_type==1)

                    <img width="100%" height="400px" src="{{ asset('storage/'.$post->file) }}" title="model-image">


                  @elseif($post->post_type==2)

                    <video width="100%"  controls>
                      <source src="{{ asset('storage/'.$post->file) }}">
                      Your browser does not support video.
                    </video>

                  @else <hr>
                  @endif
                @endif

              <div>
                {{$post->description}}
              </div>

              <div class="row">
                <div class="col-sm-3 optionBG vl">
                  <a href="javascript:void(0);">Add to cart</a>
                </div>
                <div class="col-sm-3 optionBG vl">
                  <a href="javascript:void(0);">Send Message</a>
                </div>
                <div class="col-sm-3 optionBG vl">
                  <a href="javascript:void(0);">Call me</a>
                </div>
                <div class="col-sm-3 optionBG vl">
                  <a href="javascript:void(0);">Send a tip</a>
                </div>
              </div>
              <hr>
            </div>
            <div class="col-sm-4"></div>
          </div>
        @endforeach
    @else
        <center>No Post Found</center>
    @endif

<div class="loader">
  <h4>Loading...</h4>
  <img height="100px" width="200px" src="https://lh3.googleusercontent.com/-dOI9kypwDQ0/XuJRVce5n6I/AAAAAAAAAOg/JE5OpH9fwZg0RIMrRZLVppQRZJhcws8GgCK8BGAsYHg/s0/2020-06-11.gif">
</div>
</div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script type="text/javascript">
    $(document).ready(function() {

        $(':input[type="submit"]').prop('disabled', true);

        $('#description').keyup(function() {
            if($('#description').val().length){
              $(':input[type="submit"]').prop('disabled', false);
            }else{

              if(document.getElementById("upload_file").files.length == 0){
                $(':input[type="submit"]').prop('disabled', true);
              }else{
                $(':input[type="submit"]').prop('disabled', false);
              }
            }
        });

        $("input:file").change(function (){
          $(':input[type="submit"]').prop('disabled', false);
        });

        $('.amountDiv').hide();
        $('input[type=radio][name=price_type]').change(function() {
          if (this.value==1) {
              $('.amountDiv').show();
              $('#amount').val('');
          }
          else {
              $('.amountDiv').hide();
              $('#amount').val('');
          }
        });

        $('.loader').hide();

    });

  $(window).scroll(function ()
  {

     if($(document).height() <= $(window).scrollTop() + $(window).height())
      {
        $('.loader').show();
        console.log('scroll');

      }
  });

</script>

@endsection





