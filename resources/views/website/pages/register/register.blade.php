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

<section class="form-page">
  <div class="conatiner">
    <div class="row">
      <div class="col-lg-6 col-12 mx-auto">
        <div class="contain">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="tab-1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                aria-selected="true">
                تسجيل حساب
              </a>
            </li>

            <li class="nav-item" role="presentation">
              <a class="nav-link" id="tab-2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                aria-selected="false">
                إعادة تفعيل الإشتراك
              </a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
              <div class="heading">
                <h1>
                  تسجيل حساب
                </h1>

                <p>
                  في حالة إنضمامك للمرة الأولى على فيلج دايت ويفعل هذا الخيار في حالة الإنضمام للمرة الأولى للمنصة
                </p>
              </div>

              <form action="{{ route('website.register.store') }}" class="form-contain" method="POST" id="registerForm">
                @csrf
                <h2 class="sub-title">
                  معلومات أساسية
                </h2>

                <div class="row">
                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy"
                        alt="" />

                      <input type="text" name="first_name" value="{{ old('first_name') ?? '' }}" class="form-control"
                        placeholder="الاسم الأول" />
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy"
                        alt="" />

                      <input type="text" name="last_name" value="{{ old('last_name') ?? '' }}" class="form-control"
                        placeholder="الاسم الأخير" />
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/sms.svg') }}" class="icon" loading="lazy" alt="" />

                      <input type="text" name="email" value="{{ old('email') ?? '' }}" class="form-control"
                        placeholder="البريد الالكتروني" />
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/sms.svg') }}" class="icon" loading="lazy" alt="" />

                      <input type="text" value="{{ old('email_confirmation') ?? '' }}" name="email_confirmation"
                        class="form-control" placeholder="تأكيد البريد الالكتروني" />
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group phone">
                      <div class="phone-drop">
                        <div class="phone-contain">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />
                          <span>
                            +966
                          </span>
                        </div>
                      </div>

                      <input type="text" value="{{ old('phone') ?? '' }}" name="phone" class="form-control"
                        placeholder="رقم الجوال" />
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/calendar.svg') }}" class="icon" loading="lazy"
                        alt="" />
                      <input type="date" name="date_of_birth" class="form-control" placeholder="تاريخ الميلاد" />
                    </div>
                  </div>
                </div>

                <h2 class="sub-title section-contain">
                  معلومات الموقع
                </h2>

                <div class="row">
                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group select">
                      <img src="{{ asset('website/assets/images/form/flag.svg') }}" class="icon" loading="lazy"
                        alt="" />
                      <select class="form-control" name="country_id" id="country">
                        <option value="" hidden>
                          الدولة
                        </option>
                        @foreach ($countries as $id => $name)
                        <option value="{{ $id }}" {{ $id==old('country_id') ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group select">
                      <img src="{{ asset('website/assets/images/form/location.svg') }}" class="icon" loading="lazy"
                        alt="" />

                      <select class="form-control" value="{{ old('state_id') ?? '' }}" name="state_id" id="state">
                        <option value="" hidden>
                          المدينة
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group text-area no-margin">
                      <textarea name="address" class="form-control" placeholder=" ... العنوان بالتفصيل" id="" cols="30"
                        rows="10">
                      {{ old('address') ?? '' }}
                      </textarea>
                    </div>
                  </div>
                </div>

                <h2 class="sub-title section-contain">
                  حسابات السوشيال ميديا
                </h2>

                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/instagram_twotone.svg') }}" loading="lazy" alt=""
                    class="icon" />

                  <input type="text" value="{{ old('insta_link') ?? '' }}" name="insta_link" class="form-control"
                    placeholder="رابط حساب انستجرام" />
                </div>

                <div class="section-seprate">
                  <div class="wrapper">
                    <input type="radio" value="1" name="is_postal" class="radio-check" />
                    <label class="radio-title bold-text">
                      الإشتراك في النشرة البريدية لتلقي كل جديد
                    </label>
                  </div>
                </div>

                <div class="message">
                  <img src="{{ asset('website/assets/images/form/system.svg') }}" loading="lazy" alt="" />

                  <p>
                    النظام قائم علي التجديد التلقائي للاشتراك مع بداية تفعيل التطبيق وانه سيتم خصم قيمة الاشتراك بشكل
                    تلقائي كل شهر
                  </p>
                </div>

                <div class="button-contain">
                  <a href="#!" type="button" class="custom-btn" onclick="$('#registerForm').submit()">
                    <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
                    <span>
                      تسجيل
                    </span>
                  </a>
                </div>
              </form>
            </div>

            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
              <div class="heading">
                <h1>
                  إعادة تفعيل الإشتراك
                </h1>

                <p>
                  يتم إتاحة هذا الخيار للمستخدمين المسجلين بالفعل في النظام ليتم إعادة تفعيل إشتراكهم في فيلج دايت
                </p>
              </div>

              <form action="" class="form-contain">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/idnoac.svg') }}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="رقم الملف الشخصي" />
                </div>

                <div class="button-contain">
                  <a href="#" type="button" class="custom-btn" data-toggle="modal" data-target="#popdone">
                    <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />

                    <span>
                      تجديد
                    </span>
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  $(document).ready(function () {
      $('#country').on('change', function () {
      var country_id = this.value;
      $("#state").html('');
      $.ajax({
        url: "{{ route('admin.states') }}",
        type : "get",
        data : {
          'country_id' : country_id
        },
        success: function (result) {
          $('#state').html('<option value="">-- Select State --</option>');
          $.each(result, function (key, value) {
            $("#state").append('<option value="' + key + '">' + value + '</option>');

          });

        }

      })
    });
    });
</script>
@endsection
