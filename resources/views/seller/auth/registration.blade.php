@extends('seller.main.main')

@section('title', 'Seller Registration')


@section('main_body')

    {{-- Main  Section  --}}

    <div class="container form_style">
        <div class="row ">
          <div class="col-md-2"></div>
          <div class="col-md-8 center_div">
            <form class="form-horizontal border_class" method="POST" action="">
          @csrf
        <div class="form-group">
            <label for="phone_number">Your Phone Number &nbsp; <i class="fa fa-mobile" aria-hidden="true" style="font-size: 30px;color:green"></i>  </label> 
              
              &nbsp; <input type="tel" pattern=".{11}" class="form-control" id="phone_number" placeholder="Your Phone Number" oninput="check(this)" required>
          </div>

          <div class="form-group">
            <label for="password">Password &nbsp; <i class="fa fa-mobile" aria-hidden="true" style="font-size: 30px;color:green"></i>  </label> 
              
              &nbsp; <input type="password"  class="form-control" id="password" placeholder="Password"  required>
          </div>
   
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      
    </div>

    <div class="col-md-2"></div>


  </div>
</div>

  @stop
