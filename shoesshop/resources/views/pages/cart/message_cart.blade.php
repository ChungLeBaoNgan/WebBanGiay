@extends('shop_layout')
@section('content')


    <div class="hero-wrap hero-bread" style="background-image: url({{URL::to('public/frontend/images/bg_6.jpg')}});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Trang chủ</a></span> <span>Giỏ hàng</span></p>
            <h1 class="mb-0 bread">Giỏ hàng của tôi</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">

		<div class="container">
			<?php
		            	$message = Session::get('message');
		            	if ($message){
		            		echo '<span class="alert alert-danger">'.$message."</span>";
		            		
		            		Session::put('message',null);
		            	}
		            ?>
			<?php
				$content = Cart::content();
			?>
		</div>
	</section>
@endsection