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
                                            <h5>Quản lý khuyến mãi</h5>
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
                                                <a href="#">Quản lý khuyến mãi</a>
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
                                        <h3>Danh sách khuyến mãi</h3>
                                        <?php
                                            $message=Session::get('message');
                                            if($message){
                                                echo $message;
                                                Session::put('message',null);
                                            }
                                        ?> 
                                    </div>
                                    <div class="card-body p-0 table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                         <th>STT</th>
                                                        <th>Mã khuyến mãi</th>
                                                        <th>Chủ đề</th>
                                                        <th>Đoạn mã code</th>
                                                        <th>Giảm giá (%)</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php {{$i=1;}} ?>
                                                    @foreach($list_coupon as $key => $cate)

                                                    <tr>
                                                        <th scope="row">{{$i}}</th>
                                                        <td>{{$cate->km_ma}}</td>
                                                        <td>{{$cate->km_chuDe}}</td>
                                                        <td>{{$cate->km_doanMa}}</td>
                                                        <td>{{$cate->km_giamGia}}</td>
                                                        <td><div class="table-actions">   
                                                            <a href="{{URL::to('/edit-coupon/'.$cate->km_ma)}}"><i class="ik ik-edit-2"></i></a>
                                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-coupon/'.$cate->km_ma)}}"><i class="ik ik-trash-2"></i></a>
                                                        </div></td>
                                                    </tr>
                                                    <?php {{$i++;}} ?>
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