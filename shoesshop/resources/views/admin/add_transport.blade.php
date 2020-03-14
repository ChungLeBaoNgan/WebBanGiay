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
                                            <h5>Vận chuyển</h5>
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
                                                <a href="{{URL::to('/manage-category')}}">Quản lý vận chuyển</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Thêm hình thức vận chuyển</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                                <div class="card">
                                    <div class="card-header"><h3>Thêm hình thức vận chuyển</h3></div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{URL::to('/save-transport')}}" method="POST">
                                             {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên hình thức vận chuyển</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="transport_name" placeholder="Name">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputName1">Chi phí vận chuyển</label>
                                                <input type="text" class="form-control" id="exampleInputName1" name="transport_price" placeholder="Name">
                                            </div>
                                            <button type="submit" name="add_transport" class="btn btn-primary mr-2">Thêm</button>
                                            <button class="btn btn-light">Hủy</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                
@endsection