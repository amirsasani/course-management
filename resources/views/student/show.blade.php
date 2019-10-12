@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ URL::previous() }}" class="btn btn-outline-info mb-3">برگشت</a>
                <div class="card">
                    <div class="card-header">{{ $student->fname }} {{ $student->lname }}</div>

                    <div class="card-body">

                        <table class="table table-borderless w-100">
                            <tbody>
                            <tr>
                                <td>نام: </td>
                                <td>{{ $student->fname }}</td>
                            </tr>
                            <tr>
                                <td>نام خانوادگی: </td>
                                <td>{{ $student->lname }}</td>
                            </tr>
                            <tr>
                                <td>شماره دانشجویی: </td>
                                <td>{{ $student->student_no }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <h4>دوره های {{ $student->fname }} {{ $student->lname }}</h4>
                        <table id="table" class="table table-striped table-bordered w-100">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تعداد جلسات</th>
                                <th>تعداد دانشجوها</th>
                                <th>تعداد امتحانات</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($student->courses as $course)
                                <tr>
                                    <td><a href="{{ route('course.show', $course) }}">{{ $course->title }}</a>
                                    </td>
                                    <td>{{ $course->sessions->count() }}</td>
                                    <td>{{ $course->students->count() }}</td>
                                    <td>{{ $course->exams->count() }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('course.edit', $course) }}"
                                               class="btn btn-warning">ویرایش</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modal-course-{{ $course->id }}">حذف
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- The Modal -->
                                <div class="modal" id="modal-student-{{ $student->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">حذف دانشجو</h4>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body rtl">
                                                حذف {{ $student->fname }} {{ $student->lname }} <br>
                                                شماره دانشجویی: {{ $student->student_no }}
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">
                                                    بستن
                                                </button>
                                                <form
                                                    action="{{ route('student.destroy', $student) }}"
                                                    class="d-inline-block" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
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
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
@endsection
