@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('course.show', $course) }}" class="btn btn-outline-info mb-4 rtl">برگشت به دوره "{{ $course->title }}"</a>
                <div class="card">
                    <div class="card-header rtl">امتحان دوره "{{ $course->title }}"</div>

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error! </strong>{{ $error }}
                                </div>
                            @endforeach
                    </div>
                    @endif

                    <form action="{{ route('course.exam.store', $course) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="w-100 rtl">عنوان امتحان:</label>
                            <input type="text" name="title" class="form-control rtl" id="title"  value="{{ old('title') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
