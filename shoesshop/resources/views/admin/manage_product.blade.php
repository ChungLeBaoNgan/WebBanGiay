@extends('admin_layout')
@section('content')

                       


<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-credit-card bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Quản lý sản phẩm</h5>
                                            {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{URL::to('/dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active">
                                                <a href="#">Quản lý sản phẩm</a>
                                            </li>
                                            {{-- <li class="breadcrumb-item active" aria-current="page">Bootstrap Tables</li> --}}
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
								<div class="card">
                                    <div class="card-header d-block">
                                        <h3>Danh sách sản phẩm</h3>
                                        <?php
                                            $message =Session::get('message');
                                            if($message){
                                              echo '<span class="text-alert">'.$message.'</span>';
                                              Session::put('message', null);
                                            }
                                          ?>
                                    </div>
                                    <div class="card-body p-0 table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Mã sản phẩm</th>
                                                        <th>Hình ảnh</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Thương hiệu</th>
                                                        <th>Danh mục</th>
                                                        <th>Đơn giá bán</th>
                                                        <th>Đơn giá nhập</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1; ?>
                                                	@foreach( $list_pro as $key => $pro)
                                                    <tr>
                                                        <th scope="row">{{$i}}</th>
                                                        <td>{{$pro->sp_ma}}</td>
                                                         <td><img src="{{URL::to('public/upload/product/'.$pro->ha_ten)}}" height="100" width="100"></td> 
                                                        <td>{{$pro->sp_ten}}</td>
                                                        <td>{{$pro->th_ten}}</td>
                                                        <td>{{$pro->dm_ten}}</td>
                                                        <td>{{$pro->sp_donGiaBan}}</td>
                                                        <td>{{$pro->sp_donGiaNhap}}</td>
                                                        <td><div class="table-actions">
                                                            <a href="{{URL::to('/view-order')}}"><i class="ik ik-eye"></i></a>
                                                            <a href="{{URL::to('/chinhsua-sanpham/'.$pro->sp_ma)}}"><i class="ik ik-edit-2"></i></a>
                                                            <a href="#"><i class="ik ik-trash-2"></i></a>
                                                        </div></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                   	@endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            


@endsection