<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>情報登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
            <form action="/teacher" method="post" enctype="multipart/form-data">
                @csrf
                @include('teacher/message')
                @elseif($target == 'update')
                <form action="/teacher/{{ $teacher->id }}" method="post" enctype="multipart/form-data">
                    @include('teacher/message')
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" name="name" value="{{ $teachers->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $teachers->email }}">
                    </div>

                    <div class=" form-group">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" name="password" value="{{ $teachers->password }}">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">確認用パスワード</label>
                        <input type="password" class="form-control" name="password_confirmation" value="{{ $teachers->password_confirmation }}">
                    </div>



                    <button type="submit" class="btn btn-default">登録</button>
                    <a href="/teacher">戻る</a>
                </form>
        </div>
    </div>
</div>
