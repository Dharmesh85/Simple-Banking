<?php
ob_start();
require(__DIR__ . "/../../partials/nav.php");
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page","danger");
  die(header("Location: login.php"));
}

// init db
$user = get_user_id();
$db = getDB();

// Get user accounts
$stmt = $db->prepare(
  "SELECT id, account_number, account_type, balance
  FROM Accounts
  WHERE user_id = :id AND active = 1
  ORDER BY id ASC
");
$stmt->execute([':id' => $user]);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["save"])) {
  //TODO add proper validation/checks
  $id = $_POST["account"];

  $stmt = $db->prepare('SELECT balance, account_number FROM Accounts WHERE id = :q');
  $stmt->execute([ ":q" => $id ]);
  $account = $stmt->fetch(PDO::FETCH_ASSOC);
  if($account["balance"] != 0) {
    flash("Balance has to be $0 before closing.");
    die(header("Location: close_account.php"));
  }

  $user = get_user_id();
  $stmt = $db->prepare(
    "UPDATE Accounts SET active = 0 WHERE id = :id"
  );
  $r = $stmt->execute([ ":id" => $id ]);
  if ($r) {
    flash("Account ".$account["account_number"]." successfully closed.");
    die(header("Location: list_accounts.php"));
  } else {
    flash("Error closing account!");
  }
}
ob_end_flush();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <div class="jumbotron text-center">
<h1>Close Account </h1>
  </div>
<form method="POST">
  <div class="form-group">
  <div class="mx-auto" style="width: 200px;">
    <label for="account_dest"><span style="font-size:15px">Account</span></label>
    <select class="form-control" id="account" name="account">
      <?php foreach ($accounts as $r): ?>
      <option value="<?php echo($r["id"]); ?>">
        <?php echo($r["account_number"]); ?> | 
        <?php echo($r["account_type"]); ?> | 
        <?php echo($r["balance"]); ?>
      </option>
      <?php endforeach; ?>
    </select>
    <small id="accountHelp" class="form-text text-muted">Account Balance has to be $0</small>
  </div>
  <div class="mx-auto" style="width: 150px;">
  <button type="submit" name="save" value="close" class="btn btn-primary">Close</button>
  <td><a href="transactions.php?type=withdraw"<?php echo($r["id"]); ?> class="btn btn-success">Tranfer Funds</a></td>
</form>

<?php require(__DIR__ . "/../../partials/flash.php");?>
