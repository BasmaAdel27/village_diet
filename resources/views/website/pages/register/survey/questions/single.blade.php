@include(view()->exists("website.pages.register.survey.questions.types.{$question->type}")
? "website.pages.register.survey.questions.types.{$question->type}"
: "website.pages.register.survey.questions.types.text",[
]
)
