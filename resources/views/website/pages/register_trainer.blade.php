@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        التسجيل كمدرب
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
          <div class="heading no-top-margin">
            <h1>
              تسجيل كمدرب
            </h1>

            <p>
              نحن نرغب في معرفة المزيد عنك لكي نتمكن من خدمتك بشكل أفضل
            </p>
          </div>

          <form action="" class="form-contain">
            <h2 class="sub-title">
              معلومات أساسية
            </h2>

            <div class="row">
              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="الاسم المدرب" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/sms.svg') }}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="البريد الالكتروني" />
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

                    <ul class="list">
                      <li>
                        <a href="#">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />

                          <span>
                            السعودية
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />

                          <span>
                            السعودية
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />

                          <span>
                            السعودية
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />

                          <span>
                            السعودية
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />

                          <span>
                            السعودية
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="#">
                          <img src="{{ asset('website/assets/images/form/suadia.png') }}" loading="lazy" alt="" />

                          <span>
                            السعودية
                          </span>
                        </a>
                      </li>
                    </ul>
                  </div>

                  <input type="text" class="form-control" placeholder="رقم الجوال" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/idnoac.svg') }}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="المهنة الحالية" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-data">
                  <label for="">
                    صورة شخصية
                  </label>

                  <div class="file-upload">
                    <input type="file" name="uploadFile" id="uploadFile" />

                    <label for="uploadFile" class="file-upload-section">
                      <img src="{{ asset('website/assets/images/form/document_upload.svg') }}" alt="">

                      <h2>
                        ارفق صورة شخصية
                      </h2>

                      <p>
                        Max Size : 5MB
                      </p>
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-data">
                  <label for="">
                    السيرة الذاتية
                  </label>

                  <div class="file-upload">
                    <input type="file" name="uploadFile" id="uploadFile" />

                    <label for="uploadFile" class="file-upload-section">
                      <img src="{{ asset('website/assets/images/form/document_upload.svg') }}" alt="">

                      <h2>
                        ارفق السيرة الذاتية
                      </h2>

                      <p>
                        PDF or Word
                      </p>
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group text-area">
                  <textarea name="" class="form-control" placeholder=" اكتب نبذة عنك ... " id="" cols="30"
                    rows="10"></textarea>
                </div>
              </div>
            </div>

            <h2 class="sub-title section-contain">
              معلومات الموقع
            </h2>

            <div class="row">
              <div class="col-lg-6 col-12 px-2">
                <div class="form-group select">
                  <img src="{{ asset('website/assets/images/form/flag.svg') }}" class="icon" loading="lazy" alt="" />

                  <select class="form-control" name="" id="">
                    <option value="" hidden>
                      الدولة
                    </option>

                    <option value="السعودية">
                      السعودية
                    </option>

                    <option value="مصر">
                      مصر
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group select">
                  <img src="{{ asset('website/assets/images/form/location.svg') }}" class="icon" loading="lazy"
                    alt="" />

                  <select class="form-control" name="" id="">
                    <option value="" hidden>
                      المدينة
                    </option>

                    <option value="">
                      السعودية
                    </option>

                    <option value="">
                      مصر
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group text-area no-margin">
                  <textarea name="" class="form-control" placeholder=" ... العنوان بالتفصيل" id="" cols="30"
                    rows="10"></textarea>
                </div>
              </div>
            </div>

            <h2 class="sub-title section-contain">
              حسابات السوشيال ميديا
            </h2>

            <div class="row">
              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/instagram_twotone.svg') }}" loading="lazy" alt=""
                    class="icon" />

                  <input type="text" class="form-control" placeholder="رابط حساب انستجرام" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/twitter.svg') }}" loading="lazy" alt="" class="icon" />

                  <input type="text" class="form-control" placeholder="رابط حساب تويتر" />
                </div>
              </div>
            </div>

            <h2 class="sub-title section-contain">
              الشكل البدني
            </h2>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                رفيع (slim)
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                رياضي
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                عضلات مفتولة
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                متوسط البنية
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                وزن زائد قليلا
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                وزن زائد
              </label>
            </div>

            <h3 class="sub-head">
              هل لديك ترخيص فعال ؟
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  نعم لدي ترخيص
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  لا ليس لدي ترخيص
                </label>
              </div>
            </div>

            <div class="form-data">
              <label for="">
                صورة الترخيص
              </label>

              <div class="file-upload">
                <input type="file" name="uploadFile" id="uploadFile" />

                <label for="uploadFile" class="file-upload-section">
                  <img src="{{ asset('website/assets/images/form/document_upload.svg') }}" alt="">

                  <h2>
                    ارفق صورة الترخيص
                  </h2>

                  <p>
                    Max Size : 5MB
                  </p>
                </label>
              </div>
            </div>

            <div class="form-group text-area">
              <textarea name="" class="form-control" placeholder=" سبب تقديمك لطلب الانضمام.... " id="" cols="30"
                rows="10"></textarea>
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
  </div>
</section>

@endsection
