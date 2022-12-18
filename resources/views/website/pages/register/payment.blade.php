@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang('register_and_rejoin')
      </h1>
      <p>
        @lang('register_if_you_donot_have_one')
      </p>
    </div>
  </div>
</section>

<section class="payments">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 mb-4">
        <div class="subscribe-details">
          <h1>
            @lang('subscription_details')
          </h1>

          <ul class="list-data">
            <li>
              <span class="name">
                @lang('monthly_subscription_amount')
              </span>

              <span class="price">
                {{ $netSubscription }} ر.س
              </span>
            </li>

            <li>
              <span class="name">
                @lang('vat_tax_amount')
              </span>

              <span class="price">
                {{ $taxAmount }} ر.س
              </span>
            </li>

            <li>
              <span class="name">
                @lang('discount')
              </span>

              <span class="price" id="discount">
                {{ $discount }} ر.س
              </span>
            </li>

            <li class="data-contain">
              <form class="form-contain" action="">
                <div class="form-group span-form">
                  <input type="text" name="code" class="form-control" placeholder="@lang('coupon')"
                    value="{{ request('code') }}" />
                  <input type="submit" class="text-btn secondary-btn" value="@lang('add')">

                </div>
              </form>
            </li>

            <li>
              <span class="name bold">
                @lang('total_subscription')
              </span>

              <span class="price bold" id="total">
                {{ $total }} ر.س
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-7 col-12">
        <form action="{{ route('website.payment.store',$user) }}" class="form-contain" method="POST" id="paymentForm">
          @csrf
          <input type="hidden" name="code" value="{{ request('code') }}">
          <h1>
            @lang('pay_order')
          </h1>
          <div class="wrapper mt-3">
            <input type="radio" class="radio-check" name="renew" value="1" disabled checked />
            <label class="radio-title bold-text">
              @lang('accept_resubscribe')
            </label>
          </div>
          <div class="button-contain">
            <a href="#!" type="button" class="custom-btn" id="submitBtn" onclick="$('#paymentForm').submit()">
              <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
              <span>
                @lang('payment')
              </span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  $('#paymentForm').submit(function(){
    $("#submitBtn").addClass('disable-click');
      form =$('#paymentForm');
      $.ajax({
        url: "{{ route('website.payment.store',$user->id) }}",
        type : "POST",
        data : form.serialize(),
        success: function (result) {
          window.location.replace(result.url);
        },
        error : function(response){
            $('#subscription_active').modal('show');
        }

      })
    return false;
  })
</script>
@endsection
