<?php
require(__DIR__ . "/../../lib/functions.php");
require(__DIR__ . "/../../partials/nav.php");


?>


<head>
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=3">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>

<body>
    

<div class="jumbotron text-center">
  <h1> Dashboard </h1>
</div>


<ul class="list-unstyled">
<div class="container">
  <div class="row align-items-start">
    <div class="col-md-3 mx-auto m-2 bg-danger ">
    <li class="col-md-5  mx-auto m-2 bg-danger text-nowrap"  ><a class="nav-link" href="<?php echo get_url('profile.php');?>">Profile</a></li>
    
    </div>
    
    <div class="col-md-3 mx-auto m-2 bg-danger " >
    <li class="col-md-7  mx-auto m-2 bg-danger text-nowrap"  ><a class="nav-link" href="<?php echo get_url('create_account.php'); ?>">Create Account</a></li>
    </div>


    <div class="col-md-3 mx-auto m-2 bg-danger" >
    <li class="col-md-6  mx-auto m-2 bg-danger text-nowrap"  ><a class="nav-link" href="<?php echo get_url('list_accounts.php'); ?>">My Accounts</a></li>
    </div>
  </div>
  <div class="container">
  <div class="row align-items-end">
    <div class="col-md-3 mx-auto m-2 bg-danger" >
    <li class="col-md-6  mx-auto m-2 bg-danger text-nowrap"  ><a class="nav-link" href="<?php echo get_url('Deposit_Withdraw.php'); ?>"> Deposit</a></li>
    </div>
 
    <div class="col-md-3 mx-auto m-2 bg-danger " >
    <li class="col-md-6  mx-auto m-2 bg-danger text-nowrap "  ><a class="nav-link" href="<?php echo get_url('Deposit_Withdraw.php'); ?>">Withdraw</a></li>
    </div>

    <div class="col-md-3 mx-auto m-2 bg-danger" >
    <li class="col-md-5  mx-auto m-2 bg-danger text-nowrap"  ><a class="nav-link" href="#">Transfer</a></li>
    </div>
</div>

</body>
</html>