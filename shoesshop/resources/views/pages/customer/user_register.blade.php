@extends('shop_layout')
@section('content')

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10 ftco-animate">
             <div class="col-md-12">
            <div class="container"><h3 class="mb-4 billing-heading" style="text-align: center; font-size: 35px;">Register</h3>
           
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
                 <form action="{{URL::to('postregister')}}" method="post" name="formRegister" onsubmit="return check_email();">
                                {{csrf_field()}}
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                                
                                   
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                                    <input type="text" name="user_name" class="form-control" placeholder="Name" required="">
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" name='user_birth' class="form-control" placeholder="Birthday yyyy-mm-dd" required>
                                    <i class="ik ik-user"></i>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="user_phone" class="form-control" placeholder="Phone number" required="">
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="rdGioitinh" value="Male" checked> Male&emsp;&emsp;&emsp;
                                    <input type="radio" name="rdGioitinh" value="Female"> Female<br>
                                </div>
                                 <div class="form-group">
                                    <textarea name="user_address"  class="form-control" rows="3" cols="20" placeholder="Address" required></textarea>                
                                </div>
                </div>
                <div class="col-md-6">
                     <!-- <div style="background-color: red;">Cột thứ 2 tỉ lệ 2</div> -->

                                <div class="form-group">
                                    <input type="text" name="user_email" class="form-control" placeholder="Email" required="">
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="user_password" class="form-control" placeholder="Password" required="">
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="user_confirm_pass" class="form-control" placeholder="Confirm Password" required="">
                                    <i class="ik ik-eye-off"></i>
                                </div>
                               
                                {{-- <div class="row">
                                    <div class="col-12 text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                            <span class="custom-control-label">&nbsp;I Accept <a href="#">Terms and Conditions</a></span>
                                        </label>
                                    </div>
                                </div> --}}
                                 
                                <div class="sign-btn text-center">
                                    <button type="submit" class="btn btn-theme btn-primary py-3 px-4">Create Account</button>
                                </div>
                            </form>
                            <div class="register">
                                <p>Already have an account? <a href="{{URL::to('/userLogin')}}">Log In</a></p>
                            </div>
                        </div>


          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
@endsection