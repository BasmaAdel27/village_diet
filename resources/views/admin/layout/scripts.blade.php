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
<script src="../../vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->

<!-- endinject -->
<!-- Custom js for this page-->
<script src={{ asset('adminPanel/js/file-upload.js')}}></script>
<!-- End custom js for this page-->
<script type="text/javascript">
  $(function () {

    var table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "/admin/users/list",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'email', name: 'email'},
        {data: 'date_of_birth', name: 'date_of_birth'},
        {data: 'phone', name: 'phone'},
        {
          data: 'action',
          name: 'action',
          orderable: true,
          searchable: true
        },
      ]
    });

  });
</script>
@yield('scripts')
