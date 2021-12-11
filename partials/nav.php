<?php
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = false; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "/Project",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();
require_once(__DIR__ . "/../lib/functions.php");

?>

<!-- include css and js files -->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header ">
    
                <?php if (is_logged_in()) : ?>
                    <li class="navbar-brand"><a class="nav-link" href="<?php echo get_url('home.php'); ?>"><h2>Home</h2></a></li>
                    <li class="navbar-brand"><a class="nav-link" href="<?php echo get_url('dashboard.php'); ?>"><h2>Dashboard</h2></a></li>
                    <li class="navbar-brand"><a class="nav-link" href="<?php echo get_url('profile.php'); ?>"><h2>Profile</h2></a></li>
                    <li class="navbar-brand"><a class="nav-link" href="<?php echo get_url('logout.php'); ?>"><h2>Logout</h2></a></li>
                    
                <?php endif; ?>
                <?php if (!is_logged_in()) : ?>
                    <li class="navbar-brand "><a class="nav-link" href="<?php echo get_url('login.php'); ?>"><h2>Login</h2></a></li>
                    <li class="navbar-brand"><a class="nav-link" href="<?php echo get_url('register.php'); ?>"><h2>Register</h2></a></li>
                <?php endif; ?>
                <?php if (has_role("Admin")) : ?>
                    <li class="nav-item dropdown" class="navbar-brand">
                        <li><a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin Roles</a></li>
                        <ul class="dropdown-menu bg-warning" aria-labelledby="rolesDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/create_role.php'); ?>">Create</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_roles.php'); ?>">List</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign</a></li>
                            <li><a class="dropdown-item"><a href="<?php echo get_url('create_account.php'); ?>">Account</a></li>
                
    
                    </li>

                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>