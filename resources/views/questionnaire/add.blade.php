@extends('layouts.app')


@section('content')



    <form action="{{ route('post_questionnaire_add') }}" method="post" enctype="multipart/form-data">
      @csrf
      タイトル：<input　type="text" name="title" value="{{old('title')}}"></br>
      @if($errors->has("title"))
        <p>{{ $errors->first("title") }}</p>
      @endif
      写真：<input　type="file" name="picture" value="{{old('picture')}}"></br>
      終了時間：<input　type="text" name="answering_end_time" value="{{old('answering_end_time')}}"></br>
      @if($errors->has("answering_end_time"))
        <p>{{ $errors->first("answering_end_time") }}</p>
      @endif
      パスワード：<input type="text" name="password_input" value="{{old('password_input')}}"></br>
      @if($errors->has("password_input"))
        <p>{{ $errors->first("password_input") }}</p>
      @endif
      <input type="submit" value="提出">
    </form>
    <a href="{{ route("get_questionnaire_index")}}">戻る</a>

@endsection
