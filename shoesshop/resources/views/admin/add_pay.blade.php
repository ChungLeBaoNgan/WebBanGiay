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
                                            <h5>Thanh toán</h5>
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
                                                <a href="{{URL::to('/manage-pay')}}">Quản lý Thanh toán</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Thêm phương thức thánh toán</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                                <div class="card">
                                    <div class="card-header"><h3>Thêm phương thức thanh toán</h3></div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{URL::to('/save-pay')}}" method="POST">
                                             {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên phương thức</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="pay_name" placeholder="Name">
                                            </div>
                                            <button type="submit" name="add_pay" class="btn btn-primary mr-2">Thêm</button>
                                            <button class="btn btn-light">Hủy</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                
@endsection