@extends('admin.main.main')

@section('title', 'Admin Registration')


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
        <form class="form-horizontal border_class" method="POST" action="{{ route('admin.newpasswordadmin_new_pass') }}">
            @csrf
            <div class="form-group">
                <label for="password"> New Password &nbsp; <i class="fa fa-key" aria-hidden="true" style="font-size: 20px;color:green"></i>  </label> 
                  
                 <input type="password" name="password"  class="form-control" id="password" placeholder="New Password"  required>
                 <small class="text_info">Plese Enter Your New Password.</small>
              </div>
    
             
       
              <button type="submit" class="btn btn-success">Send</button>
            </form>
      
      </div>
  
      <div class="col-md-2"></div>


    </div>
  </div>

  @stop
