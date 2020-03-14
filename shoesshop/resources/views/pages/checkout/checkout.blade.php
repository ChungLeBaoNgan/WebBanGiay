@extends('shop_layout')
@section('content')
 
    <!-- Start Ngân (12/3/2020) -->
   <script type="text/javascript" src="https://code.jquery.com/jquery-latest.pack.js"></script>
   <script>
       $(document).ready(function(){
        $('#coupon_btn').click(function(){
            var coupon_id= $('#coupon_id').val();
            //alert(coupon_id);
            $.ajax({
                url:'{{url('/checkCoupon')}}',
                data: 'code=' + coupon_id,
                success:function(res){
                //alert(res);
               $('#show_total').html(res);
                }
            })
        });
       });
       
     </script>
    <!-- End Ngân (12/3/2020) -->
	<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/frontend/images/bg_6.jpg')}});">
     	<div class="container">
        	<div class="row no-gutters slider-text align-items-center justify-content-center">
          		<div class="col-md-9 ftco-animate text-center">
          			<p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Trang chủ</a></span> <span>Đặt hàng</span></p>
            		<h1 class="mb-0 bread">Đặt hàng</h1>
          		</div>
        	</div>
      	</div>
    </div>

    <section class="ftco-section">
    	<div class="container">
        	
			<?php
                $content = Cart::content();
            ?>
          	<div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">

                        <table class="table">
                            <thead class="thead-primary">
                                 <tr class="text-center">
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Kích cỡ</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    
                                </tr>
                            </thead>

                            @foreach($content as $v_content)<!-- tien -->
                                <tbody>
                                    <tr class="text-center">
                                        <td class="product-price">
                                            <h4>1</h4>
                                        </td>
                                        <td class="image-prod"><div class="img" style="background-image:url({{URL::to('public/upload/product/'.$v_content->options->image)}});" ></div></td>
                                        
                                        <td class="product-name">
                                            <h3>{{$v_content->name}}</h3>
                                            
                                        </td>
                                        <td class="quantity">
                                            <h3>{{$v_content->options->size}}</h3>                                          
                                        </td>
                                        
                                        <td class="price">{{number_format($v_content->price).' '.'vnđ'}}</td>
                                        
                                        <td class="quantity">
                                            <h4>{{$v_content->qty}}</h4>
                                                        {{-- <input type="number" name="cart_quantity" class="quantity form-control input-number" value="{{$v_content->qty}}" min="1" max="100"> --}}       
                                                
                                        </td>
                                        <td class="total">
                                            <p class="cart_total_price">
                                            
                                            <?php
                                            $subtotal = $v_content->price * $v_content->qty;
                                            echo number_format($subtotal).' '.'vnđ';
                                           
                                            ?><!-- Tien -->
                                        </p>
                                        </td>
                                        </tr><!-- END TR-->
                                    </tbody>
                            @endforeach 
                        </table>
                    </div>
                </div>
            </div>
	         <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Thông tin giao hàng</h3>
	          			<form action="{{URL::to('save-checkout-customer')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="dh_tenNhan" class="form-control" placeholder="Họ và tên người nhận" required="">
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="form-group">
                                    <input type="Email" name="dh_email" class="form-control" placeholder="Email" required="" >
                                    <i class="ik ik-user"></i>
                                </div>
                                
                                <div class="form-group">
                                    <textarea name="dh_diaChiNhan"  class="form-control" rows="3" cols="20" placeholder="Địa chỉ nhận hàng" required></textarea>                
                                </div>
                                <div class="form-group">
                                    <input type="text" name="dh_dienThoai" class="form-control" placeholder="Điện thoại" required="">
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="form-group">
                            <label for="exampleInputPassword1">Phương thức vận chuyển</label>
                            <select name="vc_ma" class="form-control m-bot15">
                                @foreach($ma_vanchuyen as $key => $mavc)
                                <option value="{{$mavc->vc_ma}}">{{$mavc->vc_ten}}</option>
                                @endforeach
                            </select>
                        </div>
                                <div class="form-group">
                                    <textarea name="dh_ghiChu"  class="form-control" rows="3" cols="20" placeholder="Ghi chú giao hàng" required></textarea>                
                                </div>
                                <div class="sign-btn text-center">
                        		<button type="submit" class="btn btn-theme btn-primary py-3 px-4">Tiếp tục đến phương thức thanh toán</button>
                   				</div>

                            </form> 
					</div>
	          	</div>
                

                <div class="col-md-6 d-flex" id="show_total" >
                    <!-- <div class="cart-detail cart-total bg-light p-3 p-md-4">
           Start Ngân (12/3/2020) 
                        <div class="form-group">
                                <input name="coupon_code" id="coupon_id" class="form-control" rows="3" cols="20" placeholder="Mã giảm giá" required>            
                        </div>
                        <div class="sign-btn text-center">
                                <input type="button" value="Áp dụng" id="coupon_btn" class="btn btn-theme btn-primary py-3 px-4">
                        </div>
                         <br>
          ENd Ngân (12/3/2020)

                        <h3 class="billing-heading mb-4">Tổng tiền giỏ hàng</h3>
                        <p class="d-flex">
                            <span>Thành tiền</span>
                            <span>{{number_format((double)Cart::subtotal(2,'.','')).' VND'}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Phí giao hàng</span>
                            <?php (int)$phi=40000; ?>
                            <span>{{number_format($phi).' VND'}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Giảm giá</span>
                            <?php $giam= $giamgia ?>
                            <span>{{'-'number_format($giam).' VND'}}</span>
                        </p>
                        
                        <hr>
                        <p class="d-flex total-price">
                            <span>Tổng tiền</span>
                            <?php $subtt =(double)Cart::subtotal(2,'.',''); ?> {{-- bo dau hang nghin, chuyen sau thap phan thanh , --}}
                            <span>{{number_format($subtt+$phi).' VND'}}</span>
                        </p>
                    </div> -->
                </div>
            </div>
                
           

          
      </div>
    </section> <!-- .section -->

@endsection