<?php 
require(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../lib/functions.php");
?>
<?php
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You must be logged in to access this page","danger");
  die(header("Location: login.php"));
}

$db = getDB();
//save data if we submitted the form
if (isset($_POST["saved"])) {
  $isValid = true;
  //check if our email changed
  $newEmail = get_user_email();
  if (get_user_email() != $_POST["email"]) {
    //TODO we'll need to check if the email is available
    $email = $_POST["email"];
    $stmt = $db->prepare(
      "SELECT COUNT(1) as InUse from Users where email = :email"
    );
    $stmt->execute([":email" => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $inUse = 1; //default it to a failure scenario
    if ($result && isset($result["InUse"])) {
      try {
        $inUse = intval($result["InUse"]);
      } catch (Exception $e) {
      }
    }
    if ($inUse > 0) {
      flash("Email already in use");
      //for now we can just stop the rest of the update
      $isValid = false;
    } else {
      $newEmail = $email;
    }
  }
  $newUsername = get_username();
  if (get_username() != $_POST["username"]) {
    $username = $_POST["username"];
    $stmt = $db->prepare(
      "SELECT COUNT(1) as InUse from Users where username = :username"
    );
    $stmt->execute([":username" => $username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $inUse = 1; //default it to a failure scenario
    if ($result && isset($result["InUse"])) {
      try {
        $inUse = intval($result["InUse"]);
      } catch (Exception $e) {
      }
    }
    if ($inUse > 0) {
      flash("Username already in use!");
      //for now we can just stop the rest of the update
      $isValid = false;
    } else {
      $newUsername = $username;
    }
  }
  if ($isValid) {
    $stmt = $db->prepare(
      "UPDATE Users set email = :email, username = :username, _FirstName = :_FirstName, _LastName = :_LastName, privacy = :privacy where id = :id"
    );
    $r = $stmt->execute([
      ":email" => $newEmail,
      ":username" => $newUsername,
      ":id" => get_user_id(),
      ":_FirstName" => $_POST["_FirstName"],
      ":_LastName" => $_POST["_LastName"],
      ":privacy" => $_POST["privacy"]
    ]);
    if ($r) {
      flash("Updated profile", "success");
    } else {
      flash("Error updating profile", "danger");
    }
    //password is optional, so check if it's even set
    //if so, then check if it's a valid reset request
    if (!empty($_POST["password"]) && !empty($_POST["confirm"])) {
      if ($_POST["password"] == $_POST["confirm"]) {
        $password = $_POST["password"];
        $hash = password_hash($password, PASSWORD_BCRYPT);
        //this one we'll do separate
        $stmt = $db->prepare(
          "UPDATE Users set password = :password where id = :id"
        );
        $r = $stmt->execute([":id" => get_user_id(), ":password" => $hash]);
        if ($r) {
          flash("Reset Password.", "success");
        } else {
          flash("Error resetting password!", "danger");
        }
      }
    }
    //fetch/select fresh data in case anything changed
    $stmt = $db->prepare(
      "SELECT email, username, _FirstName, _LastName, privacy from Users WHERE id = :id LIMIT 1"
    );
    $stmt->execute([":id" => get_user_id()]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $email = $result["email"];
      $username = $result["username"];
      $firstname = $result["_FirstName"];
      $lastname = $result["_LastName"];
      
      //let's update our session too
      $_SESSION["user"]["email"] = $email;
      $_SESSION["user"]["username"] = $username;
      $_SESSION["user"]["_FirstName"] = $firstname;
      $_SESSION["user"]["_LastName"] = $lastname;
      $_SESSION["user"]["privacy"] = $result["privacy"];
    }
  } else {
    //else for $isValid, though don't need to put anything here since the specific failure will output the message
  }
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<head>
  <title>Profile</title>

  
</head>

<div class="jumbotron text-center">
<h1>Profile</h1>
</div>
<form method="POST">
<div class="mx-auto" style="width: 200px;">
   <label class="form-label" for="email"><span style="font-size:15px">Email</span> </label>
    <input type="email" class="form-control" id="email" name="email" maxlength="100" required value="<?php echo(get_user_email()); ?>">
  </div>
  <div class="mx-auto" style="width: 200px;">
   <label class="form-label" for="username"><span style="font-size:15px"> Username</span></label>
    <input type="text" class="form-control" id="username" name="username" maxlength="60" required value="<?php echo(get_username()); ?>">
  </div>
  <div class="mx-auto" style="width: 200px;">
       <label class="form-label" for="_FirstName"><span style="font-size:15px">Last Name</span></label>
        <input type="text" class="form-control" id="_FirstName" name="_FirstName" maxlength="60" required value="<?php echo(get_firstname()); ?>">
      </div>
    </div>
    <div class="row">
    <div class="mx-auto" style="width: 200px;">
       <label class="form-label" for="_LastName"><span style="font-size:15px"> Last Name</span></label>
        <input type="text" class="form-control" id="_LastName" name="_LastName" maxlength="60" required value="<?php echo(get_lastname()); ?>">
      </div>
    </div>
  </div>
  <div class="form-group">
  <div class ="mx-auto" style="width: 200px;">
    <label for="privacy"><span style="font-size:15px">Privacy</span></label>
    <select class="form-control" id="privacy" name="privacy">
      <option value="private" <?php echo get_privacy() == "private" ? "selected": ""; ?>>Private</option>
      <option value="public" <?php echo get_privacy() == "public" ? "selected": ""; ?>>Public</option>
	  </select>
    <small class="form-text text-muted">Allow other users to see your profile.</small>
  </div>

  <hr>
  <div class="h1 text-center  text-dark">Change Password</div>


  <!-- DO NOT PRELOAD PASSWORD-->
  <div class="mx-auto" style="width: 200px;">
   <label class="form-label" for="password"><span style="font-size:15px">Password</span></label>
    <input type="password" class="form-control" id="password" name="password" maxlength="60">
  </div>
  <div class="mx-auto" style="width: 200px;">
   <label class="form-label" for="confirm"><span style="font-size:15px">Confirm Password</span></label>
    <input type="password" class="form-control" id="confirm" name="confirm" maxlength="60">
  </div>
  <div class="mx-auto" style="width: 100px;">
  <button type="submit" name="saved" value="Save Profile" class="btn btn-primary"><span style="font-size:15px">Update Profile</span></button>
</form>

<?php require(__DIR__ . "/../../partials/flash.php");
?>
