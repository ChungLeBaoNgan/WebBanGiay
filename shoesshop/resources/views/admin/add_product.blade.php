



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
                                                <a href="{{URL::to('/manage-category')}}">Quản lý sản phẩm</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>


                                <div class="card">
                                    <div class="card-header"><h3>Thêm sản phẩm</h3></div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data" >
                                             {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên sản phẩm</label>
                                                <input type="text" name="pro_name" class="form-control" id="exampleInputName1" placeholder="Name">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputName1">Đơn giá bán</label>
                                                <input type="text" name="pro_price" class="form-control" id="exampleInputName1" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Thương hiệu</label>
                                                <select class="form-control" name="pro_brand" id="exampleSelectGender">
                                                    @foreach($list_cate as $key => $cate)
                                                        <option value="{{$cate->th_ma}}">{{$cate->th_ten}}</option>                                                  
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Danh mục</label>
                                                <select class="form-control" name="pro_cate" id="exampleSelectGender">
                                                    @foreach($list_brand as $key => $brand)
                                                        <option value="{{$brand->dm_ma}}">{{$brand->dm_ten}}</option>                                                  
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product image</label>
                                                
                                                <input type="file" name="product_image" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleTextarea1">Ghi chú</label>
                                                <textarea class="form-control" name="pro_note" id="exampleTextarea1" rows="4"></textarea>
                                            </div>
                                            <button type="submit" name="add_pro" class="btn btn-primary mr-2">Thêm</button>
                                            <button class="btn btn-light">Hủy</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                
@endsection


@section('script_components')

        <script src="{{asset('public/backend/dist/js/theme.min.js')}}"></script>
        <script src="{{asset('public/backend/js/form-components.js')}}"></script>


@endsection