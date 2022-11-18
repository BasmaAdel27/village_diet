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
                250 ر.س
              </span>
            </li>

            <li>
              <span class="name">
                قيمة الضرائب المضافة
              </span>

              <span class="price">
                20 ر.س
              </span>
            </li>

            <li>
              <span class="name">
                الخصم
              </span>

              <span class="price">
                لا يوجد
              </span>
            </li>

            <li class="data-contain">
              <a href="#" class="custom-btn">
                <span>
                  اضف كوبون خصم
                </span>
              </a>

              <form action="" class="form-contain">
                <div class="form-group span-form">
                  <input type="text" class="form-control" placeholder="متوسط عدد ساعات النوم" />

                  <button class="text-btn secondary-btn">
                    اضافة
                  </button>
                </div>
              </form>

              <div class="discount-contain">
                <div class="discount-data">
                  <h2>
                    Village@2022
                  </h2>

                  <p>
                    ينتهي في 25 نوفمبر 2022
                  </p>
                </div>

                <a href="#" class="delete">
                  <img src="{{ asset('website/assets/images/form/delete.svg') }}" loading="lazy" alt="">
                </a>
              </div>
            </li>

            <li>
              <span class="name bold">
                الإجمالي
              </span>

              <span class="price bold">
                260 ر.س
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-7 col-12">
        <form action="" class="form-contain">
          <h1>
            دفع الطلب
          </h1>

          <h2 class="sub-head">
            إختر طريقة الدفع المناسبة
          </h2>

          <div class="flex-data">
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                أبل باي
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                الدفع بالبطاقات البنكية

                <span>
                  ( فيزا - ماستر كارد - مدى )
                </span>
              </label>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-lg-6 col-12 px-2">
              <div class="form-group span-form">
                <input type="text" class="form-control" placeholder="رقم البطاقة" />
              </div>
            </div>

            <div class="col-lg-6 col-12 px-2">
              <div class="form-group span-form">
                <input type="text" class="form-control" placeholder="اسم صاحب البطاقة" />
              </div>
            </div>

            <div class="col-lg-6 col-12 px-2">
              <div class="form-group span-form">
                <input type="text" class="form-control" placeholder="تاريخ الانتهاء" />

                <span class="text-btn">
                  <img src="{{ asset('website/assets/images/form/calendar.svg') }}" alt="">
                </span>
              </div>
            </div>

            <div class="col-lg-6 col-12 px-2">
              <div class="form-group span-form">
                <input type="text" class="form-control" placeholder="CVV" />
              </div>
            </div>
          </div>

          <div class="wrapper mt-3">
            <input type="radio" class="radio-check" />

            <label class="radio-title bold-text">
              أوافق على الدفع التلقائي لتجديد الإشتراك شهريا
            </label>
          </div>

          <div class="button-contain">
            <a href="#" type="button" class="custom-btn" data-toggle="modal" data-target="#popdone">
              <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />

              <span>
                تسجيل
              </span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
