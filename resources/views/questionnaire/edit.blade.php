@extends('layouts.app')


@section('content')


    <form action="{{ route('post_questionnaire_edit', array("id" => $questionnaire->id)) }}" method="post" enctype="multipart/form-data">
      @csrf
      タイトル：<input type="text" name="title" value="{{old('title',$questionnaire->title)}}"></br>
      @if($errors->has("title"))
        <p>{{ $errors->first("title") }}</p>
      @endif
      写真：</br>
      @if(!$questionnaire->picture==null)
          <img src="{{ asset($questionnaire->picture) }}" height="50" width="50">
          <a href="{{ route('get_questionnaire_remove_picture', array("id" => $questionnaire->id)) }}">削除</a> </br>
      @endif
      <input　type="file" name="picture" value="{{old('picture')}}"></br>

      終了時間：<input type="text" name="answering_end_time" value="{{old('answering_end_time', $questionnaire->answering_end_time)}}"></br>
      @if($errors->has("answering_end_time"))
        <p>{{ $errors->first("answering_end_time") }}</p>
      @endif
      パスワード：<input type="text" name="password_input" value="{{old('password_input', $questionnaire->password)}}"></br>
      @if($errors->has("password_input"))
        <p>{{ $errors->first("password_input") }}</p>
      @endif
        <input type="checkbox" name="random_question" value="1"
          @if($questionnaire->random_flg)
            checked
          @endif
        >問題ランダム表示<br />
      <input type="submit" value="提出">
    </form></br>
    <a href="{{ route("get_questionnaire_index")}}">戻る</a>


@endsection
