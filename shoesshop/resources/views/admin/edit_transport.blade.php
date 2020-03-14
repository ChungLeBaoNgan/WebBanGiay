
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
                                                <a href="{{URL::to('/manage-product')}}">Quản lý hình thức vận chuyển</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa thông tin hình thức vận chuyển</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>


                                <div class="card">
                                    <div class="card-header"><h3>Chỉnh sửa thông hình thức vận chuyển</h3></div>
                                    <div class="card-body">
                                        @foreach($list_transport as $key => $edit)
                                        <form class="forms-sample" action="{{URL::to('/update-transport/'.$edit->vc_ma)}}" method="POST" enctype="multipart/form-data" >
                                             {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleInputName1">Tên hình thức vận chuyển</label>
                                                <input type="text" name="transport_name" class="form-control" id="exampleInputName1" value="{{$edit->vc_ten}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Chi phí</label>
                                                <input type="text" name="transport_price" class="form-control" id="exampleInputName1" value="{{$edit->vc_phi}}">
                                            </div>
                                            
                                            <button type="submit" name="add_pro" class="btn btn-primary mr-2">Cập nhật</button>
                                            <button class="btn btn-light">Hủy</button>
                                        </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                
@endsection


@section('script_components')

        <script src="{{asset('public/backend/dist/js/theme.min.js')}}"></script>
        <script src="{{asset('public/backend/js/form-components.js')}}"></script>


@endsection