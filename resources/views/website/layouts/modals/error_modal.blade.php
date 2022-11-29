<div class="modal fade" id="suspendedModal" tabindex="-1" aria-labelledby="suspended" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="contain">
          <div class="pop-icon red">
            <img src="{{ asset('website/assets/images/popup/suspended.svg') }}" loading="lazy" alt="" />
          </div>

          <h1>
            نأسف لعدم إكمال العملية
          </h1>

          <div class="button-contain">
            <a href="#" class="custom-btn">
              <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />

              <span>
                إعادة المحاولة
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@if (session('error_subscribed'))
<script>
  $('#suspendedModal').modal('show');
</script>
@endif
