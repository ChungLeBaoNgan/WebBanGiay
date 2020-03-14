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
                                            <h5>Thương Hiệu</h5>
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
                                                <a href="{{URL::to('/manage-category')}}">Quản lý thương hiệu</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Cập nhật thương hiệu</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                                <div class="card">
                                    <div class="card-header"><h3>Cập nhật thương hiệu sản phẩm</h3></div>
                                    <div class="card-body">
                                        @foreach($edit_brand_product as $key => $edit_value)
                                        <div class="position-center">
                                            <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->th_ma)}}" method="post">
                                                {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên thương hiệu</label>
                                                <input type="text" value="{{$edit_value->th_ten}}" name="brand_product_name" class="form-control" id="exampleInputName1" placeholder="Name" >
                                            </div>
                                            
                                           
                                            <button type="submit" name="add_cate" class="btn btn-primary mr-2">Cập nhật</button>
                                            <button class="btn btn-light">Hủy</button>
                                            </form>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                
@endsection