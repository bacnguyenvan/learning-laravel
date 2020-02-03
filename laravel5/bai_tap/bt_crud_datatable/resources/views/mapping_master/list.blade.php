@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="breadcrumb-holder">
	            <h1 class="main-title float-left">Quản lý cây nhóm</h1>
	            <ol class="breadcrumb float-right">
	                <li class="breadcrumb-item">Trang chủ</li>
	                <li class="breadcrumb-item">Menu quản trị</li>
	                <li class="breadcrumb-item active">Quản lí cây nhóm</li>
	            </ol>
	            <div class="clearfix"></div>

	            @if(session('msg'))
					<div class="alert alert-success">{{session('msg')}}</div>
				@elseif(session('msg_err'))
					<div class="alert alert-danger">{{session('msg_err')}}</div>
	            @endif
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="btn btn-block btn-secondary">
				<i class="fa fa-plus"></i>
				<a href="new" style="color: white">Tạo cây nhóm mới</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 mt-4">
			@if(isset($lists))
				{!! $lists !!}
			@endif
		</div>
	</div>

@endsection

@section('title','Quản lí cây nhóm')