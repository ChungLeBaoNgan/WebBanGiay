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
                            <div class="card-header"><h3 class="d-block w-100">Mã đơn hàng: 110 <small class="float-right">Ngày: 12/11/2018</small></h3></div>
                            <div class="card-body">
                                <div class="row invoice-info">
                                    {{-- <div class="col-sm-4 invoice-col">
                                        Người đặt
                                        <address>
                                            <strong>ThemeKit,</strong><br>795 Folsom Ave, Suite 546 <br>San Francisco, CA 54656 <br>Phone: (123) 123-4567<br>Email: info@themekit.com
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        Người nhận
                                        <address>
                                            <strong>John Doe</strong><br>795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br>Phone: (555) 123-7654<br>Email: john.doe@example.com
                                        </address>
                                    </div> --}}
                                    <div class="col-sm-4 invoice-col">
                                        <b>Mã phiếu nhập #007612</b><br>
                                        <br>          
                                        {{-- <b>Hình thức vận chuyển:</b> VNPOST<br>

                                        <b>Tài khoản:</b> hoangmy123 --}}
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
                                                    <th>Đơn giá nhập</th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Call of Duty</td>
                                                    <td>2</td>
                                                    <td>{{number_format('599000').' VND'}}</td>
                                                   
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row no-print">
                                    <div class="col-12">
                                        
                                        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection