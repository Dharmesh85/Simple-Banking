<?php require(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../lib/functions.php");
?>
<?php
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You must be logged in to access this page");
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
      "UPDATE Users set email = :email, username = :username, _FirstName = :_FirstName, _LastName = :_LastName where id = :id"
    );
    $r = $stmt->execute([
      ":email" => $newEmail,
      ":username" => $newUsername,
      ":id" => get_user_id(),
      ":_FirstName" => $_POST["FirstName"],
      ":_LastName" => $_POST["LastName"]
    ]);
    if ($r) {
      flash("Updated profile");
    } else {
      flash("Error updating profile");
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
          flash("Reset Password.");
        } else {
          flash("Error resetting password!");
        }
      }
    }
    //fetch/select fresh data in case anything changed
    $stmt = $db->prepare(
      "SELECT email, username, _FirstName, _LastName from Users WHERE id = :id LIMIT 1"
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
    }
  } else {
    //else for $isValid, though don't need to put anything here since the specific failure will output the message
  }
}
?>

<h3 class="text-center mt-4">Profile</h3>

<form method="POST">
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" class="form-control" id="email" name="email" maxlength="100" required value="<?php echo(get_user_email()); ?>">
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" maxlength="60" required value="<?php echo(get_username()); ?>">
  </div>
  <div class="row">
    <div class="col-sm">
      <div class="form-group">
        <label for="_FirstName">First Name</label>
        <input type="text" class="form-control" id="_FirstName" name="_FirstName" maxlength="60" required value="<?php echo(get_firstname()); ?>">
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <label for="_LastName">Last Name</label>
        <input type="text" class="form-control" id="_LastName" name="_LastName" maxlength="60" required value="<?php echo(get_lastname()); ?>">
      </div>
    </div>
  </div>

  <hr>
  <h4 class="text-center">Change Password</h4>

  <!-- DO NOT PRELOAD PASSWORD-->
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" maxlength="60">
  </div>
  <div class="form-group">
    <label for="confirm">Confirm Password</label>
    <input type="password" class="form-control" id="confirm" name="confirm" maxlength="60">
  </div>
  <button type="submit" name="saved" value="Save Profile" class="btn btn-primary">Save Profile</button>
</form>

<?php require(__DIR__ . "/../../partials/flash.php");
