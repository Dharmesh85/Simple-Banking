<?php 
require_once(__DIR__ . "/../../partials/nav.php");
?>
<?php
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page");
  die(header("Location: login.php"));
}

$db = getDB();
$user = get_user_id();
$stmt = $db->prepare(
  "SELECT Accounts.id, account_number, account_type, balance, last_updated FROM Accounts JOIN Users ON Accounts.user_id = Users.id WHERE Users.id = :q ORDER BY Accounts.id"
);
$r = $stmt->execute([":q" => $user]);
if ($r) {
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  $results = [];
  flash("There was a problem fetching the results");
}
?>
<meta name="viewport" content="width=device-width, initial-scale=3">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>

<body>
    

<div class="jumbotron text-center">
  <h1> Accounts </h1>
</div>

    <?php if (count($results) > 0): ?>
        <div class="list-group">
            <?php foreach ($results as $r): ?>
                <div class="list-group-item">
                    <div>
                        <div><strong><h3>Account Number:</h3></strong></div>
                        <div><?php echo($r["account_number"]); ?></div>
                    </div>
                    <div>
                        <div><strong><h3>Account Type:</h3></strong></div>
                        <div><?php echo($r["account_type"]); ?></div>
                    </div>
                    <div>
                        <div><strong><h3>Balance:</h3></strong></div>
                        <div><?php echo($r["balance"]); ?></div>
                    </div>
                    <div>
                        
                    <td><a href="view_transactions.php?id=<?php echo($r["id"]); ?>" class="btn btn-success">Transactions</a></td>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
      <p>You don't have any accounts.</p>
      <a href="create_account.php?id=<?php echo($r["id"]); ?>" class="btn btn-success">Create Account</a>

    <?php endif; ?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>