@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $course->title }}</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#sessions">Sessions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#students">Students</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#exams">Exams</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active pt-4 px-0" id="sessions">
                                <a href="{{ route('course.session.create', $course) }}" class="btn btn-outline-success mb-4">New Session</a>

                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($course->sessions as $session)
                                        <tr>
                                            <td><a href="{{ route('course.session.show', $course, $session) }}">{{ $session->created_at->format('d/m/Y') }}</a></td>
                                            <td>{{ $session->created_at->format('H:i:s') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('course, session.edit', $course, $session) }}" class="btn btn-warning">Edit</a>
                                                    <a href="" class="btn btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane container fade pt-4 px-0" id="students">

                                <a href="{{ route('student.create') }}" class="btn btn-outline-success mb-4">New Student</a>

                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>F. name</th>
                                        <th>L. Name</th>
                                        <th>Courses</th>
                                        <th>Sessions</th>
                                        <th>Exams</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($course->students as $student)
                                        <tr>
                                            <td>{{ $student->fname }}</td>
                                            <td>{{ $student->lname }}</td>
                                            <td>{{ $student->courses->count() }}</td>
                                            <td>{{ $student->sessions->count() }}</td>
                                            <td>{{ $student->exams->count() }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('student.edit', $student) }}" class="btn btn-warning">Edit</a>
                                                    <a href="" class="btn btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                            <div class="tab-pane container fade pt-4 px-0" id="exams">
                                <a href="{{ route('exam.create') }}" class="btn btn-outline-success mb-4">New Exam</a>

                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Students</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($course->exams as $exam)
                                        <tr>
                                            <td>{{ $exam->created_at->format('m/d/Y') }}</td>
                                            <td>{{ $exam->created_at->format('H:i:s') }}</td>
                                            <td>{{ $exam->students->count() }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('exam.edit', $exam) }}" class="btn btn-warning">Edit</a>
                                                    <a href="" class="btn btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
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
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endsection
