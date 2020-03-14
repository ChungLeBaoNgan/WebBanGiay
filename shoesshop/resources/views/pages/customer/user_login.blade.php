@extends('shop_layout')
@section('content')
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10 ftco-animate">
             <div class="col-md-6">
            
            <h2 style="color: black; text-align: center;"><b>Đăng nhập</b></h1>
            <h5 style="color: black; text-align: center;"><b>Người dùng</b></h3>
            <p style="color: red;"><b><?php
                $message=Session::get('message');
                 if($message){
                   echo $message; 
                  Session::put('message',null);
               }
            ?></b></p> 


            <p style="color: red;"><b><?php
                $message1=Session::get('message1');
                 if($message1){
                  echo $message1;
                  Session::put('message1',null);
               }
            ?></b></p>
            @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Lỗi</strong><br>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
           
                  <form action="{{URL::to('user_home')}}" method="post">
                    {{csrf_field()}}
                     
                <!--/<div class="row align-items-end">  --> 
            
                    <div class="form-group">
                      <input type="text" class="form-control" name="user_email" placeholder="Email" required> 
                    </div>
                    <div class="form-group">
                      <input type="password" name="user_password" class="form-control" placeholder="Mật khẩu" required><br>
                    </div>

                    <p>Quên mật khẩu? <a href="{{URL::to('/email_resetpass')}}" style="color: blue;">Nhấn vào đây</a></p>

                    <div class="sign-btn text-center">
                        <button type="submit" class="btn btn-theme btn-primary py-3 px-4">Đăng nhập</button>
                   </div>
                
                  
                </form>
<br>
                 <div class="register">
                     <p style="text-align: center;">Bạn chưa có tài khoản? <a href="{{URL::to('/register')}}" style="color: red;">Tạo tài khoản</a></p>
                  </div>
           </div>     


          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
@endsection