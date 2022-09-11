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
<script src={{ asset('adminPanel/js/file-upload.js') }}></script>
<script src={{ asset('adminPanel/js/select2.min.js') }}></script>
<script src={{ asset('js/sweetalert/sweetalert2.all.min.js') }}></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@if (app()->getLocale() == 'ar')
<script src="{{ asset('adminPanel/vendors/bootstrap-rtl/bootstrap.js') }}"></script>
@endif
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/printThis.js') }}"></script>
@yield('scripts')
