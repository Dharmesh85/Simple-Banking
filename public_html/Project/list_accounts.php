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
    <h3 class="text-center mt-4 mb-4">Accounts</h3>

    <?php if (count($results) > 0): ?>
        <div class="list-group">
            <?php foreach ($results as $r): ?>
                <div class="list-group-item">
                    <div>
                        <div><strong>Account Number:</strong></div>
                        <div><?php echo($r["account_number"]); ?></div>
                    </div>
                    <div>
                        <div><strong>Account Type:</strong></div>
                        <div><?php echo($r["account_type"]); ?></div>
                    </div>
                    <div>
                        <div><strong>Balance:</strong></div>
                        <div><?php echo($r["balance"]); ?></div>
                    </div>
                    <div>
                        
                        <a type="button" href="<?php echo get_url("view_transactions.php?id=" . $r["AccID"]); ?>">View Transaction History</a>
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