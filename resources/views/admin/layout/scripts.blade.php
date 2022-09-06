<script src={{ asset('adminPanel/vendors/base/vendor.bundle.base.js') }}></script>
<script src={{ asset('adminPanel/vendors/chart.js/Chart.min.js') }}></script>
<script src={{ asset('adminPanel/vendors/datatables.net/jquery.dataTables.js') }}></script>
<script src={{ asset('adminPanel/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}></script>
<script src={{ asset('adminPanel/js/off-canvas.js') }}></script>
<script src={{ asset('adminPanel/js/hoverable-collapse.js') }}></script>
<script src={{ asset('adminPanel/js/template.js') }}></script>
<script src={{ asset('adminPanel/js/dashboard.js') }}></script>
<script src={{ asset('adminPanel/js/data-table.js') }}></script>
<script src={{ asset('adminPanel/js/jquery.dataTables.js') }}></script>
<script src={{ asset('adminPanel/js/dataTables.bootstrap4.js') }}></script>
<script src={{ asset('adminPanel/js/jquery.cookie.js') }} type="text/javascript"></script>

<script src={{ asset('adminPanel/js/file-upload.js')}}></script>
<<<<<<< HEAD
<script src={{asset('adminPanel/js/select2.min.js')}}></script>
<!-- End custom js for this page-->
<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
</script>
<script src="{{ asset('js/sweetalert/sweetalert2.all.min.js') }}"></script>
@yield('scripts')
