@extends('shop_layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/frontend/images/bg_6.jpg')}});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Trang chủ</a></span> <span>Thanh toán</span></p>
            <h1 class="mb-0 bread">Thanh toán</h1>
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
                                                        {{-- <inget type="number" name="cart_quantity" class="quantity form-control inget-number" value="{{$v_content->qty}}" min="1" max="100"> --}}       
                                                
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
	          	<div class="col-md-12 d-flex">
	          		<div class="cart-detail cart-total bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Thông tin giao hàng</h3>
	          				<?php 
                                echo '<p class="d-flex"><span>Tên người nhận </span>';
                                echo '<span>'.Session::get('dh_tenNhan').'</span></p>';
                               echo '<p class="d-flex"><span>Địa chỉ</span>';
						        echo '<span>'.Session::get('dh_diaChiNhan').'</span></p>';
						       echo '<p class="d-flex"><span>Điện thoại</span>';
						        echo '<span>'.Session::get('dh_dienThoai').'</span></p>';
						       echo '<p class="d-flex"><span>Email</span>';
						        echo '<span>'.Session::get('dh_email').'</span></p>';
						       
						        echo '<p class="d-flex"><span>Ngày đặt</span>';
						        $date =date_create(Session::get('dh_ngayDat'));
						        echo '<span>'.date_format($date,"d/m/Y ").'</span></p>';
						        					       
						       echo '<p class="d-flex"><span>Hình thức vận chuyển</span>';
						        echo '<span>'.Session::get('vc_ten').'</span></p>';
						        echo '<p class="d-flex"><span>Ghi chú</span>';
						        echo '<span>'.Session::get('dh_ghiChu').'</span></p>';
						    ?>
	          		</div>
                    <div class="cart-detail cart-total bg-light p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Tổng tiền giỏ hàng</h3>
                        <p class="d-flex">
                            <span>Thành tiền</span>
                            <span>{{number_format((double)Cart::subtotal(2,'.','')).' VND'}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Phí giao hàng</span>
                            <?php (int)$phi=Session::get('vc_phi'); ?>
                            <span>{{number_format($phi).' VND'}}</span>
                        </p>
                        
                        <hr>
                        <p class="d-flex total-price">
                            <span>Tổng tiền</span>
                            <?php $subtt =(double)Cart::subtotal(2,'.',''); ?> {{-- bo dau hang nghin, chuyen sau thap phan thanh , --}}
                            <span>{{number_format($subtt+$phi).' VND'}}</span>
                            <?php Session::put('dh_tongTien',number_format((double)Cart::subtotal(2,'.','')));?>
                        </p>
                    </div>
	          		<div class="cart-detail bg-light p-3 p-md-4">
	          			<form action="{{URL::to('/order-place')}}" method="POST">
							{{csrf_field()}}
		          			<h3 class="billing-heading mb-4">Hình thức thanh toán</h3>
		          			<div class="payment-options">
		          			@foreach($ma_thanhtoan as $key => $matt)
			          			<div class="form-group">
									<div class="col-md-12">
										<div class="paymentradio">
											<label><input type="radio" name="optradio" value="{{$matt->tt_ma}}" class="mr-2">{{$matt->tt_ten}}</label>
										</div>
									</div>
								</div> 
	                        @endforeach									
							<button type="submit" class="btn btn-theme btn-primary py-3 px-4">Hoàn tất</button>
							</div>
						</div>
					</form>

	          </div>
          </div> <!-- .col-md-8 -->

    </section> <!-- .section -->
		


@endsection