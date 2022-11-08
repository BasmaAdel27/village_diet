@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        اتصل بنا
      </h1>

      <p>
        في حالة كان لديك إي إستفسار لا تترد بالتواصل معنا
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
              ارسال رسالة
            </h1>

            <p>
              قم بارسال رسالة الان الى الإدارة والرد عليك في اسرع وقت ,, معك أينما كنت
            </p>
          </div>

          <form action="" class="form-contain">
            <div class="row">
              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="assets/images/form/user.svg" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="الاسم بالكامل" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group select">
                  <img src="assets/images/form/user.svg" class="icon" loading="lazy" alt="" />

                  <select class="form-control" name="" id="">
                    <option value="" hidden>
                      نوع المستخدم
                    </option>

                    <option value="نوع المستخدم">
                      نوع المستخدم
                    </option>

                    <option value="نوع المستخدم">
                      نوع المستخدم
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="assets/images/form/sms.svg" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="البريد الالكتروني" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group select">
                  <img src="assets/images/form/user.svg" class="icon" loading="lazy" alt="" />

                  <select class="form-control" name="" id="">
                    <option value="" hidden>
                      عنوان الرسالة
                    </option>

                    <option value="">
                      عنوان الرسالة
                    </option>

                    <option value="">
                      عنوان الرسالة
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group text-area">
                  <textarea name="" class="form-control" placeholder=" ... اكتب نص الرسالة" id="" cols="30"
                    rows="10"></textarea>
                </div>
              </div>
            </div>

            <div class="button-contain">
              <a href="#" type="button" class="custom-btn" data-toggle="modal" data-target="#popdone">
                <img src="assets/images/icons/arrow.svg" loading="lazy" alt="" />

                <span>
                  ارسال رسالة
                </span>
              </a>
            </div>
          </form>
        </div>

        <div class="map-contain">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d54708.5528184499!2d31.392162650000003!3d31.018320799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1667855570043!5m2!1sen!2seg"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="contact-info">
          <div class="row">
            <div class="col-lg-4 col-12 mb-3">
              <a href="#">
                <img src="assets/images/contact/message.svg" loading="lazy" alt="" />

                <div>
                  <h2>
                    البريد الالكتروني
                  </h2>

                  <p>
                    Mail@villagediet.com
                  </p>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-12 mb-3">
              <a href="#" class="padding">
                <img src="assets/images/contact/whatsapp.svg" loading="lazy" alt="" />

                <div>
                  <h2>
                    رقم الواتساب
                  </h2>

                  <p>
                    96656545545+
                  </p>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-12 mb-3">
              <a href="#">
                <img src="assets/images/contact/call.svg" loading="lazy" alt="" />

                <div>
                  <h2>
                    رقم الجوال
                  </h2>

                  <p>
                    96656545545+
                  </p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
