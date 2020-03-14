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

			@if ($content->isempty())
				<p class="text-center"><a href="{{URL::to('/')}}" class="btn btn-primary py-3 px-4">MUA HÀNG NGAY!</a></p>
			@else

			<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div id='updateDiv'>
					
		            <div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
							     <tr class="text-center">
							        <th>STT</th>
							        <th>Mã sản phẩm</th>
							        <th>Hình ảnh</th>
							        <th>Sản phẩm</th>
							        <th>Kích cỡ</th>
							        <th>Đơn giá</th>
							        <th>Số lượng</th>
							        <th>Thành tiền</th>
							        <th>&nbsp;</th>
							    </tr>
						    </thead>
						    <?php $count=1; ?>
							@foreach($content as $v_content)<!-- tien -->
							    <tbody>
								    <tr class="text-center">
								      	<td class="product-price">
								        	<h4>1</h4>
								        </td>
								        <td class="product-id">
								        	<h3>{{$v_content->id}}</h3>
								        	
								        </td>
								        <td class="image-prod"><div class="img" style="background-image:url({{URL::to('public/upload/product/'.$v_content->options->image)}});" ></div></td>
								        
								        <td class="product-name">
								        	<h3>{{$v_content->name}}</h3>
								        	
								        </td>
								        <td class="quantity">
								        	
								        	<select name="size" id="size"  class="form-control size<?php echo $count; ?>">
							                    
							                    <?php 
								                    $product = DB::Table('chitietsanpham')->select('sp_ma','ctsp_soLuongTon')->where('ctsp_ma',$v_content->id)->first();
								                    $sizes = DB::Table('chitietsanpham')->select('ctsp_kichCo','ctsp_ma')->where('sp_ma',$product->sp_ma)->get();  
							                    ?>
							                    @foreach($sizes as $key => $value)
							                    	@if ($v_content->options->size == $value->ctsp_kichCo )
							                        <option value="{{$value->ctsp_kichCo}}" selected>{{$value->ctsp_kichCo}}</option>
							                        @else
							                        	<option value="{{$value->ctsp_kichCo}}">{{$value->ctsp_kichCo}}</option>
							                        @endif
							                    @endforeach
							                </select>
							               								        	
								        </td>
								        
								        <td class="price">{{number_format($v_content->price).' '.'vnđ'}}</td>
								        
								        <td class="quantity">
									        
										        <div class="input-group mb-3" id="divquantity">		
										        	<input type="hidden" value="{{$v_content->rowId}}" id="rowId<?php echo $count; ?>" name="rowId" class="form-control">
										        	<input type="hidden" value="{{$product->sp_ma}}" id="sp_ma<?php echo $count; ?>" name="sp_ma" class="form-control">
										        	<input type="hidden" value="{{$v_content->id}}" id="ctsp_ma<?php echo $count; ?>" name="ctsp_ma" class="form-control">								        	
														
							             			<input type="number" name="quantity" id="upCart<?php echo $count; ?>" class="quantity form-control input-number" value="{{$v_content->qty}}" min="1" max="{{$product->ctsp_soLuongTon}}">
							             			    	
									          	</div>
									          	
									        
							         	</td>
								        <td class="total">
								        	<p class="cart_total_price">
											
											<?php
											$subtotal = $v_content->price * $v_content->qty;
											echo number_format($subtotal).' '.'vnđ';
											?><!-- Tien -->
										</p>
								        </td>
								        <td class="product-remove">
								         	<a class="ion-ios-close" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
								         	
								         </td>
								         
							         
							      		</tr><!-- END TR-->
							    	</tbody>
							    <?php $count++; ?>
							@endforeach 

						</table>
					</div>
</div>

    			</div>

    		</div>
	    	<div class="row justify-content-start">
	    		<div class="col-md-12 ftco-animate">
	    			<div class="cart-total mb-3">
	    				<h3 class="billing-heading mb-4" align="right">Thành tiền giỏ hàng: &emsp;{{Cart::subtotal().' '.'vnđ'}}</h3>		
	    			</div>
	    			<p class="text-center"><a href="{{URL::to('/')}}" class="btn btn-primary py-3 px-4">MUA HÀNG</a>
	    			<a href="{{URL::to('/checkout')}}" class="btn btn-primary py-3 px-4">ĐẶT HÀNG</a></p>
	    		</div>
	    	</div>
	    	@endif
	    

	</div>


	<script src="http://www.codermen.com/js/jquery.js"></script>
    <script type="text/javascript">
    	    function rating(a){
			  console.log((a.parentElement).parentElement.parentElement.childNodes[3].childNodes[1].innerHTML);
			  var ctsp_ma = (a.parentElement).parentElement.parentElement.childNodes[3].childNodes[1].innerHTML;
			 /* var size_id = a.innerHTML;
                console.log(size_id);*/
			}
			
			
        $(document).ready(function(){
            $('select[name="size"]').on('change',function(){
                var size_id = $(this).val();
                console.log(size_id);
                var ctsp_ma = $.trim(($(this).parent()).parent().children().eq(1).text());
            		console.log(ctsp_ma,'ctsp_ma');
                if(size_id){

                    $.ajax({

                        url: "{{url('getStock')}}",
                        dataType: 'json',
                        type: 'GET',
                        data:{
                        	size_id: size_id,
                        	ctsp_ma: ctsp_ma
                        },
                        
                        success: function(data){
                            console.log(data);
                             $('select[name="stock"]').empty();
                             $.each(data, function(name,stock){
                                /*$('select[name="stock"]').append('<option value="'+stock+'">'+stock+'</option>');
*/
								 /*$('input[name="quantity"]').replaceWith('<input type="number" onchange="this.form.submit()" name="quantity" class="quantity form-control input-number" value="1" min="1" max="'+stock+'">');*/
								 /* $('input[name="quantity"]').replaceWith('<input type="number"  name="quantity" id="upCart" class="quantity form-control input-number" value="1" min="1" max="'+stock+'">');*/
								  $('input[name="quantity"]').attr({
								       "max" : stock,        // substitute your own
								       "min" : 1          // values (or variables) here
								    });
                              
                             });
                        }
                    });
                }else{
                     $('select[name="stock"]').empty();
                }
            });

			<?php 
				$count = Cart::count();

				for($i=1; $i<=$count; $i++){
			?>
			$('#upCart<?php echo $i; ?>').on('change keyup', function(){
				var newqty = $('#upCart<?php echo $i; ?>').val();
				var rowId = $('#rowId<?php echo $i; ?>').val();
				var ctsp_ma = $('#ctsp_ma<?php echo $i; ?>').val();
				var sp_ma = $('#sp_ma<?php echo $i; ?>').val();
				var size = $('.size<?php echo $i; ?>').val();

				// alert(newqty+' '+rowId+' '+ctsp_ma);
				if (newqty <=0 ){
					alert('Số lượng không hợp lệ! Số lượng lớn hơn 0');
				} else{

					$.ajax({
						type: 'get',
						dataType: 'html',
						url: '<?php echo url('update-qty');?>/'+ctsp_ma,
						data: "qty="+newqty+"&rowId="+rowId+"&ctsp_ma="+ctsp_ma+"&sp_ma="+sp_ma+"&size="+size,
						success: function(response){
							console.log(response);
							  $('#updateDiv').html(response);
						}
					});

					/*alert(newqty+' '+rowId+' '+ctsp_ma);*/
				}


			});
			<?php } ?>

        });
    </script>
</section>
@endsection
		