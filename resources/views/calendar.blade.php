@extends(Auth::user() ? 'layouts.app' : 'layouts.app_teacher')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <a class="btn btn-outline-secondary float-left" href="{{ url('calendar/?date=' . $calendar->getPreviousMonth()) }}">前の月</a>

                    <span>{{ $calendar->getTitle() }}</span>

                    <a class="btn btn-outline-secondary float-right" href="{{ url('calendar/?date=' . $calendar->getNextMonth()) }}">次の月</a>
                </div>
                <div class="card-body">
                    {!! $calendar->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
