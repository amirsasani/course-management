@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('course.show', $course) }}" class="btn btn-outline-info mb-3">Back to
                    "{{ $course->title }}"</a>
                <div class="card">
                    <div class="card-header">Students</div>

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error! </strong>{{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('course.student.add', $course) }}" method="post">
                            @csrf

                            <input type="hidden" name="course_id" value="{{ $course->id }}">

                            <div class="form-group">
                                <div class="table-responsive">

                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Presence</th>
                                            <th>F. name</th>
                                            <th>L. Name</th>
                                            <th>Courses</th>
                                            <th>Sessions</th>
                                            <th>Exams</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <input type='checkbox' name='students[]'
                                                           value='{{ $student->id }}'/>
                                                </td>
                                                <td>{{ $student->fname }}</td>
                                                <td>{{ $student->lname }}</td>
                                                <td>{{ $student->courses->count() }}</td>
                                                <td>{{ $student->sessions()->where('presence', 1)->count() }}</td>
                                                <td>{{ $student->exams->count() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
@endsection
