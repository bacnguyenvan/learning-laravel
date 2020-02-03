@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Xác nhận địa chỉ email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Một liên kết xác nhận mới đã được gửi tới địa chỉ email của bạn.
                        </div>
                    @endif
                    Trước khi tiếp tục , vui lòng kiểm tra email và xác nhận email đăng kí.
                    Nếu bạn không nhận được email ,<a style="color: blue !important; text-decoration: underline !important;" href="{{ route('verification.resend') }}">Click vào đây</a>  để chúng tôi gửi lại.
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('title','Xác nhận địa chỉ eamil')
