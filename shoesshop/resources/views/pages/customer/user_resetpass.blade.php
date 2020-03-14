@extends('shop_layout')
@section('content')
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10 ftco-animate">
             <div class="col-md-6">
            
              <h3 style="color: black; text-align: center;"><b>Lấy lại mật khẩu</b></h3>

                <p style="color: red;">
                  <b>
                    <?php
                      $message=Session::get('message');
                       if($message){
                         echo $message; 
                        Session::put('message',null);
                        }
                    ?>
                  </b>
                </p>
                  <form action="{{URL::to('post-resetpass')}}" method="post">
                    {{csrf_field()}}
                    <!-- <p>Vui lòng nhập email để lấy lại mật khẩu.</p> -->

                    <?php 
                      $customer_email = Session::get('nd_email');
                    ?>
                    @if ($customer_email) 
                      <div class="form-group">
                        <input type="email" class="form-control" name="user_reset_mail" placeholder="Email" value={{$customer_email}} required> 
                      </div>
                    @else
                      <li class="nav-item"><a href="{{URL::to('userLogin')}}" class="nav-link">Login</a></li>
                      <li class="nav-item"><a href="{{URL::to('register')}}" class="nav-link">Register</a></li>
                    @endif
                    

                    <div class="form-group">
                      <input type="email" class="form-control" name="user_reset_pass" placeholder="Mật khẩu" required> 
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control" name="user_reset_pass_confirm" placeholder="Mật khẩu xác nhận" required> 
                    </div>

                    <div class="sign-btn text-center">
                        <button type="submit" class="btn btn-theme btn-primary py-3 px-4">Xác nhận</button>
                   </div>
                
                </form>

           </div>     


          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
@endsection