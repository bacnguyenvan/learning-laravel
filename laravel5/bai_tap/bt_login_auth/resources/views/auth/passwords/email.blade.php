@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">Nhập vào email đã đăng kí của bạn<br class="d-none d-lg-inline">và nhấp vào nút Send Password Reset Link<br>Chúng tôi sẽ gửi form đặt lại mật khẩu vào email của bạn</p>

    <form action="{{route('password.email')}}" method="post">
        @csrf
       
        <div class="input-group mb-3">
            <input type="text" name="email" class="form-control form-control-lg" maxlength="36"
                   placeholder="Nhập Email">
            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
        </div>

        <div class="row mt40">
            <div class="col-12">
                @if($errors->has('email'))
                    <p class="alert alert-danger">{{$errors->first('email')}}</p>
                @endif
                
                @if(session('status'))
                    <p class="alert alert-success">{{session('status')}}</p>
                @endif
            </div>

            <!-- /.col -->
            <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">Send Password Reset Link</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

</div>
@endsection

@section('title','Quên mật khẩu')

