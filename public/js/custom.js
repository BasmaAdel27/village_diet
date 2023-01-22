$(document).ready(function () {
  $('.js-example-basic-multiple').select2();
  $('#summernote-ar,#summernote-en,#summernote').summernote({
    inheritPlaceholder: true,
    tabsize: 1,
    height: 250,
    fontSize: 20,
  });

  //change language of dashboard
  const select = document.querySelector('#change-locale');
  select.addEventListener('change', (e) => {
    console.log(e.target.value);
    window.location = e.target.value;
  });

  $('.js-example-basic-multiple').on('select2:select', function (e) {
    var data = e.params.data.id;
    if (data == 'all') {
      $('.js-example-basic-multiple > option').prop('selected', 'selected');
      $('.js-example-basic-multiple').trigger('change');
    }
  });

  $('#print').on('click', function () {
    $('#print_this').printThis();
  });
});
