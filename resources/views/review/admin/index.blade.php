@extends('layouts.app')

@section('content')
{{-- <style type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" rel="stylesheet">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</style> --}}



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Reviews for @if(Auth::User()->usertype==1) Admin @elseif(Auth::User()->usertype==2) Model @endif</div>


            </div>
        </div>
    </div>
    <br>
    <a href="{{route('admin.review.index')}}">All Review</a> &nbsp;
    <a href="{{route('admin.review.all-models')}}">All Models</a>
  <table class="table" id="sampleTable">
    <thead>
      <tr>
        <th>Fan Name</th>
        <th>Model Name</th>
        <th>Rating</th>
        <th>Title</th>
        <th>Body</th>
        <th>Is Approaved</th>
        <th>Posted On</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @if($reviews)
        @foreach($reviews as $review)
          <tr>
            <td>{{$review->fan_name}}</td>
            <td>{{$review->model_name}}</td>
            <td>{{$review->rating}}</td>
            <td>{{$review->title}}</td>
            <td>{{$review->body}}</td>
            <td>
              <div class="toggle-button-cover margin-auto">
                <div class="button-cover">
                    <div class="button-togglr b2" id="button-11">
                        <input id="toggle-block" class="is_approved" type="checkbox" name="status" class="checkbox" data-reviewid="{{ $review->id }}" {{ $review->is_approved == 1 ? 'checked' : '' }}>
                        {{-- <div class="knobs"><span>Inactive</span></div> --}}
                        <div class="layer"></div>
                    </div>
                </div>
              </div>
            </td>
            <td>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</td>
            <td>
              <a href="{{ route('admin.review.show', $review->id) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i>View</a>

              <a href="#" data-id="{{ $review->id }}" class="review-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i>Delete</a>
            </td>

          </tr>

        @endforeach
      @else
        <tr><td>No Record Found<td></tr>
      @endif
    </tbody>


  </table>

</div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/fontawesome.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}

  <script type="text/javascript">
    $('#sampleTable').on("click",'.review-remove',function(){
        var reviewId=$(this).data('id');

        if(confirm("Are you sure want to delete?")){
          window.location.href = "delete/"+reviewId;
        }else{
          alert("Record Safe");
        }

        /*swal({
          title: "Are you sure?",
          text: "Your will not be able to recover the record!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = "packages/"+packageId+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });*/
    });
   </script>


<script type="text/javascript">
  $('.is_approved').on('change',function(){

      var review_id = $(this).data('reviewid');
      var CSRF_TOKEN = "{{csrf_token()}}";
      var check_status = 0;
      if($(this).is(":checked")){
          check_status = 1;
      }else{
          check_status = 0;
      }

      $.ajax({
          type:'POST',
          dataType:'JSON',
          url:"{{route('admin.review.updateStatus')}}",
          data:{ _token: CSRF_TOKEN, id:review_id, approval_status:check_status},
          success:function(response)
          {
            console.log(response.message);
            // $('#success-text').text(response.message);
            // $('#success-msg').show();
            // $('#success-msg').fadeOut(2000);
            //swal("Success!", response.message, "success");
          },
          error: function()
          {
              // $('#error-text').text("Error! Please try again later");
              // $('#error-msg').show();
              // $('#error-msg').fadeOut(2000);
              //swal("Error!", response.message, "error");
          }
      });
  })


  /*$('#sampletable').on('change','.is_approved',function() {

    console.log("hreee");

    return false;
      var reviewid = $(this).data('reviewid');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      var check_status = 0;
      if($(this).is(":checked")){
          check_status = 1;
      }else{
          check_status = 0;
      }
      $.ajax({
          type:'POST',
          dataType:'JSON',
          url:"{{--route('admin.package.updatestatus')--}}",
          data:{ _token: CSRF_TOKEN, id:package_id, status:check_status},
          success:function(response)
          {
            // $('#success-text').text(response.message);
            // $('#success-msg').show();
            // $('#success-msg').fadeOut(2000);
            swal("Success!", response.message, "success");
          },
          error: function()
          {
              // $('#error-text').text("Error! Please try again later");
              // $('#error-msg').show();
              // $('#error-msg').fadeOut(2000);
              swal("Error!", response.message, "error");
          }
      });
  });*/
</script>
@endsection





