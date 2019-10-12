@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('course.show', $course) }}" class="btn btn-outline-info mb-3">Back to "{{ $course->title }}"</a>
                <div class="card">
                    <div class="card-header">جلسه جدید برای دوره "{{ $course->title }}"</div>

                    <div class="card-body">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>خطا! </strong>{{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            <form action="{{ route('course.session.store', $course) }}" method="post">
                                @csrf

                                <input type="hidden" name="course_id" value="{{ $course->id }}">

                                <div class="form-group">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>حضور</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>دوره ها</th>
                                            <th>جلسه ها</th>
                                            <th>امتحانات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($course->students as $student)
                                            <tr>
                                                <td>
                                                    <input type='checkbox' name='students[]' value='{{ $student->id }}' checked/>
                                                </td>
                                                <td>{{ $student->fname }}</td>
                                                <td>{{ $student->lname }}</td>
                                                <td>{{ $student->courses->count() }}</td>
                                                <td>{{ $student->sessions()->where('course_id', $course->id)->where('presence', 1)->count() }}</td>
                                                <td>{{ $student->exams->count() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="rtl w-100">توضیحات جلسه:</label>
                                    <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
@endsection
