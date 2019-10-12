@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header rtl">دوره ها</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('course.index') }}">لیست دوره ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('course.create') }}">دوره جدید</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active pt-4 px-0">

                                @if(session()->get('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Success! </strong>{{ session()->get('success') }}
                                    </div>
                                @endif
                                <div class="table-responsive">

                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>تعداد امتحانات</th>
                                            <th>تعداد دانشجویان</th>
                                            <th>تعداد جلسات</th>
                                            <th>عنوان</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('course.edit', $course) }}"
                                                           class="btn btn-warning">ویرایش</a>
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                                data-target="#modal-course-{{ $course->id }}">حذف
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>{{ $course->exams->count() }}</td>
                                                <td>{{ $course->students->count() }}</td>
                                                <td>{{ $course->sessions->count() }}</td>
                                                <td>
                                                    <a href="{{ route('course.show', $course) }}">{{ $course->title }}</a>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal" id="modal-course-{{ $course->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">حذف دوره</h4>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body rtl">
                                                            حذف دوره '{{ $course->title }}'
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button type="button" class="btn btn-info"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>
                                                            <form action="{{ route('course.destroy', $course) }}"
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
