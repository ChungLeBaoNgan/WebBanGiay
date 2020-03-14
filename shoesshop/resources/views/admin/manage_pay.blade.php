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
                                            <h5>Quản lý phương thức thanh toán</h5>
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
                                                <a href="#">Quản lý phương thức thanh toán</a>
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
                                        <h3>Danh sách phương thức thanh toán</h3>
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
                                                        <th>Mã thanh toán</th>
                                                        <th>Tên phương thức thanh toán</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php {{$i=1;}} ?>
                                                    @foreach( $list_pay as $key => $pay)

                                                    <tr>
                                                        <th scope="row">{{$i}}</th>
                                                        <td>{{$pay->tt_ma}}</td>
                                                        <td>{{$pay->tt_ten}}</td>
                                                        <td><div class="table-actions">                                                  
                                                            <a href="{{URL::to('/edit-pay/'.$pay->tt_ma)}}"><i class="ik ik-edit-2"></i></a>
                                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa phương thức thanh toán này?')"  href="{{URL::to('/delete-pay/'.$pay->tt_ma)}}"><i class="ik ik-trash-2"></i></a>
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
                


            


@endsection