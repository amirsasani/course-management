@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header rtl">ثبت نام</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-left">نام نمایشی</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="email" class="col-md-4 col-form-label text-md-left">آدرس ایمیل</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="password" class="col-md-4 col-form-label text-md-left">رمز عبور</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">تایید رمزعبور</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-3 rtl">
                                <button type="submit" class="btn btn-primary">ثبت نام</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
