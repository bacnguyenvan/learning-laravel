@extends('layouts.app')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Nhập ID người dùng và mật khẩu của bạn<br class="d-none d-lg-inline">và nhấp vào nút đăng kí</p>

        <form action="{{route('register')}}" method="post">
            @csrf 
            <div class="input-group mb-3">
                <input autocomplete="new-name" type="text" name="name" class="form-control form-control-lg" placeholder="Nhập Tên" maxlength="16" value="{{old('name')}}">
                <div class="input-group-append">
                    <span class="fa fa-user input-group-text"></span>  
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="text" name="email" class="form-control form-control-lg" placeholder="Nhập Email" maxlength="46" value="{{old('email')}}">
                <div class="input-group-append">
                    <span class="fa fa-envelope input-group-text"></span>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control form-control-lg" maxlength="16" placeholder="Nhập mật khẩu" >
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" class="form-control form-control-lg" maxlength="16"
                       placeholder="Nhập mật khẩu xác nhận">
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
            </div>

            <div class="row mt40">
                
                <div class="col-12"> 
                    @if($errors->has('name'))
                        <div class="alert alert-danger">{{$errors->first('name')}}</div> 
                    @elseif($errors->has('email'))
                        <div class="alert alert-danger">{{$errors->first('email')}}</div> 
                    @elseif($errors->has('password'))
                        <div class="alert alert-danger">{{$errors->first('password')}}</div> 
                    @endif
                </div>

                <!-- /.col -->
                <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">Đăng kí</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
@endsection

@section('title','Đăng kí thành viên')