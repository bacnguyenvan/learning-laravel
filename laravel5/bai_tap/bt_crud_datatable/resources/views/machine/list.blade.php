@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Danh sách thiết bị</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Trang chủ</li>
                <li class="breadcrumb-item active">Menu quản trị</li>
                <li class="breadcrumb-item active">Quản lí máy</li>
            </ol>
            <div class="clearfix"></div>
            @if(session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid">
    <form action="{{route('machine-list')}}" method="get"> 
        @csrf
        <div class="row mb-2">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3"><h5>Tìm kiếm</h5></div>
                    <div class="col-lg-9 mb-1">
                        <a data-toggle="modal" data-target="#createGroupModal"  href="" class="btn btn-outline-primary"  style="width: 100%;color: black!important;border-color:#ddd;background-color: white">
                            Tất cả các nhóm  &nbsp; &nbsp; ▼
                        </a>
                    </div>
                </div>   
            </div>

            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-6 mb-1">
                        <input type="submit" style="width: 100%" class="btn btn-primary" value="Hủy lọc" name="">
                    </div>
                    <div class="col-lg-2 mb-1">
                        <a href="" class="btn btn-block btn-primary" data-toggle="modal" data-target="#SearchMachineModal">
                            <i class="fa fa-search"></i>&nbsp;
                        </a>
                        
                    </div>
                    <div class="col-lg-4">
                        <a href="new" class="btn btn-info" style="width: 100%;padding-right: 2px">
                            <i class="fa fa-plus"></i>
                            Đăng kí máy mới
                        </a>
                        
                    </div>
                </div>   
            </div>
        </div>

        <div class="row mb-2">
            
            <div class="col-lg-9"></div>
            <div class="col-lg-3">
                <a href="" class="btn btn-success float-right exportCSV" data-toggle="modal" data-target="#CsvModal">
                    Export CSV
                </a>
            </div>
        </div>
    </form>
</div>

<!-- end row -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <form action="{{route('machine_delete')}}" method="POST" id="form_delete_machine">
            @csrf
            <div class="card mb-3">
                <div class="card-header">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <select class="form-control select_action_delete">
                                    <option value="">Không xóa</option>
                                    <option value="1">Xóa</option>
                                </select>
                            </div>
                        

                            <div class="col-lg-4 col-6 mb-1">
                                <button type="submit" class="btn btn-secondary btn_action_delete disable">Xóa nhiều cột</button>
                            </div>
                        </div>   
                    </div>
                </div>
                
                <div class="card-body">
                    
                    <table id="example1" class="table table-bordered table-responsive-xl table-hover display">
                        <thead>
                            <tr>
                            	<th class="no-sort">
                            		<input type="checkbox" name="select_all" id="select_all">
                            	</th>
                                <th>Id Machine</th>
                                <th>Name</th>
                                <th >group</th>
                               
                                <th>Start date</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $item)
                                <?php $group_name = \App\Group::getGroupId($item['id_group']); ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="child" name="listDelete[]" value="{{$item['machine_id']}}" data-name="{{$item['machine_name']}}" data-id={{$item['machine_id']}}>
                                    </td>
                                    <td>{{$item['machine_id']}}</td>
                                    <td>{{$item['machine_name']}}</td>
                                    <td>@if($group_name){{$group_name->group_name}} @else {{""}} @endif</td>
                                    <td>{{$item['created_at']}}</td>
                                    <td>
                                    	<a href="{{route('machine_edit',$item['machine_id'] )}}" class="mr-1">
                                    		<i class="fa fa-edit"></i>
                                    	</a>  
                                    	<a class="btn_delete" href="{{route('machine_delete',['listDelete[]'=>$item->machine_id ])}}" data-name="{{$item['machine_name']}}" data-id={{$item['machine_id']}}>
                                    		<i class="fa fa-times"></i>
                                    	</a>

                    

                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table> 
                </div>

            </div>
        </form>
            
    </div>
</div>

@endsection

