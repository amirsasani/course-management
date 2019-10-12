@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">دانشجوها</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('student.index') }}">لیست دانشجوها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.create') }}">دانشجوی جدید</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active pt-4 px-0">

                                @if(session()->get('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>با موفقیت! </strong>{{ session()->get('success') }}
                                    </div>
                                @endif

                                <table id="table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>شماره دانشجویی</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>دوره ها</th>
                                        <th>جلسه ها</th>
                                        <th>امتحانات</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td><a href="{{ route('student.show', $student) }}">{{ $student->student_no }}</a></td>
                                            <td>{{ $student->fname }}</td>
                                            <td>{{ $student->lname }}</td>
                                            <td>{{ $student->courses->count() }}</td>
                                            <td>{{ $student->sessions->count() }}</td>
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
