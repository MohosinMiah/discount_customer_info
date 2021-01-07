@extends('admin.main.main')

@section('title', 'Admin Registration')


@section('main_body')

    {{-- Main  Section  --}}

<div class="container">
    <div class="row">
      
      <form class="form-inline" method="POST">
        
        <div class="form-group">
          <label for="password">Password &nbsp; <i class="fa fa-key" aria-hidden="true" style="font-size: 20px;color:green"></i>  </label> 
            
           <input type="password" class="form-control" name="password" id="password" placeholder="Password"  required>
        </div>
 
   
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
  
  
    </div>
  </div>

  @stop
