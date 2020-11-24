@section('title', 'カレンダー')
@section('content')
{!!$cal_tag!!}
<a href="{{ url('/lesson') }}">レッスン設定</a>
@endsection
@extends('layout')
