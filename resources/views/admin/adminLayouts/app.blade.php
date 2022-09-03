<!DOCTYPE html>
<html lang="en" dir="ltl">
@include('admin.adminLayouts.header')

<body>
<!-- Page container -->
<div class="container-scroller">

        <!-- Main navbar -->
    @include('admin.adminLayouts.navbar')
        <!-- /main navbar -->

        <!-- Main sidebar -->
    <div class="container-fluid page-body-wrapper">
        @include('admin.adminLayouts.sidebar')
        <!--/Main sidebar -->

        <!-- Main content -->
        @yield('content')
        <!-- /main content -->


    </div>

</div>
<!-- /page container -->



@yield('script')
<!-- plugins:js -->
<script src={{url('adminPanel/vendors/base/vendor.bundle.base.js')}}></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src={{url('adminPanel/vendors/chart.js/Chart.min.js')}}></script>
<script src={{url('adminPanel/vendors/datatables.net/jquery.dataTables.js')}}></script>
<script src={{url('adminPanel/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src={{url('adminPanel/js/off-canvas.js')}}></script>
<script src={{url('adminPanel/js/hoverable-collapse.js')}}></script>
<script src={{url('adminPanel/js/template.js')}}></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src={{url('adminPanel/js/dashboard.js')}}></script>
<script src={{url('adminPanel/js/data-table.js')}}></script>
<script src={{url('adminPanel/js/jquery.dataTables.js')}}></script>
<script src={{url('adminPanel/js/dataTables.bootstrap4.js')}}></script>
<!-- End custom js for this page-->
<script src={{url('adminPanel/js/jquery.cookie.js')}} type="text/javascript"></script>
</body>
</html>
