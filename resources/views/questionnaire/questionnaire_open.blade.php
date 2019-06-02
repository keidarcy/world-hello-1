@extends('layouts.app')

@section('content')

    <form action="{{ route('post_answer_add') }}" method="post">
      @csrf
        <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
        <h1>{{ $questionnaire->title }}
            @if(!$questionnaire->picture==null)
            <img src="{{ asset($questionnaire->picture) }}" height="100" width="100">
            @endif
        </h1>

        @php $get_questions = [] @endphp
        @foreach($questionnaire->questions as $get_question)
          @php $get_questions[] = $get_question @endphp
        @endforeach

        @if($questionnaire->random_flg == 1)
            @php shuffle($get_questions) @endphp
        @endif

          @foreach($get_questions as $question)
            <h3>{{ $question->number }}.{{ $question->question }}

              @if($question->must_flg == 1)
                 ※
              @endif

            </h3>


                @if($question->mtb_question_type_id == 1)
                    @foreach($question->choices as $choice)
                        <input type="checkbox" name="{{$question->id}}[]" value="{{ $choice->id }}">{{ $choice->choice }}<br />
                    @endforeach
                    @if($question->others_flg == 1)
                        <input type="text" name="answer_for_multi"><br />
                    @endif
                @endif



                @if($question->mtb_question_type_id == 2)
                    @foreach($question->choices as $choice)
                        <input type="radio" name="{{ $question->id }}" value="{{ $choice->id }}">{{ $choice->choice }}<br />
                    @endforeach
                    @if($question->others_flg == 1)
                        <input type="text" name="answer_for_single"><br />
                    @endif
                @endif

                    @if($question->mtb_question_type_id == 3)
                        <select name="{{ $question->id }}">
                          @foreach($question->choices as $choice)
                            <option value="{{ $choice->id }}">{{ $choice->choice }}</option>
                          @endforeach
                        </select><br />
                    @endif

                    @if($question->mtb_question_type_id == 4)
                        <input type="text" name="{{ $question->id }}"><br />

                        @if(isset($question->limited_words_number))
                          最大文字数：{{ $question->limited_words_number }}<br />
                        @endif

                    @endif

                    @if($question->mtb_question_type_id == 5)
                        <textarea name="{{ $question->id }}"></textarea><br />

                        @if(isset($question->limited_words_number))
                          最大文字数：{{ $question->limited_words_number }}<br />
                        @endif

                    @endif
                @endforeach
      <input type="submit" value="提出!">
    </form>
@endsection
