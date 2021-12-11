<?php
require(__DIR__ . "/../../partials/nav.php");
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
  <h1> Bank of IT-202 </h1>
</div>



<?php

if (is_logged_in(true)) {
    echo '<div style="font-size:2.25em;color:black"> Welcome home, </div>' . get_firstname();
    //comment this out if you don't want to see the session variables
    //echo "<pre>" . var_export($_SESSION, true) . "</pre>";
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>