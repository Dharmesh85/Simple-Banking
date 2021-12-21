<?php
require(__DIR__ . "/../../partials/nav.php");
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page","danger");
  die(header("Location: login.php"));
}
?>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
<h1 class="display-4">Welcome, <?php echo(get_firstname()); ?>!</h1>
</div>
<div class="row">
  <div class="col text-center mr-1 bg-dark"><a class="nav-link" href="<?php echo get_url('create_account.php'); ?>"><h2>Create Account</h2></a></div>
  <div class="col text-center mr-1 bg-dark"><a class="nav-link" href="<?php echo get_url('list_accounts.php'); ?>"><h2>Accounts</h2></a></div>
  <div class="col text-center mr-1 bg-dark"><a class="nav-link" href="<?php echo get_url("transactions.php?type=deposit"); ?>"> <h2>Make Tansactions</h2></a></div>
</div>


<?php
require(__DIR__ . "/../../partials/flash.php");
?>