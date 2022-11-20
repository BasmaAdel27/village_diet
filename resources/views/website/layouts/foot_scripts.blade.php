<script src="{{ asset('website/assets/js/lib/jquery4.js') }}"></script>
<script src="{{ asset('website/assets/js/lib/popper.js') }}"></script>
<script src="{{ asset('website/assets/js/lib/bootstrap.js') }}"></script>
<script src="{{ asset('website/assets/js/lib/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('website/assets/js/lib/wow.min.js') }}"></script>
<script src="{{ asset('website/assets/js/main.js') }}"></script>
<script src={{ asset('js/sweetalert/sweetalert2.all.min.js') }}></script>
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
          $.each(result, function (key, value) {
            $("#state").append('<option value="' + key + '">' + value + '</option>');

          });

        }

      })
    });
    $("#license_img").hide();
    $("input[name$='is_certified']").click(function() {
      var test = $(this).val();
      if (test == 1) {
        $('#license_img').show();
      }
      if (test != 1) {
        $("#license_img").hide();
      }
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $("#btn-job-submit").click(function (event) {
       var form=document.getElementById('form');
      event.preventDefault();
      var data = new FormData(form);
      $.ajax({
        type: "POST",
        url: "{{route('website.register_trainer.store')}}",
        data: data,
        success: function (data) {
          $('#popdone2').modal('show');

          $('#form')[0].reset();
        },
        contentType: false,
        processData: false,
        error: function(message,error)
        {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'error',
            title: message.responseJSON.errors[0]
          })

        }
      });

    });
  });


</script>
@yield('scripts')
