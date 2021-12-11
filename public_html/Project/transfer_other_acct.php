<?php
require(__DIR__ . "/../../partials/nav.php");
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page", "danger");
  die(header("Location: login.php"));
}

if (isset($_GET["type"])) {
  $type = $_GET["type"];
} else {
  $type = 'deposit';
}

// init db
$user = get_user_id();
$db = getDB();

// Get user accounts
$stmt = $db->prepare('SELECT * FROM Accounts WHERE user_id = :id ORDER BY id ASC');
$stmt->execute([':id' => $user]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["save"])) {
  $account_src = $_POST["account_src"];
  $balance = $_POST["balance"];
  $memo = $_POST["memo"];

  $last_name = $_POST["last_name"];
  $last_four = $_POST["last_four"];

  if(strlen($last_four) != 4){
    flash("Please enter last 4 digits of the destination account.", "warning");
    die(header("Location: transaction_out.php"));
  }

  $stmt = $db->prepare('SELECT Accounts.id, Users.username FROM Accounts JOIN Users ON Accounts.user_id = Users.id WHERE Users._LastName = :_LastName AND Accounts.account_number LIKE :last_four');
  $stmt->execute([
    ':_LastName' => $last_name,
    ':last_four' => "%$last_four"
  ]);
  $account_dest = $stmt->fetch(PDO::FETCH_ASSOC);

  if($account_src == $account_dest) {
    flash("Cannot transfer to the same user!", "Warning");
    die(header("Location: transaction_out.php"));
  }
  $stmt = $db->prepare('SELECT balance FROM Accounts WHERE id = :id');
  $stmt->execute([':id' => $account_src]);
  $acct = $stmt->fetch(PDO::FETCH_ASSOC);
  if($acct["balance"] < $balance) {
    flash("Not enough funds to transfer!");
    die(header("Location: transactions.php?type=transfer"));
  }
  $r = changeBalance($db, $account_src, $account_dest, 'ext-transfer', $balance, $memo);
  
  if ($r) {
    flash("Successfully executed transaction.", "success");
  } else {
    flash("Error doing transaction!", "danger");
  }
}

?>
<head>
  <title>Transfer Accounts</title>
  <meta name="viewport" content="width=device-width, initial-scale=3">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<div class="jumbotron text-center">
  <h1> Transfer Out </h1>
</div>

<form method="POST">
  <?php if (count($results) > 0): ?>
    <div class="container-fluid text-center ">
    <div class="mx-auto" style="width:325px;">
  <label class="form-label" for="account">Account Source</label>
    <select class="form-control" id="account" name="account_src">
      <?php foreach ($results as $r): ?>
      <option value="<?php echo($r["id"]); ?>">
        <?php echo($r["account_number"]); ?> |
         <?php echo($r["account_type"]); ?> | 
         <?php echo($r["balance"]); ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php endif; ?>
  <div class="row">
  <div class="container-fluid text-center ">
    <div class="mx-auto" style="width:325px;">
      <div class="form-lable">
        <label for="last_name">Destination User Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" maxlength="60" required placeholder="Last Name">
      </div>
    </div>
    <div class="container-fluid text-center ">
    <div class="mx-auto" style="width:325px;">
      <div class="form-lable">
        <label for="last_four">Destination User Last 4 Digits</label>
        <input type="number" class="form-control" id="last_four" name="last_four" min="0" max="9999" required placeholder="XXXX">
      </div>
    </div>
  </div>
  <div class="container-fluid text-center ">
    <div class="mx-auto" style="width:325px;">
      <div class="form-lable">
    <label for="deposit">Amount</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="number" class="form-control" id="deposit" min="0.00" name="balance" step="0.01" placeholder="0.00"/>
    </div>
  </div>
  <div class="container-fluid text-center ">
    <div class="mx-auto" style="width:300px;">
      <div class="form-lable">
    <label for="memo">Memo</label>
    <textarea class="form-control" id="memo" name="memo" maxlength="250"></textarea>
  </div>
  
  <button type="submit" name="save" value="Enter" class="btn btn-success">Enter</button>
</form>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>