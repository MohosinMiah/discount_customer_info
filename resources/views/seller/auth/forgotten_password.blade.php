@extends('admin.main.main')

@section('title', 'Admin Forgotten Password')


@section('main_body')

    {{-- Main  Section  --}}

<div class="container form_style">

          {{-- Display Error Message  --}}
          <div class="row">
            <div class="col-md-12">
        
               {{-- Display Error Message  --}}
              @include('admin.error.error')
            
            </div>
          </div>
          
    <div class="row ">
      <div class="col-md-2"></div>
      <div class="col-md-8 center_div">
        <form class="form-horizontal border_class" method="POST" action="{{ route('seller.otpseller_send_otp') }}">
            @csrf
            <div class="form-group">
                <label for="phone"> Phone Number &nbsp; <i class="fa fa-mobile" aria-hidden="true" style="font-size: 20px;color:green"></i>  </label> 
                  
                 <input type="text" name="phone" pattern=".{11}" class="form-control" id="phone" placeholder="Phone Number" oninput="check(this)" required>
                 <small class="text_warning">Please Check your Mobile Text Message For OTP.</small>
              </div>
    
             
       
              <button type="submit" class="btn btn-success">Send</button>
              <div class="resend_code"><a href="#">Resend</a></div>
            </form>
      
      </div>
  
      <div class="col-md-2"></div>


    </div>
  </div>

  @stop
