<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>登録情報編集</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
            <form action="/teacher" method="post" enctype="multipart/form-data">
                @csrf
                @include('teacher/message')
                @elseif($target == 'update')
                <form action="/teacher/{{ Auth::guard('teacher')->user()->id }}" method="post" enctype="multipart/form-data">
                    @include('teacher/message')
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" name="name" value="{{ $teacher->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $teacher->email }}">
                    </div>

                    <div class=" form-group">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" name="password" value="{{ $teacher->password }}">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">確認用パスワード</label>
                        <input type="password" class="form-control" name="password_confirmation" value="{{ $teacher->password_confirmation }}">
                    </div>



                    <button type="submit" class="btn btn-default">登録</button>
                    <a href="/teacher">戻る</a>
                </form>
        </div>
    </div>
</div>
