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
          <div class="heading no-top-margin">
            <h1>
              تسجيل حساب
            </h1>

            <p>
              نحن نرغب في معرفة المزيد عنك لكي نتمكن من خدمتك بشكل أفضل
            </p>
          </div>

          <form action="" class="form-contain">
            <h2 class="sub-title">
              ماذا تريد ان تحقق خلال ال 4 اسابيع القادمة؟
            </h2>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                حياة صحية بشكل عام
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                زيادة الأداء
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                زيادة القو ة
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                الحفاظ على الوزن
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                خسارة الوزن
              </label>
            </div>

            <h2 class="sub-title section-contain">
              مستوى التوتر والضغط اليومي
            </h2>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                عالي جدا
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                عالي
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                متوسط
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                منخفض
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                بسيط جدا
              </label>
            </div>

            <div class="section-seprate">
              <div class="row">
                <div class="col-lg-6 col-12 px-2">
                  <div class="form-group span-form">
                    <input type="text" class="form-control" placeholder="متوسط عدد ساعات النوم" />

                    <span class="text-btn">
                      ساعة
                    </span>
                  </div>
                </div>

                <div class="col-lg-6 col-12 px-2">
                  <div class="form-group span-form">
                    <input type="text" class="form-control" placeholder="الوزن الحالي" />

                    <span class="text-btn">
                      كجم
                    </span>
                  </div>
                </div>

                <div class="col-lg-6 col-12 px-2">
                  <div class="form-group span-form">
                    <input type="text" class="form-control" placeholder="الطول" />

                    <span class="text-btn">
                      سم
                    </span>
                  </div>
                </div>

                <div class="col-lg-6 col-12 px-2">
                  <div class="form-group span-form">
                    <input type="text" class="form-control" placeholder="المهنة" />
                  </div>
                </div>
              </div>
            </div>

            <h2 class="sub-title section-contain">
              الحالة الإجتماعية
            </h2>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  أعزب
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  متزوج
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  مطلق
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  أرمل
                </label>
              </div>
            </div>

            <h3 class="sub-head">
              هل لديك أطفال ؟
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  نعم
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  لا
                </label>
              </div>
            </div>

            <h3 class="sub-head">
              الجنس
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  ذكر
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  أنثى
                </label>
              </div>
            </div>

            <h2 class="sub-title section-contain">
              مستوى الرياضة
            </h2>

            <h3 class="sub-head">
              هل تمارس الرياضة ؟
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  لا أمارس الرياضة
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  مبتدئ
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  متقدم
                </label>
              </div>
            </div>

            <h3 class="sub-head">
              ما هي الادوات الرياضية المتوفرة لديك ؟
            </h3>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                نادي رياضي متكامل
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                نادي رياضي بسيط في المنزل
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                لا يوجد
              </label>
            </div>

            <h3 class="sub-head">
              هل انت مدخن ؟
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  نعم
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  لا
                </label>
              </div>
            </div>

            <h2 class="sub-title section-contain">
              مستوى النشاط اليومي
            </h2>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                عالي – اتحرك وامشي طوال اليوم
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                متوسط – امشي واتحرك قليلا
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                منخفض - لا اتحرك كثيرا
              </label>
            </div>

            <h2 class="sub-title section-contain">
              الأكل
            </h2>

            <h3 class="sub-head">
              كم مرة تأكل خارج المنزل ؟
            </h3>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                كل يوم
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                6-4 مرات في الاسبوع
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                3-1 مرات في الاسبوع
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                مرة واحدة في الأسبوع
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                لا أتناول غير طعام المنزل
              </label>
            </div>

            <h3 class="sub-head">
              هل تستمتع بتناول الافطار مبكرا ؟
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  نعم
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  لا
                </label>
              </div>
            </div>

            <h3 class="sub-head">
              هل لديك حساسية من بعض الأطعمة
            </h3>

            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  نعم
                </label>
              </div>

              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" />

                <label class="radio-title">
                  لا
                </label>
              </div>
            </div>

            <div class="form-group text-area">
              <textarea name="" class="form-control" placeholder="  ... قم بتحديد الأطعمة" id="" cols="30"
                rows="10"></textarea>
            </div>

            <h3 class="sub-head">
              بشكل عام، ما هي انواع الطعام المفضلة لديك ؟
            </h3>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                لحوم
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                نباتي
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                طعام بحري
              </label>
            </div>

            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" />

              <label class="radio-title">
                Vegan - فيجن
              </label>
            </div>

            <h2 class="sub-title section-contain">
              القياسات
            </h2>

            <p class="desc">
              يرجى تقديم القياسات التالية وحفظها للرجوع إليها في المستقبل
            </p>

            <div class="row">
              <div class="col-lg-6 col-12 px-2">
                <p class="lable">
                  أعلى الذراع في المنتصف بين الكوع والكتف
                </p>

                <div class="form-group span-form">
                  <input type="text" class="form-control" placeholder="ادخل القياس" />

                  <span class="text-btn">
                    سم
                  </span>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <p class="lable">
                  قياس الوسط 5 سم اسفل الصرة
                </p>

                <div class="form-group span-form">
                  <input type="text" class="form-control" placeholder="ادخل القياس" />

                  <span class="text-btn">
                    سم
                  </span>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <p class="lable">
                  قياس الوسط 5 سم فوق الصرة
                </p>

                <div class="form-group span-form">
                  <input type="text" class="form-control" placeholder="ادخل القياس" />

                  <span class="text-btn">
                    سم
                  </span>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <p class="lable">
                  قياس الوسط عند الصرة
                </p>

                <div class="form-group span-form">
                  <input type="text" class="form-control" placeholder="ادخل القياس" />

                  <span class="text-btn">
                    سم
                  </span>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <p class="lable">
                  أعلى الساق في المنتصف بين الركبة والورك
                </p>

                <div class="form-group span-form">
                  <input type="text" class="form-control" placeholder="ادخل القياس" />

                  <span class="text-btn">
                    سم
                  </span>
                </div>
              </div>
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
