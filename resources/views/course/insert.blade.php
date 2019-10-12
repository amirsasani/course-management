@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">دوره ها</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('course.index') }}">لیست دوره ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('course.create') }}">دوره جدید</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active pt-4 px-0">

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>خطا! </strong>{{ $error }}
                                        </div>
                                    @endforeach
                                    </div>
                                @endif

                                <form action="{{ route('course.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="rtl w-100">عنوان دوره:</label>
                                        <input type="text" name="title" class="form-control rtl" id="title" value="{{ old('title') }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">ثبت</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
