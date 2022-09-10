$(document).ready(function () {
  $('.js-example-basic-multiple').select2();
  $('#summernote-ar,#summernote-en').summernote({
    inheritPlaceholder: true,
    tabsize: 1,
    height: 250,
    fontSize: 20,
  });

  //change language of dashboard
  window.addEventListener('load', () => {
    const select = document.querySelector('#change-locale');
    select.addEventListener('change', (e) => {
      window.location.href = e.target.value;
    });
  });
});
