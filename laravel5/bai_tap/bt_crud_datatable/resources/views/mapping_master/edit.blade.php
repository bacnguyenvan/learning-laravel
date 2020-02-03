@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <div class="breadcrumb-holder">
	            <h1 class="main-title float-left">Chỉnh sửa cây nhóm</h1>
	            <ol class="breadcrumb float-right">
	                <li class="breadcrumb-item">Trang chủ</li>
	                <li class="breadcrumb-item">Menu quản trị</li>
	                <li class="breadcrumb-item">Quản lí cây nhóm</li>
	                <li class="breadcrumb-item active">Chỉnh sửa</li>
	            </ol>
	            <div class="clearfix"></div>
	            @if(isset($msg))
					<div class="alert alert-danger">{{$msg}}</div>
	            @endif
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
							        	<input class="form-control" type="text"  name="group_name" value="{{$group_name}}">
							        </td>
							    </tr>
							     <tr>
							        <td>Thuộc vào nhóm</td>
							        <td>
							        	<div class="row">
							        		<div class="col-lg-8">
								        		<input class="form-control" id="select_group" name="select_group" placeholder ="vui lòng chọn ▼" data-toggle="modal" data-target="#createGroupModal" autocomplete="off" readonly="" value="{{$group_parent_id}}" style="color: white">
								        		<label style="position: absolute;top: 8px;left: 25px;" >
								        			<?php $group_name = \App\Group::find($group_parent_id) ?>
								        		@if($group_name) {{$group_name->group_name}}
												
								        		@endif
								        		</label>
								        	</div>
								        	<div class="col-lg-4">
								        		<input type="checkbox" @if(!$group_name) checked="" @endif name="">
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
							
							@endif
						</div>
					</div>
					

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 offset-lg-2 mt-4">
				<input type="submit" class="btn btn-block btn-primary" value="Cập nhật">
					
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
				
				@if(isset($list))
					{!! $list !!}
				@endif
		    </div>
	      
	    </div>
	  </div>
	</div>

@endsection

@section('title','Quản lí cây nhóm > Tạo mới')