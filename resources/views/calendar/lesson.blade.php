@extends('layout')
@section('content')
<h1>レッスン設定</h1>
<!-- レッスン入力フォーム -->
<a href="{{ url('/calendar') }}">カレンダーに戻る</a>
<form method="POST" action="/lesson">
    <div class="form-group">
        {{ csrf_field() }}
        <label for="day">日付[YYYY/MM/DD]</label>
        <input type="text" name="day" class="form-control" id="day" value="{{$data->day}}">
        <label for="description">説明</label>
        <input type="text" name="description" class="form-control" id="description" value="{{$data->description}}">
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
    <input type="hidden" name="id" value="{{$data->id}}">
</form>

<!-- バリデーション結果のメッセージを表示 -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- レッスン一覧表示 -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">日付</th>
            <th scope="col">説明</th>
            <th scope="col">作成日</th>
            <th scope="col">更新日</th>
        </tr>
    </thead>

    <tbody>
        @foreach($list as $val)
        <tr>
            <!-- 日付のリンクをつける -->
            <th scope="row"><a href="{{ url('/lesson/'.$val->id) }}">{{$val->day}}</a></th>
            <td>{{$val->description}}</td>
            <td>{{$val->created_at}}</td>
            <td>{{$val->updated_at}}</td>
            <td>
                <form method="POST" action="/lesson">
                    <input type="hidden" name="id" value="{{$val->id}}">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <button class="btn btn-default" type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(function() {
        $("#day").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
@endsection
