@extends('customer.main.main')

@section('title', 'Seller Forgotten Password')


@section('main_body')

    {{-- Main  Section  --}}

<div class="container form_style">
    <div class="row ">
      <div class="col-md-2"></div>
      <div class="col-md-8 center_div">
        <form class="form-horizontal border_class" method="POST" action="">
            @csrf
            <div class="form-group">
                <label for="opt_code"> OPT Code &nbsp; <i class="fa fa-mobile" aria-hidden="true" style="font-size: 20px;color:green"></i>  </label> 
                  
                 <input type="text" pattern=".{4}" class="form-control" id="opt_code" placeholder="Your OPT Code" oninput="check(this)" required>
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
