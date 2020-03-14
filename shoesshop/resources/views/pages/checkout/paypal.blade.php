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
    		<div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-12 d-flex">
	          		<div class="cart-detail cart-total bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Hoàn tất đặt hàng</h3>
                    	<p class="d-flex">
                        	<span>
								<p>PAYPAL
								</p>
								<p>Hope you enjoy shopping with us!</p>
							</span>
						</p>
						<a href="{{URL::to('/')}}" class="btn btn-primary py-3 px-4">TRANG CHỦ</a>
					</div>

				</div>
			</div>
		</div>
	</section>

	

@endsection