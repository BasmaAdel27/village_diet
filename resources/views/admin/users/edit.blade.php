@extends('admin.app')
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('users')</h2>
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.users.update',$user) }}" method="post" enctype="multipart/form-data">@csrf
        @method('PUT')
        @include('admin.users._form')
      </form>
    </div>
  </div>


@endsection

@section('scripts')
<script>
  $(document).ready(function () {
      $('#country').on('change', function () {
        var country_id = this.value;
        // console.log(idCountry);
        $("#state").html('');
        $.ajax({
          url: "{{url('http://127.0.0.1:8000/states')}}",
          method: "POST",
          data: {
            country_id: country_id,
            "_token": $('#token').val()
          },
          dataType: 'json',
          success: function (result) {
            // console.log(result);
            $('#state').html('<option value="">-- Select State --</option>');
            $.each(result, function (key, value) {
              console.log(key,value)
              $("#state").append('<option value="' + key + '">' + value + '</option>');

            });

          }

        })
      });
    });


</script>
@endsection
