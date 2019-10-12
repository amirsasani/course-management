@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ url('/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('course.show', $course) }}" class="btn btn-outline-info mb-3">برگشت به دوره
                    "{{ $course->title }}"</a>
                <div class="card">
                    <div class="card-header rtl">دوره "{{ $course->title }}" امتحان "{{ $exam->title }}"</div>

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>خطا! </strong>{{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <div class="row mb-5">
                            <div class="col d-flex justify-content-between">
                                <a href="{{ route('exam.question.create', $exam) }}" class="btn btn-outline-success align-self-center">
                                    اضافه کردن سوال
                                </a>

                                <a target="_blank" href="{{ route('course.exam.generate', ['course' => $exam, 'exam' => $exam]) }}" class="btn btn-outline-dark">
                                    ایجاد برگه امتحان
                                </a>


                            </div>
                        </div>



                        <h4 class="rtl">سوالات امتحان {{ $exam->title }}</h4>
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered w-100">
                                <tbody>
                                @foreach ($exam->questions as $index => $question)
                                    <tr>
                                        <td colspan="4">
                                            <span class="font-weight-bold">{{ $index + 1 }} ) </span> {{ $question->title }}
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        @foreach ($question->choices as $choice)
                                            <td class="{{ ($choice->correct == 1)?'bg-success text-white':'' }}">{{ $choice->title }}</td>
                                        @endforeach
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('exam.question.edit', ['exam' => $exam, 'question' => $question]) }}"
                                                   class="btn btn-warning">ویرایش</a>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modal-question-{{ $question->id }}">حذف
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- The Modal -->
                                    <div class="modal" id="modal-question-{{ $question->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">حذف سوال</h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        &times;
                                                    </button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    حذف {{ $question->title }}
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="button" class="btn btn-info" data-dismiss="modal">
                                                        بستن
                                                    </button>
                                                    <form
                                                        action="{{ route('exam.question.destroy', ['exam'=>$exam, 'question'=>$question]) }}"
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
