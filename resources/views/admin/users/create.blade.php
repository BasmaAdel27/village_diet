@extends('admin.app')
@section('title') @lang('users') @endsection
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('users')</h2>
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">@csrf
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
      $("#state").html('');
      $.ajax({
        url: "{{ route('admin.states') }}",
        type : "get",
        data : {
          'country_id' : country_id
        },
        success: function (result) {
          $('#state').html('<option value="">اختر المدينة</option>');
          $.each(result, function (key, value) {
            $("#state").append('<option value="' + key + '">' + value + '</option>');

          });

        }

      })
    });
    });


</script>
@endsection
