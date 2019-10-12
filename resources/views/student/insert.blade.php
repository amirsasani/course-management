@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">دانشجوها</div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.index') }}">لیست دانشجوها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('student.create') }}">دانشجوی جدید</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active pt-4 px-0">

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>خطا! </strong>{{ $error }}
                                        </div>
                                    @endforeach
                                    </div>
                                @endif

                                <form action="{{ route('student.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="fname" class="w-100 rtl">نام:</label>
                                        <input type="text" name="fname" class="form-control rtl" id="fname" value="{{ old('fname') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="lname" class="w-100 rtl">نام خانوادگی:</label>
                                        <input type="text" name="lname" class="form-control rtl" id="lname" value="{{ old('lname') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="student_no" class="w-100 rtl">شماره دانشجویی:</label>
                                        <input type="text" name="student_no" class="form-control rtl" id="student_no" value="{{ old('student_no') }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">ثبت</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
