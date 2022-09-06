<script>
  function DeleteElement() {
  event.preventDefault();
  let form = event.target.form;

  Swal.fire({
    title: "@lang('Are you sure?')",
    text: "@lang('You wont be able to revert this!')",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: "@lang('Yes, delete it!')",
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit();
      Swal.fire("@lang('Deleted!')", 'success');
    }
  });
}

</script>
