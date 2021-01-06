@extends('admin.main.main')

@section('title', 'Admin Login')


@section('main_body')

    {{-- Main  Section  --}}

<div class="container form_style">
    <div class="row ">
      <div class="col-md-2"></div>
      <div class="col-md-8 center_div">
        <form class="form-horizontal border_class" method="POST" action="">
            @csrf
            <div class="form-group">
                <label for="phone_number">Phone Number &nbsp; <i class="fa fa-mobile" aria-hidden="true" style="font-size: 20px;color:green"></i>  </label> 
                  
                 <input type="tel" pattern=".{11}" class="form-control" id="phone_number" placeholder="Your Phone Number" oninput="check(this)" required>
              </div>
    
              <div class="form-group">
                <label for="password">Password &nbsp; <i class="fa fa-key" aria-hidden="true" style="font-size: 20px;color:green"></i>  </label> 
                  
                 <input type="password" class="form-control" id="password" placeholder="Password"  required>
              </div>
       
              <button type="submit" class="btn btn-success">Login</button>
              <div class="forgotten_password"><a href="{{ route('admin.forgottenadmin_forgotten_password') }}">Forgotten Password</a></div>
            </form>
      
      </div>
  
      <div class="col-md-2"></div>


    </div>
  </div>

  @stop
