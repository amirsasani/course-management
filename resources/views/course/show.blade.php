@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('course.index') }}" class="btn btn-outline-info mb-3">برگشت به دوره ها</a>
                <div class="card">
                    <div class="card-header">{{ $course->title }}</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#sessions">جلسات</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#students">دانشجو ها</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#exams">امتحانات</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active pt-4 px-0" id="sessions">
                                <a href="{{ route('course.session.create', $course) }}"
                                   class="btn btn-outline-success mb-4">جلسه جدید</a>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>تاریخ</th>
                                            <th>ساعت</th>
                                            <th>دانشجویان</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($course->sessions as $session)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('course.session.show', ['course' => $course, 'session' => $session]) }}">{{ $session->created_at->format('d/m/Y') }}</a>
                                                </td>
                                                <td>{{ $session->created_at->format('H:i:s') }}</td>
                                                <td>{{ $session->students()->where('presence', 1)->count() }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('course.session.edit', ['course' => $course, 'session' => $session]) }}"
                                                           class="btn btn-warning">ویرایش</a>
                                                        <a href="" class="btn btn-danger" data-toggle="modal"
                                                           data-target="#modal-session-{{ $session->id }}">حذف</a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal" id="modal-session-{{ $session->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">حذف جلسه</h4>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body rtl">
                                                            حذف جلسه  {{ $session->created_at->format('d/m/Y H:i:s') }}
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>
                                                            <form
                                                                action="{{ route('course.session.destroy', ['course'=>$course, 'session'=>$session]) }}"
                                                                method="post" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">حذف
                                                                </button>
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

                            <div class="tab-pane container fade pt-4 px-0" id="students">
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-between">
                                        <a href="{{ route('course.student.add_list', $course) }}"
                                           class="btn btn-outline-success">اضافه کردن دانشجو به  '{{ $course->title }}'</a>
                                        <a href="{{ route('student.create') }}" class="btn btn-outline-info">دانشجوی جدید</a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>شماره دانشجویی</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>دوره ها</th>
                                            <th>جلسات</th>
                                            <th>امتحانات</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($course->students as $student)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('student.show', $student) }}">{{ $student->student_no }}</a>
                                                </td>
                                                <td>{{ $student->fname }}</td>
                                                <td>{{ $student->lname }}</td>
                                                <td>{{ $student->courses->count() }}</td>
                                                <td>{{ $student->sessions()->where('course_id', $course->id)->where('presence', 1)->count() }}</td>
                                                <td>{{ $student->exams->count() }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('student.edit', $student) }}"
                                                           class="btn btn-warning">ویرایش</a>
                                                        <a href="" class="btn btn-danger" data-toggle="modal"
                                                           data-target="#modal-student-{{ $student->id }}">حذف</a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal" id="modal-student-{{ $student->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">حذف دانشجو از دوره
                                                                "{{ $course->title }}"</h4>
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
                                                            <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>
                                                            <form
                                                                action="{{ route('course.student.destroy', ['course'=>$course, 'student'=>$student]) }}"
                                                                class="d-inline-block" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">حذف
                                                                </button>
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

                            <div class="tab-pane container fade pt-4 px-0" id="exams">
                                <a href="{{ route('course.exam.create', $course) }}"
                                   class="btn btn-outline-success mb-4">امتحان جدید</a>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>عنوان</th>
                                            <th>تاریخ</th>
                                            <th>ساعت</th>
                                            <th>داشجویان</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($course->exams as $exam)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('course.exam.show', ['course' => $course, 'exam' => $exam]) }}">{{ $exam->title }}</a>
                                                </td>
                                                <td>{{ $exam->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $exam->created_at->format('H:i:s') }}</td>
                                                <td>{{ $exam->students->count() }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('course.exam.edit', ['course'=>$course, 'exam'=>$exam]) }}"
                                                           class="btn btn-warning">ویرایش</a>
                                                        <a href="" class="btn btn-danger" data-toggle="modal"
                                                           data-target="#modal-exam-{{ $exam->id }}">حذف</a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal" id="modal-exam-{{ $exam->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">حذف امتحان</h4>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body rtl">
                                                            {{-- Delete Session {{ $session->created_at->format('d/m/Y H:i:s') }}--}}
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>
                                                            <form
                                                                action="{{ route('course.exam.destroy', ['course'=>$course, 'exam'=>$exam]) }}"
                                                                method="post" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">حذف
                                                                </button>
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
            $('.table').DataTable({
                "language": {
                    "url": "./persian.lang"
                }
            } );
        });
    </script>
@endsection
