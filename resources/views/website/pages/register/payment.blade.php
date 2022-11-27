@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        التسجيل وإعادة الإشتراك
      </h1>

      <p>
        قم بالتسجيل في حالة عدم وجود حساب لديك أو إعادة الإشتراك في حالة إنهائه أو تعطيله
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
            تفاصيل الإشتراك
          </h1>

          <ul class="list-data">
            <li>
              <span class="name">
                قيمة الاشتراك الشهري
              </span>

              <span class="price">
                {{ $netSubscription }} ر.س
              </span>
            </li>

            <li>
              <span class="name">
                قيمة الضرائب المضافة
              </span>

              <span class="price">
                {{ $taxAmount }} ر.س
              </span>
            </li>

            <li>
              <span class="name">
                الخصم
              </span>

              <span class="price" id="discount">
                {{ $discount }} ر.س
              </span>
            </li>

            <li class="data-contain">
              <form class="form-contain" action="">
                <div class="form-group span-form">
                  <input type="text" name="code" class="form-control" placeholder=" الكوبون"
                    value="{{ request('code') }}" />
                  <input type="submit" class="text-btn secondary-btn" value="اضافة">

                </div>
              </form>
            </li>

            <li>
              <span class="name bold">
                الإجمالي
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
            دفع الطلب
          </h1>
          <div class="wrapper mt-3">
            <input type="radio" class="radio-check" name="renew" value="1" />
            <label class="radio-title bold-text">
              أوافق على الدفع التلقائي لتجديد الإشتراك شهريا
            </label>
          </div>
          <div class="button-contain">
            <a href="#!" type="button" class="custom-btn" id="submitBtn" onclick="$('#paymentForm').submit()">
              <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
              <span>
                الدفع
              </span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="popdone" tabindex="-1" aria-labelledby="popdone" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="contain">
          <div class="pop-icon green">
            <img src="{{ asset('website/assets/images/popup/popdone.svg') }}" loading="lazy" alt="" />
          </div>

          <h1>
            Village Diet مرحبا بك في
          </h1>

          <p>
            تم ارسال ايميل به الرقم الشخصي الخاص بك لتفعيل التطبيق على إيميلك

            <a href="#">
              Info@gmail.com
            </a>
          </p>

          <div class="number-copy">
            <img src="{{ asset('website/assets/images/form/copy.svg') }}" loading="lazy" alt="" />

            <div class="data">
              <h2 id="user_number">

              </h2>

              <p>
                رقمك التعريفي
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
          $('#user_number').text(result.data.user_number);
          $('#popdone').modal('show');
        },
        error : function(response){
            $('#subscription_active').modal('show');
        }

      })
    return false;
  })
</script>
@endsection
