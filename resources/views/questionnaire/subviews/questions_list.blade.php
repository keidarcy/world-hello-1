

@foreach($questionnaire->questions as $question)
    <h3>{{ $question->number }}.{{ $question->question }}
      <a href="{{ route('get_question_edit',['id' => $questionnaire->id, 'questionId'=>$question->id, 'type' => $question->mtb_question_type_id, 'action' => 'edit'])}}">編集</a>
      <a href="{{ route('get_question_delete', ['id' => $questionnaire->id, 'questionId'=>$question->id, 'type' => 'default', 'action' => 'delete'])}}">削除</a>

      @if($question->must_flg == 1)
         ※
      @endif
    </h3>





        @if($question->mtb_question_type_id == 1)
            @foreach($question->choices as $choice)
                <input type="checkbox" name="answer" value="{{ $choice->id }}">{{ $choice->choice }}<br />
            @endforeach

        @endif



        @if($question->mtb_question_type_id == 2)
            @foreach($question->choices as $choice)
                <input type="radio" name="answer" value="{{ $choice->id }}">{{ $choice->choice }}<br />
            @endforeach

        @endif




            @if($question->mtb_question_type_id == 3)
                <select name="select">
                  @foreach($question->choices as $choice)
                    <option value="{{ $choice->id }}">{{ $choice->choice }}</option>
                  @endforeach
                </select><br />
    
            @endif

            @if($question->mtb_question_type_id == 4)
                <input type="text" name="short"><br />

                @if(isset($question->limited_words_number))
                  最大文字数：{{ $question->limited_words_number }}<br />
                @endif

            @endif

            @if($question->mtb_question_type_id == 5)
                <textarea name="long"></textarea><br />

                @if(isset($question->limited_words_number))
                  最大文字数：{{ $question->limited_words_number }}
                @endif<br />

            @endif

@endforeach




<a href="{{ route('get_questionnaire_detail', array('id' => $questionnaire->id, "type" => "multi", 'action'=>'add')) }}">マルチ問題</a>
<a href="{{ route('get_questionnaire_detail', array('id' => $questionnaire->id, "type" => "single", 'action'=>'add')) }}">シングル問題</a>
<a href="{{ route('get_questionnaire_detail', array('id' => $questionnaire->id, "type" => "select", 'action'=>'add')) }}">セレクト問題</a>
<a href="{{ route('get_questionnaire_detail', array('id' => $questionnaire->id, "type" => "short", 'action'=>'add')) }}">ショット問題</a>
<a href="{{ route('get_questionnaire_detail', array('id' => $questionnaire->id, "type" => "long", 'action'=>'add')) }}">ロング問題</a></br>

<a href="{{ route('get_questionnaire_show',['id'=> $questionnaire->id]) }}">アンケート生成</a>
