



@extends('admin_layout')
@section('content')

<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-file-text bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Sản phẩm</h5>
                                           {{--  <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{URL::to('/dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="{{URL::to('/manage-product')}}">Quản lý sản phẩm</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa thông tin sản phẩm</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>


                                <div class="card">
                                    <div class="card-header"><h3>Chỉnh sửa thông tin sản phẩm</h3></div>
                                    <div class="card-body">
                                    	@foreach($edit_pro as $key => $pro)
                                        <form class="forms-sample" action="{{URL::to('/capnhat-sanpham/'.$pro->sp_ma)}}" method="POST" enctype="multipart/form-data" >
                                             {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên sản phẩm</label>
                                                <input type="text" name="pro_name" class="form-control" id="exampleInputName1" value="{{$pro->sp_ten}}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputName1">Đơn giá bán</label>
                                                <input type="text" name="pro_price" class="form-control" id="exampleInputName1" value="{{$pro->sp_donGiaBan}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Đơn giá nhập</label>
                                                <input type="text" name="pro_pricegor" class="form-control" id="exampleInputName1" value="{{$pro->sp_donGiaNhap}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Thương hiệu</label>
                                                <select class="form-control" name="pro_brand" id="exampleSelectGender">
                                                    @foreach($list_brand as $key => $brand)
                                                    	@if($brand->th_ma==$pro->th_ma)
                                                    	<option selected value="{{$brand->th_ma}}">{{$brand->th_ten}}</option>
                                                    	@else
                                                    	<option value="{{$brand->th_ma}}">{{$brand->th_ten}}</option>
                                                        @endif                                            
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Danh mục</label>
                                                <select class="form-control" name="pro_cate" id="exampleSelectGender">
                                                    @foreach($list_cate as $key => $cate)
                                                    @if($cate->dm_ma==$pro->dm_ma)
                                                    	<option selected value="{{$cate->dm_ma}}">{{$cate->dm_ten}}</option>
                                                    	@else
                                                    	<option value="{{$cate->dm_ma}}">{{$cate->dm_ten}}</option>
                                                        @endif 
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                                
                                                <input type="file" name="pro_image" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                    </span>
                                                </div>
                                                @foreach($hinh_anh as $key => $image)
                                                      <img src="{{URL::to('public/upload/product/'.$image->ha_ten)}}"height="100" width="100">
                                                @endforeach
                                                
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleTextarea1">Ghi chú</label>
                                                <textarea class="form-control" name="pro_note" id="exampleTextarea1" rows="4">{{$pro->sp_ghiChu}}</textarea>
                                            </div>
                                            <button type="submit" name="add_pro" class="btn btn-primary mr-2">Cập nhật</button>
                                            <button class="btn btn-light">Hủy</button>
                                        </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                
@endsection


@section('script_components')

        <script src="{{asset('public/backend/dist/js/theme.min.js')}}"></script>
        <script src="{{asset('public/backend/js/form-components.js')}}"></script>


@endsection