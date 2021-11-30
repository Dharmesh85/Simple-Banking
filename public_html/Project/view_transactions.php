<?php require(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../lib/functions.php");

 ?>
<?php
if (isset($_GET["id"])) {
    $tranID = $_GET["id"];
}
?>

<?php
$result = [];
if (isset($tranID)) {
    $db = getDB();
    $user = get_user_id();
    $stmt = $db->prepare("SELECT Transactions.id as tranID, act_src_id, act_dest_id, amount, action_type FROM Transactions WHERE Transactions.id = :q");
    $r = $stmt->execute([":q" => $tranID]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $e = $stmt->errorInfo();
        flash($e[2]);
    }
    
}
?>


<h3>View Transaction</h3>
<?php if (isset($result) && !empty($result)): ?>
    <div class="card">
        <div class="card-title">
        </div>
        <div class="card-body">
            <div>
                <p><b>Information</b></p> <!-- match with SELECT ^^^^^^ -->
                <div>Amount:<?php echo($result["amount"]); ?></div>
                <div>Action: Type <?php echo($result["action_type"]); ?> </div>
                <div>Tran ID: <?php echo($result["tranID"]); ?> </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>Error </p>
<?php endif; ?>
<?php require(__DIR__ . "/../../partials/flash.php");
