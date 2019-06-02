

<h1>ショット問題</h1>
<form action="{{ route('post_question_add',["action"=>$action]) }}" method="post">
  @csrf
  番号:    <input type="number" name="number"><br />
  問題文:  <input type ="text" name="question"><br />
  必須性   <input type="checkbox" name="must_flg"  value="1"><br />
  文字数制限:<input type="number" name="limited_words_number"><br />

          <input type="hidden" name="mtb_question_type_id" value="4">
          <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
          <input type="submit" value="提出">
</form>
