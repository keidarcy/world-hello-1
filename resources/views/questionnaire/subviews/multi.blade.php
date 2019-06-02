

<h1>マルチ問題</h1>
<form action="{{ route('post_question_add',["action"=>$action]) }}" method="post">
  @csrf
  番号:    <input type="number" name="number">	<br />
  問題文:  <textarea name ="question"></textarea>	<br />

  <div id="choices">
    <div class="choice_set">
      選択肢:  <input type="text" name="choice[]">
      <button class="delete_choice">削除</button><br />
    </div>
  </div>
    <button id="add_choice">追加</button><br />

  必須性   <input type="checkbox" name="must_flg" value="1">	<br />
  その他   <input type="checkbox" name="others_flg" value="1"><br />

          <input type="hidden" name="mtb_question_type_id" value="1">
          <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
          <input type="submit" value="提出">	<br />
</form>



</div>



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
