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
                                            <h5>Quản lý đơn hàng</h5>
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
                                                <a href="#">Quản lý đơn hàng</a>
                                            </li>
                                            {{-- <li class="breadcrumb-item active" aria-current="page">Bootstrap Tables</li> --}}
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <?php
                        $message = Session::get('fail_message');
                        if ($message){
                            echo '<span class="alert alert-danger">'.$message."</span>";
                            
                            Session::put('fail_message',null);
                        }
                        $message = Session::get('success_message');
                        if ($message){
                            echo '<span class="alert alert-success">'.$message."</span>";
                            
                            Session::put('success_message',null);
                        }
                    ?>

                        <div class="row">
                            <div class="col-md-12">
								<div class="card">
                                    <div class="card-header d-block">
                                        <h3>Danh sách đơn hàng</h3>
                                        
                                    </div>
                                    <div class="card-body p-0 table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Mã đơn hàng</th>
                                                        <th>Tên người mua</th>
                                                        <th>Thông tin giao hàng</th>
                                                        <th>Ngày đặt hàng</th>
                                                        
                                                        <th>Hình thức thanh toán</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Trạng thái</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1; ?>
                                                	@foreach( $orders as $key => $order)
                                                    <tr>
                                                        <th scope="row">{{$i}}</th>
                                                        <td>{{$order->dh_ma}}</td>
                                                        <td>{{$order->nd_ten}}</td>
                                                        <td>{{$order->dh_tenNhan}} / {{$order->dh_diaChiNhan}} / {{$order->dh_dienThoai}} / {{$order->vc_ten}} </td>
                                                        <td>{{$order->dh_ngayDat}}</td>
                                                        
                                                        <td>{{$order->tt_ten}}</td>
                                                        <td>{{number_format($order->dh_tongTien).' VND'}}</td>
                                                        <td>
                                                            @switch($order->dh_trangThai)
                                                                @case('Chờ xử lý')
                                                                   <span class="badge badge-pill badge-warning">{{$order->dh_trangThai}}</span>
                                                                    @break

                                                                @case('Đã xử lý')
                                                                    <span class="badge badge-pill badge-primary">{{$order->dh_trangThai}}</span>
                                                                    @break

                                                                @case('Đang giao')
                                                                    <span class="badge badge-pill badge-info">{{$order->dh_trangThai}}</span>
                                                                    @break
                                                                @case('Đã giao')
                                                                   <span class="badge badge-pill badge-success">{{$order->dh_trangThai}}</span>
                                                                    @break
                                                                @case('Đã hủy')
                                                                   <span class="badge badge-pill badge-danger">{{$order->dh_trangThai}}</span>
                                                                    @break
                                                                    
                                                            @endswitch
                                                            </td>
                                                        <td><div class="table-actions" style="text-align: left">
                                                            
                                                                
                                                           @switch($order->dh_trangThai)
                                                                @case('Chờ xử lý')
                                                                    <button type="button" id="{{$order->dh_ma}}" class="btn btn-primary approve" data-toggle="modal" >Duyệt</button>
                                                                    @break

                                                                @case('Đã xử lý')
                                                                    <button type="button" id="{{$order->dh_ma}}" class="btn btn-info ship" data-toggle="modal" >Sẵn sàng giao</button>
                                                                    @break

                                                                @case('Đang giao')
                                                                    <button type="button" id="{{$order->dh_ma}}" class="btn btn-success complete" data-toggle="modal" >Hoàn tất</button>
                                                                    @break
                                                                @default
                                                                    
                                                            @endswitch
                                                            <br>
                                                            <a href="{{URL::to('/view-order/'.$order->dh_ma)}}"><i class="ik ik-eye f-16 mr-15 text-blue"></i></a>  
                                                            @if ($order->dh_trangThai != 'Đã hủy')
                                                            <i class="ik ik-x-circle cancel text-red" id="{{$order->dh_ma}}"></i>
                                                            @endif
                                                             {{-- <button type="button"  class="btn btn-danger " ><i class="ik ik-x-circle cancel" id="{{$order->dh_ma}}" ></i></button> --}}
                                                            
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

                <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           
                            <div class="modal-header">
                                <h5 class="modal-title" id="demoModalLabel">Duyệt đơn hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            Bạn có chắc chắn muốn duyệt đơn hàng này?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                <button type="button" id="ok_approve_btn" class="btn btn-success">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="shipModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <h5 class="modal-title" id="demoModalLabel">Sẵn sàng giao</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            Bạn đã sẵn sàng giao đơn hàng này?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                <button type="button" id="ok_ship_btn" class="btn btn-success">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <h5 class="modal-title" id="demoModalLabel">Hoàn tất đơn hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            Bạn đã giao hoàn tất đơn hàng này?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                <button type="button" id="ok_complete_btn" class="btn btn-success">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <h5 class="modal-title" id="demoModalLabel">Hủy đơn hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            Bạn có chắc chắn muốn hủy đơn hàng này?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                <button type="button" id="ok_cancel_btn" class="btn btn-success">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            

<script src="http://www.codermen.com/js/jquery.js"></script>
<script>
    $(document).ready(function(){

        //dat thi gian tat thong bao
        setTimeout(function(){
           $("span.alert").remove();
        }, 5000 ); // 5 secs

        var dh_ma;

        //duyet 
        $(document).on('click','.approve', function(){
            dh_ma = $(this).attr('id');
            $('#approveModal').modal('show');

        });

        $('#ok_approve_btn').click(function(){
            $.ajax({
                url: '<?php echo url('approve-order');?>/'+dh_ma,
                type: 'get',
                success: function(data)
                {
                    window.location.replace("<?php echo url('/manage-order');?>");
                }
            });
        });

        //giao
        $(document).on('click','.ship', function(){
            dh_ma = $(this).attr('id');
            $('#shipModal').modal('show');

        });

        $('#ok_ship_btn').click(function(){
            $.ajax({
                url: '<?php echo url('ship-order');?>/'+dh_ma,
                type: 'get',
                success: function(data)
                {
                    window.location.replace("<?php echo url('/manage-order');?>");
                }
            });
        });

        //hoan tat
        $(document).on('click','.complete', function(){
            dh_ma = $(this).attr('id');
            $('#completeModal').modal('show');

        });

        $('#ok_complete_btn').click(function(){
            $.ajax({
                url: '<?php echo url('complete-order');?>/'+dh_ma,
                type: 'get',
                success: function(data)
                {
                    /* location.reload();*/
                    window.location.replace("<?php echo url('/manage-order');?>");
                }
            });
        });

        //huy

        //hoan tat
        $(document).on('click','.cancel', function(){
            dh_ma = $(this).attr('id');
            $('#cancelModal').modal('show');

        });

        $('#ok_cancel_btn').click(function(){
            $.ajax({
                url: '<?php echo url('cancel-order');?>/'+dh_ma,
                type: 'get',
                success: function(data)
                {
                    window.location.replace("<?php echo url('/manage-order');?>");
                }
            });
        });

    });
</script>

@endsection