<!DOCTYPE html>
<html lang="en">
<head>
  <title>DISCOUNT A2Z - @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- Style Files *************************    --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="{{ URL::asset('/css/global.css') }}">
  
  

</head>
<body>

  {{-- Header Section  --}}
<div class="jumbotron text-center top-header">
  <h1>DISCOUNT A2Z</h1>
  <p>Here There EveryWhere</p> 

  <div class="logo">
    <a href="/"> <img src="{{url('/images/discounta2z-logo.png')}}" alt="Discount Logo"> </a>
  </div>

  <div class="notice">
    <h3><marquee>Welcome to DISCOUNT A2Z. Admin says "Next 20 days we fixed a target that we increase our consumer number upto 2000."</marquee></h3>

  </div>

</div>
  


{{-- Main  Section  --}}
<div class="container">
  <div class="row">
    <div class="col-sm-6">
     <a href="{{ route('admin.loginadmin_login') }}"> <h3> <i class="fa fa-user" style="font-size:55px;color:green" data-toggle="tooltip" data-placement="top" title="Admin Login"></i></h3></a>
      <p>Admin Dashboard Access <a href="{{ route('admin.loginadmin_login') }}">Click Here .. <i class="fa fa-dashboard" style="font-size:28px;color:red"></i></a> </p>
      <p><strong>Login for Manage Sellers and Consumers</strong></p>
    </div>

    <div class="col-sm-6">
      <a href="{{ route('admin.loginadmin_login') }}"> <h3> <i class="fa fa-user" style="font-size:55px" data-toggle="tooltip" data-placement="top" title="Sellers Login"></i></h3></a>
       <p>Seller Dashboard Access <a href="{{ route('seller.loginseller_login') }}">Click Here .. <i class="fa fa-dashboard" style="font-size:28px;color:red"></i></a> </p>
       <p><strong>Login for Manage Consumers or Customers</strong></p>
     </div>
 
 
  </div>
</div>


{{-- Footer Section  --}}
<div class="container-fluid footer">
  <div class="row">
    <div class="col-sm-12 col-md-12">

      <p><strong>All Right Preserved &copy;<a href="#" class="copy_right_link"> DISCOUNT A2Z </a></strong></p>
    </div>

  </div>
</div>


  {{-- Javascript  Files *************************    --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  {{-- Javascript  For Tool Tip *************************    --}}
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>



</body>
</html>
