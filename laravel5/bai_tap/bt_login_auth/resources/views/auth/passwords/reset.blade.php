@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
     <h2 class="login-box-msg">Đặt lại mật khẩu</h2>    
    <form action="{{route('password.update') }}" method="post">
        @csrf 
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="input-group mb-3">
            <input  type="text" name="email" class="form-control form-control-lg" placeholder="Nhập Email" maxlength="36" value="{{ $email ?? old('email') }}">
            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>  
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu" maxlength="26">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control form-control-lg" maxlength="26"
                   placeholder="Nhập mật khẩu xác nhận">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
        </div>



        <div class="row mt40">
            
            <div class="col-12"> 
               @if($errors->has('email'))
                <p class="alert alert-danger">{{$errors->first('email')}}</p>
                @elseif($errors->has('password'))
                <p class="alert alert-danger">{{$errors->first('password')}}</p>
               @endif
            </div>

            <!-- /.col -->
            <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">Đặt lại mật khẩu</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

@endsection

@section('title','Đặt lại mật khẩu')

{{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
