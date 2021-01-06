@extends('admin.main.main')

@section('title', 'Admin Registration')


@section('main_body')

    {{-- Main  Section  --}}

<div class="container">
    <div class="row">
      
      <form class="form-inline" method="POST">
          <div class="form-group">
            <label for="phone_number">Your Phone Number &nbsp; <i class="fa fa-mobile" aria-hidden="true" style="font-size: 30px;color:green"></i>  </label> 
              
              &nbsp; <input type="tel" pattern=".{11}" class="form-control" id="phone_number" placeholder="Your Phone Number" oninput="check(this)" required>
          </div>
   
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
  
  
    </div>
  </div>

  @stop
