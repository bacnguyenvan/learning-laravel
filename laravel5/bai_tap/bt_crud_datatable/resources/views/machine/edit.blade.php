@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Chỉnh sửa thiết bị</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Trang chủ</li>
                    <li class="breadcrumb-item">Menu quản trị</li>
                    <li class="breadcrumb-item">Quản lí máy</li>
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
                <div class="clearfix"></div>
                
            </div>
        </div>
    </div>

    <form action="" method="POST">
        @csrf
        <div class="row mb-2">
        
            <div class="col-lg-6">
                <div class="card alert-primary">
                    <div class="card-header">
                        <h3>Thông tin cơ bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <h6>Machine name <span style="color: red">*</span><h6>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="machine_name" value="{{$machine_name}}">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <h6>Group<h6>
                            </div>
                            <div class="col-lg-9">
                                <a data-toggle="modal" data-target="#createGroupModal" href="" class="btn btn-primary" id="select_group">
                                    <input type="hidden" name="group_id">
                                    <i class="fa fa-search"></i>
                                    <span>Lựa chọn tham khảo</span>
                                </a>
                                <label>{{$group_name}}</label>
                            </div>
                        </div>

                    </div>

                </div>  
            </div>

            <div class="col-lg-6">
                <div class="card alert-secondary">
                    <div class="card-header">
                        <h3>Thông tin bổ sung</h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-3">
                                <h6>Chỉ định<h6>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <h6>Số kiểm soát<h6>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <h6>Mục 1<h6>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="">
                            </div>
                        </div>

                        

                    </div>

                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 offset-lg-2 mt-3">
                <button class="btn btn-block btn-primary">
                    Update
                </button>
            </div>
            <div class="col-lg-4 mt-3">
                <a href="" class="btn btn-block btn-secondary">
                    Cancel
                </a>
            </div>
        </div>
        
        <input type="hidden" name="msg" id="msg" @if(isset($msg)) value="{{$msg}}" @endif >
    </form>
@endsection

@section('modal')
    @include('machine._modal')
@endsection