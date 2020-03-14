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
                                            <h5>Quản lý hình thức vận chuyển</h5>
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
                                                <a href="#">Quản lý hình thức vận chuyển</a>
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
                                        <h3>Danh sách hình thức vận chuyển</h3>
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
                                                        <th>Mã vận chuyển</th>
                                                        <th>Tên vận chuyển</th>
                                                        <th>Chi phí vận chuyển</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php {{$i=1;}} ?>
                                                    @foreach( $list_transport as $key => $transport)

                                                    <tr>
                                                        <th scope="row">{{$i}}</th>
                                                        <td>{{$transport->vc_ma}}</td>
                                                        <td>{{$transport->vc_ten}}</td>
                                                        <td>{{$transport->vc_phi}}</td>
                                                        <td><div class="table-actions">                                                  
                                                            <a href="{{URL::to('/edit-transport/'.$transport->vc_ma)}}"><i class="ik ik-edit-2"></i></a>
                                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa hình thức vận chuyển này?')"  href="{{URL::to('/delete-transport/'.$transport->vc_ma)}}"><i class="ik ik-trash-2"></i></a>
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