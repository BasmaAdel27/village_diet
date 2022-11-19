@foreach($survey->sections as $section)
<h2 class="sub-title section-contain">{{ $section->name }}</h2>
@include('website.pages.register.survey.sections.single')
@endforeach

@foreach($survey->questions()->withoutSection()->get() as $question)
@include('website.pages.register.survey.questions.single')
@endforeach
