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
                                            <h5>Đơn hàng</h5>
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
                                                <a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><h3 class="d-block w-100">Mã đơn hàng: {{$order->dh_ma}} <small class="float-right">Ngày đặt: {{$order->dh_ngayDat}}</small></h3></div>
                            <div class="card-body">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Người đặt
                                        <address>
                                            <strong>{{$order->nd_ten}}</strong><br>{{$order->nd_diaChi}} <br>Phone: {{$order->nd_dienThoai}}<br>Email: {{$order->nd_email}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        Người nhận
                                        <address>
                                            <strong>{{$order->dh_tenNhan}}</strong><br>{{$order->dh_diaChiNhan}}<br>Phone: {{$order->dh_dienThoai}}<br>Email: {{$order->dh_email}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <b>Mã đơn hàng #{{$order->dh_ma}}</b><br>          
                                        <b>Hình thức vận chuyển:</b> {{$order->vc_ten}}<br>
                                        <b>Hình thức thanh toán:</b> {{$order->tt_ten}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>                                                
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Thành tiền</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i=1;
                                                    $congTien=0;

                                                ?>
                                                @foreach($items as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$item->sp_ten}}</td>
                                                    <td>{{$item->soLuongDat}}</td>
                                                    <td>{{number_format($item->sp_donGiaBan).' VND'}}</td>
                                                    <td>{{number_format($item->thanhTien).' VND'}}</td>
                                                    <?php $congTien = $congTien + $item->thanhTien; ?>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <p class="lead">Phương thức thanh toán:</p>
                                        <b>{{$order->tt_ten}}</b>
                                        <p class="lead">Trạng thái thanh toán:</p>
                                        @if ($order->tt_ten=='Tiền mặt')
                                            <b>Chưa thanh toán</b>
                                        @endif
                                        {{-- <img src="{{URL::to('public/backend/img/credit/visa.png')}}" alt="Visa">
                                        <img src="{{URL::to('public/backend/img/credit/mastercard.png')}}" alt="Mastercard">
                                        <img src="{{URL::to('public/backend/img/credit/american-express.png')}}" alt="American Express">
                                        <img src="{{URL::to('public/backend/img/credit/paypal2.png')}}" alt="Paypal"> --}}
                                        
                                        <div class="alert alert-secondary mt-20">
                                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                        </div>
                                    </div>
                                    <div class="col-6">
                                       {{--  <p class="lead">Amount Due 10/11/2018</p> --}}
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Cộng tiền:</th>
                                                    <td>{{number_format($congTien).' VND'}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Khuyến mãi:</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Phí vận chuyển:</th>
                                                    <td>{{number_format($order->vc_phi).' VND'}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng tiền thanh toán:</th>
                                                    <td>{{number_format($congTien+$order->vc_phi).' VND'}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-print">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection