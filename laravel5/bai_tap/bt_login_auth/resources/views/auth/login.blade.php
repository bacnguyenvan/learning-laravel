
@extends('layouts.app')
@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Nhập ID người dùng và mật khẩu của bạn<br class="d-none d-lg-inline">và nhấp vào nút đăng nhập</p>

        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="user_id" class="form-control form-control-lg" placeholder="Nhập ID" maxlength="16">
                <div class="input-group-append">
                    <span class="fa fa-user input-group-text"></span>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control form-control-lg" maxlength="16"
                       placeholder="Nhập mật khẩu">
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
            </div>

            <div class="row mt40">
                <div class="col-12">
                    @if(session('success'))
                        
                        <p class="alert alert-success">{{session('success')}}</p>
                        
                    @endif

                   
                    @if($errors->has('user_id'))
                        <div class="alert alert-danger">{{$errors->first('user_id')}}</div> 
                    @elseif($errors->has('user_pass'))
                        <div class="alert alert-danger">{{$errors->first('user_pass')}}</div> 
                    @endif

                </div>

                <!-- /.col -->
                <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

      

        <p class="mb-1 mt50">
            @if(Route::has('password.request'))
                <a href="{{route('password.request')}}">Nhấn vào đây nếu bạn quên mật khẩu</a>
            @endif
        </p>
        <p class="mb-0">
            @if(Route::has('register'))
                <a href="{{route('register')}}" class="text-center">Đăng kí người dùng mới</a>
            @endif
        </p>
    </div>
@endsection

@section('title','Đăng nhập | Thiết bị cảm biến cho IOT')


