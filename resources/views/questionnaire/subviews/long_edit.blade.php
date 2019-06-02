

<h1>ロング問題</h1>
<form action="{{ route('post_question_edit',['id' => $questionnaire->id, 'questionId'=>$question->id, 'type' => $question->mtb_question_type_id, 'action' => 'edit']) }}" method="post">
  @csrf
  番号:    <input type="number" name="number" value="{{ old('number',$question->number) }}">	<br />
  問題文:  <textarea name ="question">{{ old('question',$question->question) }}</textarea>	<br />




  @php $must_flg = isset($question->must_flg) ? 'checked' : null @endphp
  必須性   <input type="checkbox" name="must_flg" value="1" {{ $must_flg }}><br />
          <input type="hidden" name="mtb_question_type_id" value="4" >
          <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
          <input type="submit" value="訂正">	<br />
</form>
