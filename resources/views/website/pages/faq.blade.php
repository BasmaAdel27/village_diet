@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        أسئلة شائعة
      </h1>

      <p>
        مجموعة من الأسئلة والأجوبة المتعارف عليها
      </p>
    </div>
  </div>
</section>

<section class="trainer">
  <div class="container">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#collapseOne"
              aria-expanded="true" aria-controls="collapseOne">
              كيف يمكن الإنضمام لمنصة فيلج دايت ؟
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              تسعى المنصة أن تصبح الانطلاقة الوطنية الجديدة داخل المجتمع السعودي في عالم الصحة واللياقة البدنية. عبر
              تجميع وعرض كافة المدربين التربية البدنية داخل المنصة وتقديم خدمة المتابعة الأونلاين عبر تواصل مباشر بين
              الطرفين. تم التقابل
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="false" aria-controls="collapseTwo">
              كيف يمكن الإنضمام لمنصة فيلج دايت ؟
            </button>
          </h2>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              تسعى المنصة أن تصبح الانطلاقة الوطنية الجديدة داخل المجتمع السعودي في عالم الصحة واللياقة البدنية. عبر
              تجميع وعرض كافة المدربين التربية البدنية داخل المنصة وتقديم خدمة المتابعة الأونلاين عبر تواصل مباشر بين
              الطرفين. تم التقابل
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseThree"
              aria-expanded="false" aria-controls="collapseThree">
              كيف يمكن الإنضمام لمنصة فيلج دايت ؟
            </button>
          </h2>
        </div>

        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              تسعى المنصة أن تصبح الانطلاقة الوطنية الجديدة داخل المجتمع السعودي في عالم الصحة واللياقة البدنية. عبر
              تجميع وعرض كافة المدربين التربية البدنية داخل المنصة وتقديم خدمة المتابعة الأونلاين عبر تواصل مباشر بين
              الطرفين. تم التقابل
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
