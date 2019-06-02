@extends('layouts.app')

@section('content')
@php
$money1 = 68.75;
$money2 = 54.35;
$money = $money1 + $money2;
echo $money;
echo "\n";
$formatted = sprintf("%01.1f", $money);
echo $formatted;
@endphp


@endsection
