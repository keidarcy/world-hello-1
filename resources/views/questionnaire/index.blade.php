@extends('layouts.app')

@section('content')
  @if($questionnaires->count() ==0)
    <p>nothing to show</p>
  @else
    <table class="table" border="1">
      <thead>
        <tr>
          <th>アンケート名</th>
          <th>状態</th>
          <th>写真</th>
          <th>作成時間</th>
          <th>配布開始時間</th>
          <th>配布終了時間</th>
          <th>終了までの時間</th>
          <th>人数</th>
          <th>詳細</th>
          <th>削除</th>
          <th>結果</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questionnaires as $questionnaire)
          <tr>
            <td>
              <a href="{{ route('get_questionnaire_edit', array('id' => $questionnaire->id)) }}">
                {{$questionnaire->title}}
              </a>
            </td>
            <td>
              @if($questionnaire->mtb_questionnaire_status_id==1)
                編集中
              @endif
              @if($questionnaire->mtb_questionnaire_status_id==2)

                <a href="{{ route('get_questionnaire_open', ['id'=>$questionnaire->id]) }}">回答中</a>
              @endif
              @if($questionnaire->mtb_questionnaire_status_id==3)
                回答済
              @endif
            </td>

            @if(!$questionnaire->picture==null)
              <td><img src="{{ asset($questionnaire->picture) }}" height="50" width="50"></td>
            @else<td></td>
            @endif
            <td>{{$questionnaire->editing_start_time}}</td>
            <td>{{$questionnaire->answering_start_time}}</td>
            <td>{{$questionnaire->answering_end_time}}</td>
            <td id="left_time_{{ $questionnaire->id }}"></td>
            <td id="max"></td>
            <td>
            @if($questionnaire->mtb_questionnaire_status_id==1)
                <a href="{{ route('get_questionnaire_detail', array('id' => $questionnaire->id)) }}">詳細</a>
            @endif
            </td>
            <td><a href="{{ route('get_questionnaire_delete', array('id' => $questionnaire->id)) }}">削除</a></td>
            <td>
              @if($questionnaire->mtb_questionnaire_status_id==2)
                <a href="{{ route('get_answer_detail',['id'=>$questionnaire->id]) }}">結果</a>
              @endif
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
  <button><a href="{{ route('get_questionnaire_add') }}">新規アンケート</a></button>
@endsection

<script type="text/javascript">

  window.setInterval(function(){
        $.get("/api/questionnaire/5/answer_number",function(data,status){
          $("#max").text(data.number);
        });
      },1000);
</script>

<script type="text/javascript">

  window.setInterval(function(){
        $.get("/api/user/{{ Auth::id() }}/left_time",function(data,status){
            for(var key in data){
              $("#left_time_"+key).text(data[key]);
            }
          });
        },1000);
</script>
