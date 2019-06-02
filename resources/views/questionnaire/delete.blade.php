@extends('layouts.app')


@section('content')
      <h1>本当にこのアンケートを削除しますか？</h1>
      タイトル：{{ $questionnaire->title }}</br>
      写真：<img src="{{ asset($questionnaire->picture) }}"  height="100" width="100"></br>
      <form action = "{{ route('post_questionnaire_delete', array("id" => $questionnaire->id)) }}" method = "post">
          @csrf
          <input type = "hidden" value = "{{ $questionnaire->id }}">
          <input type = "submit" value = "削除する">
      </form>

      <a href="{{ route('get_questionnaire_index') }}">戻る</a>

@endsection
