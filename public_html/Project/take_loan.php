<?php
require(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../lib/functions.php");
?>

<?php

if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page");
  die(header("Location: login.php"));
}

// init db
$user = get_user_id();
$db = getDB();

// Get user accounts
$stmt = $db->prepare("SELECT * FROM Accounts WHERE user_id = :id AND account_type NOT LIKE 'loan' ORDER BY id ASC");
$stmt->execute([':id' => $user]);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["save"])) {
  $check = $db->prepare('SELECT account_number FROM Accounts WHERE account_number = :q');
  do {
    $account_number = get_random_str(12);
    $check->execute([':q' => $account_number]);
  } while ( $check->rowCount() > 0 );

  //TODO add proper validation/checks
  $account_dest = $_POST["account_dest"];
  $apy = $_POST["apy"];

  $balance = $_POST["balance"];
  if($balance < 500) {
    die(flash("Minimum balance not entered."));
  }

  $user = get_user_id();
  $stmt = $db->prepare(
    "INSERT INTO Accounts (account_number, user_id, account_type, balance, APY) VALUES (:account_number, :user, :account_type, :balance, :apy)"
  );
  $r = $stmt->execute([
    ":account_number" => $account_number,
    ":user" => $user,
    ":account_type" => 'loan',
    ":balance" => -($balance * ($apy/100)), // Set inital balance as interest
    ":apy" => $apy
  ]);
  if ($r) {
    changeBalance($db, $db->lastInsertId(), $account_dest, 'deposit', $balance, 'New account deposit');
    flash("Account created successfully with Number: " . $account_number);
    die(header("Location: list_accounts.php"));
  } else {
    flash("Error creating account!");
  }
}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<head>
  <title>Loan</title>

  
</head>
<div class="jumbotron text-center">
<h1>Take a Loan</h1>
</div>
<form method="POST">
  <div class="form-group">
  <div class="mx-auto" style="width: 200px;">
    <label for="deposit"><span style="font-size:15px">Loan Principal</span></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="number" class="form-control" id="deposit" min="500.00" name="balance" step="0.01" placeholder="500.00" aria-describedby="depositHelp"/>
    </div>
    <small id="depositHelp" class="form-text text-muted">Minimum $500 required.</small>
  </div>
  <div class="form-group">
  <div class="mx-auto" style="width: 200px;">
    <label for="account_dest"><span style="font-size:15px">Deposit to Account</span> </label>
    <select class="form-control" id="account_dest" name="account_dest">
      <?php foreach ($accounts as $r): ?>
      <option value="<?php echo($r["id"]); ?>">
        <?php echo($r["account_number"]); ?> | 
        <?php echo($r["account_type"]); ?> | 
        <?php echo($r["balance"]); ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
  <div class="mx-auto" style="width: 200px;">
    <label for="apy"><span style="font-size:15px">APY</span></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">%</span>
      </div>
      <input type="number" class="form-control" id="apy" min="2.00" name="apy" step="0.0001" placeholder="5.00" aria-describedby="depositHelp"/>
    </div>
    <small id="apyHelp" class="form-text text-muted">Minimum 2% APY.</small>
  </div>
  <div class="mx-auto" style="width: 50px;">
  <button type="submit" name="save" value="create" class="btn btn-primary">Create</button>
</form>


<?php 
require(__DIR__ . "/../../partials/flash.php");?>