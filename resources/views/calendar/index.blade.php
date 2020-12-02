<head>
    <title>カレンダー</title>

</head>
@extends(Auth::user() ? 'layouts.app' : 'layouts.app_teacher')
@section('content')




<h1>
    <a class="btn btn-primary" href="/calendar/?year=" role="button">&lt;前月</a>
    年月
    <a class="btn btn-primary" href="/calendar/?year=" role="button">翌月&gt;</a>
</h1>


<table class="table table-bordered">
    <tr>
        <th scope="col">日</th>
        <th scope="col">月</th>
        <th scope="col">火</th>
        <th scope="col">水</th>
        <th scope="col">木</th>
        <th scope="col">金</th>
        <th scope="col">土</th>
    </tr>


</table>

@endsection
