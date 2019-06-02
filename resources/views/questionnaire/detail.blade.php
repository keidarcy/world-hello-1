@extends('layouts.app')

@section('content')
  <div align="center">
      <h1>{{ $questionnaire->title }}</h1>
  </div>

<div class="row">
  <div class="col-md-6" style="background-color:#d5f4e6">
      @include("questionnaire.subviews.questions_list", array('questionnaire' => $questionnaire, 'type' =>$type))
  </div>

  <div class="col-md-6" align="center" style="background-color:#f18973">
      @if($type=='default' && $action == 'default' )
        @include('questionnaire.subviews.default')
      @endif
      @if($type=='multi' && $action== 'add')
        @include('questionnaire.subviews.multi',array('questionnaire' => $questionnaire, 'type' =>$type))
      @endif
      @if($type=='single' && $action== 'add')
        @include('questionnaire.subviews.single',array('questionnaire' => $questionnaire, 'type' =>$type))
      @endif
      @if($type=='select' && $action== 'add')
        @include('questionnaire.subviews.select',array('questionnaire' => $questionnaire, 'type' =>$type))
      @endif
      @if($type=='short' && $action== 'add')
        @include('questionnaire.subviews.short',array('questionnaire' => $questionnaire, 'type' =>$type))
      @endif
      @if($type=='long' && $action== 'add')
        @include('questionnaire.subviews.long',array('questionnaire' => $questionnaire, 'type' =>$type))
      @endif

      @if($type==1 && $action =='edit')
        @include('questionnaire.subviews.multi_edit',array('questionnaire' => $questionnaire, 'question' => $question, 'type' =>$type))
      @endif

      @if($type==2 && $action =='edit')
        @include('questionnaire.subviews.single_edit',array('questionnaire' => $questionnaire, 'question' => $question, 'type' =>$type))
      @endif

      @if($type==3 && $action =='edit')
        @include('questionnaire.subviews.select_edit',array('questionnaire' => $questionnaire, 'question' => $question, 'type' =>$type))
      @endif

      @if($type==4 && $action =='edit')
        @include('questionnaire.subviews.short_edit',array('questionnaire' => $questionnaire, 'question' => $question, 'type' =>$type))
      @endif

      @if($type==5 && $action =='edit')
        @include('questionnaire.subviews.long_edit',array('questionnaire' => $questionnaire, 'question' => $question, 'type' =>$type))
      @endif


  </div>
</div>



@endsection
