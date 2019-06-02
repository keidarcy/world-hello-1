@extends('layouts.app')

@section('content')
    <form action="{{ route('post_questionnaire_password',['id'=>$id]) }}" method="post">
      @csrf
      password:<input type="password" name="input_password">
      <input type="submit" value="提出">
    </form>
@endsection
