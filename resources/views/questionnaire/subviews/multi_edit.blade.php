

<h1>マルチ問題</h1>
<form action="{{ route('post_question_edit',['id' => $questionnaire->id, 'questionId'=>$question->id, 'type' => $question->mtb_question_type_id, 'action' => 'edit']) }}" method="post">
  @csrf
  番号:    <input type="number" name="number" value="{{ old('number',$question->number) }}">	<br />
  問題文:  <textarea name ="question">{{ old('question',$question->question) }}</textarea>	<br />


      <div id="choices">
        <div class="choice_set">
          @foreach($question->choices as $choice)
      選択肢：<input type="text" name="choice[]" value="{{ old('choice1',$choice->choice) }}">
      <button class="delete_choice">削除</button><br />
      @endforeach
    </div>
  </div>
    <button id="add_choice">追加</button><br />



  @php $must_flg = isset($question->must_flg) ? 'checked' : null @endphp
  @php $others_flg = isset($question->others_flg) ? 'checked' : null @endphp

  必須性   <input type="checkbox" name="must_flg" value="1" {{ $must_flg }}><br />
  その他   <input type="checkbox" name="others_flg" value="1" {{ $others_flg }}><br />

          <input type="hidden" name="mtb_question_type_id" value="1" >
          <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
          <input type="submit" value="訂正">	<br />
</form>

<script>
  $(document).ready(function(){
      $("#add_choice").click(function(){
          $("#choices").append('<div class="choice_set">選択肢:  <input type="text" name="choice[]"> <button class="delete_choice">削除</button><br /></div>');

          $(".delete_choice").click(function(){
              $(this).parent().remove();
                return false;
          });
        return false;
      });
  });
</script>
