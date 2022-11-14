<script>
  function ActiveElement(elem) {
    event.preventDefault();
    let form = $(elem).next('form');
    Swal.fire({
      title: "@lang('Are you sure?')",
      text: "@lang('You wont be able to revert this!')",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: "@lang('cancel')",
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: "@lang('Yes, activate it!')",
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
        Swal.fire("@lang('activated!')", "@lang('success')");
      }
    });
  }

</script>
