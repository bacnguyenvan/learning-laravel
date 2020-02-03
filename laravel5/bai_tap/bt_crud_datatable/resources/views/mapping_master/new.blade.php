@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="breadcrumb-holder">
	            <h1 class="main-title float-left">Tạo cây nhóm mới</h1>
	            <ol class="breadcrumb float-right">
	                <li class="breadcrumb-item">Trang chủ</li>
	                <li class="breadcrumb-item">Menu quản trị</li>
	                <li class="breadcrumb-item">Quản lí cây nhóm</li>
	                <li class="breadcrumb-item active">Tạo mới</li>
	            </ol>
	            <div class="clearfix"></div>
	        </div>
	    </div>
	</div>
	
	<form method="post" action="">
		@csrf
		<div class="row">
			<div class="offset-lg-2 col-lg-8">
				<div class="card">
					<div class="card-header">
						<h5>Nhập thông tin cây nhóm</h5>
					</div>
					<div class="card-body">
						<table class="table">
						    <tbody>
							    <tr>
							        <td style="border-top: none">Tên <span style="color: red"> *</span></td>
							        <td style="border-top: none">
							        	<input class="form-control" type="text"  name="group_name">
							        </td>
							    </tr>
							     <tr>
							        <td>Thuộc vào nhóm</td>
							        <td>
							        	<div class="row">
							        		<div class="col-lg-8">
								        		<input class="form-control" id="select_group" name="select_group" placeholder ="vui lòng chọn ▼" data-toggle="modal" data-target="#createGroupModal" autocomplete="off" readonly="">
								        		<label style="position: absolute;top: 8px;left: 25px;" ></label>
								        	</div>
								        	<div class="col-lg-4">
								        		<input type="checkbox" name="">
								        		<span>Không có thiết lập nhóm</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table>

						<div class="row">

							@if($errors->has('group_name'))
								<div class=" col-lg-12 text-center">
									<p class="alert alert-danger">{{$errors->first('group_name')}}</p>
								</div>
							@elseif($msg)
								<div class=" col-lg-12 text-center">
									<p class="alert alert-danger">{{$msg}}</p>
								</div>
							@endif
						</div>
					</div>
					

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 offset-lg-2 mt-4">
				<input type="submit" class="btn btn-block btn-primary" value="Tạo mới">
					
			</div>
			<div class="col-lg-4 mt-4">
				<a class="btn btn-block btn-secondary">
					Hủy bỏ
				</a>
			</div>
		</div> 
	</form>


{{-- modal select group --}}

	<div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      
	        <div class="modal-body">
	       		<p>Vui lòng chọn 1 nhóm</p>
	       		<input class="btn btn-primary select_of_model" value="Chọn">
	        </div>
	        <div class="modal-footer" style="justify-content:flex-start">	
				{{-- <ul class="dropdown_group col-lg-12" style="padding-left: 0px;">
					<li class="form-control mt-2">Nhóm 1</li>
					<li  class="form-control mt-2">Nhóm 2</li>
					<li>
						<span data-toggle="collapse" data-target="#selectGroupList_3">
							<b><i class="fa fa-plus"></i></b>
						</span>
						Nhóm 3
						<div class="float-right">
							<a href="">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="">
								<i class="fa fa-times"></i>
							</a>
						</div>
						<ul class="collapse" id="selectGroupList_3">
							<li  class="form-control mt-2">Nhóm 3-1</li>
							<li  class="form-control mt-2">Nhóm 3-2</li>
							<li  class="form-control mt-2 mb-2">Nhóm 3-3</li>
						</ul>
					</li>
					<li class="form-control">Nhóm 4</li>
				</ul> --}}
				@if(isset($list))
					{!! $list !!}
				@endif
		    </div>
	      
	    </div>
	  </div>
	</div>

@endsection

@section('title','Quản lí cây nhóm > Tạo mới')