<div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6>Vui lòng chọn 1 nhóm</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary mr-2" id="search_group">Thực hiện</button>
                   
                        <button class="btn btn-outline-secondary mr-2 select_all">Chọn tất cả</button>
                   
                        <button class="btn btn-outline-secondary remove_select_all">Bỏ chọn</button>
                    </div>
                
                </div>
            </div>
            <div class="modal-footer" style="justify-content:flex-start"> 
                <div class="col-lg-12">  
                    <form action="{{route('machine-list')}}" method="post" id="form-search-group">
                        @csrf
                        
                        {!! \App\Group::getListGroup(false,false) !!} 
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- search --}}
<div class="modal fade" id="SearchMachineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Nhập thông tin bạn muốn tìm kiếm</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{route('machine-list')}}" method="get">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="border-top: none">Ngày đặt</th>
                                <td style="border-top: none">
                                    <div class="row">
                                       
                                        <input type="date" name="from_date" class="form-control col-lg-5 col-12">
                                        <span class="col-md-1" style="font-size: 20px;font-weight: bold">~</span>
                                        <input type="date" name="to_date" class="form-control col-lg-5 col-12">   
                                    </div>
                                </td>
                                
                            </tr>

                            <tr style="border-top: 1px solid #ddd">
                                <th style="border-top: none">ID máy</th>
                                <td style="border-top: none">
                                    <div class="row">
                                        <select class="col-6 form-control" name="machine_id">
                                            <option value="">Vui lòng chọn</option>
                                            @foreach($listMachine as $item)
                                                <option value="{{ $item['machine_id']  }}">{{$item['machine_id'] . ". " .$item['machine_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                
                            </tr>

                            <tr style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd">
                                <th style="border-top: none">Search bất kì</th>
                                <td style="border-top: none">
                                    <div class="row">
                                        <input value="{{old('free_word')}}" type="text" placeholder="Nhập từ khóa..." class="col-6 form-control" name="free_word">
                                    </div>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <div class="row mt-2">
                                        <input class="btn btn-primary" type="submit" name="" value="Tìm kiếm theo điều kiện này">
                                    </div>
                                    
                                </td>
                                
                                
                            </tr>

                        </tbody> 
                    </table>
                </form>
            </div>
            {{-- <div class="modal-footer" style="justify-content:flex-start">   
                <input class="btn btn-primary" type="submit" name="" value="Tìm kiếm theo điều kiện này">
            </div> --}}
        </div>
    </div>
</div>

{{-- csv --}}
<div class="modal fade" id="CsvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Đặt điều kiện bạn muốn export csv</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="{{route('machine-list')}}" method="post">
                    @csrf
                    <input type="hidden" name="export" value="false" data-type="export">
                    
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="border-top: none">Ngày đặt</th>
                                <td style="border-top: none">
                                    <div class="row">
                                       
                                        <input type="date" name="from_date" class="form-control col-lg-5 col-12">
                                        <span class="col-md-1" style="font-size: 20px;font-weight: bold">~</span>
                                        <input type="date" name="to_date" class="form-control col-lg-5 col-12">   
                                    </div>
                                </td>
                                
                            </tr>

                            <tr style="border-top: 1px solid #ddd">
                                <th style="border-top: none">ID máy</th>
                                <td style="border-top: none">
                                    <div class="row">
                                        <select class="col-6 form-control">
                                            <option value="">Vui lòng chọn</option>
                                            @foreach($listMachine as $item)
                                                <option value="{{ $item['machine_id']  }}"> {{$item['machine_id'] . ". ". $item['machine_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                
                            </tr>

                            

                        </tbody>
                        
                    </table>
                    
                    
                    <input class="btn btn-primary" type="submit" name="" value="Đầu ra theo điều kiện này">

                    
                </form>
            </div>
            {{-- <div class="modal-footer" style="justify-content:flex-start">   
                <input class="btn btn-primary" type="submit" name="" value="Đầu ra theo điều kiện này">
            </div> --}}
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{asset('js/machine.js')}}"></script>
    <script src="{{asset('js/export.js')}}"></script>
@endpush