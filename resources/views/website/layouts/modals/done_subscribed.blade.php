<div class="modal fade" id="popdone" tabindex="-1" aria-labelledby="popdone" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="contain">
          <div class="pop-icon green">
            <img src="{{ asset('website/assets/images/popup/popdone.svg') }}" loading="lazy" alt="" />
          </div>

          <h1>
            @lang('welcome_to_village_diet')
          </h1>

          <p>
            @lang('login_number_has_sent_to_your_email')
            <a href="#">
              {{ auth()->user()?->email }}
            </a>
          </p>

          <div class="number-copy">
            <img src="{{ asset('website/assets/images/form/copy.svg') }}" loading="lazy" alt="" />

            <div class="data">
              <h2>
                {{ session('done_subscribed') }}
              </h2>

              <p>
                @lang('login_number')
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@if (session('done_subscribed'))
<script>
  $('#popdone').modal('show');
</script>
@endif
