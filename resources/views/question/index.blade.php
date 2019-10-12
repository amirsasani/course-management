@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Courses</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('course.index') }}">Course list</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('course.create') }}">new Course</a>
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

                                <table id="table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Sessions count</th>
                                            <th>Students count</th>
                                            <th>Exams count</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td><a href="{{ route('course.show', $course) }}">{{ $course->title }}</a></td>
                                                <td>{{ $course->sessions->count() }}</td>
                                                <td>{{ $course->students->count() }}</td>
                                                <td>{{ $course->exams->count() }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('course.edit', $course) }}" class="btn btn-warning">Edit</a>
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
