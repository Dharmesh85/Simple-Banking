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
<div class="row">
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url('Profile.php'); ?>"><h2>Profile</h2></a></div>
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url('create_account.php'); ?>"><h2>Create Accounts</h2></a></div>
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url('list_accounts.php'); ?>"> <h2>Accounts</h2></a></div>
  
</div>
<div class="row">
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url("transactions.php?type=deposit"); ?>"><h2>Deposit</h2></a></div>
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url("transactions.php?type=withdraw"); ?>"><h2>Withdraw</h2></a></div>
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url("transactions.php?type=transfer"); ?>"> <h2>Transfer</h2></a></div>
</div>

<div class="row">
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url("transfer_other_acct.php"); ?>"><h2>Transfer To Other Account</h2></a></div>
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url("close_account.php"); ?>"><h2>Close Account</h2></a></div>
  <div class="col text-center m-1 bg-dark"><a class="nav-link" href="<?php echo get_url("take_loan.php"); ?>"><h2>Loan</h2></a></div>

</div>


</body>
</html>