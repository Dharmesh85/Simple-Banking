<?php require(__DIR__ . "/../../partials/nav.php");

is_logged_in(true);
?>
<head>

<?php 

if(isset($_POST["save"])){
    $account_number = $_POST["account_number"];
    $account_type = $_POST["account_type"]; 
    $user= get_user_id();
    $balance = $_POST["balance"];
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Accounts (account_number, account_type, user_id, balance) VALUES(:account_number, :account_type, :user, :balance)");
    $r = $stmt->execute([
        ":account_number" => $account_number,
        ":account_type"=> $account_type,
        ":user" => $user,
        ":balance" => $balance
    ]);

    if($r){
      flash("Created successfully with id: " . $db->lastInsertId(),"success");
    }
    else{
      $e = $stmt->errorInfo();
      flash("Error creating: " . var_export($e, true), "danger");
    }

}
?> 
 <title>Create Your Account</title>
</head>

<h1 style="text-align:Center"font:size 18px >Create Account</h1>
<ul class="nav navbar-brand mx-auto m-2 bg-danger mt-4 mb-4 ">
<form method="POST" onsubmit="return validate(this)">
  <label> Account Number </label>
  <input type="number" name="account_number" value="<?php echo $result["account_number"];?>" />
  <label>Account Type</label>
  <select name="account_type">
    <option value = "checking">Checking</option>
    <option value = "world">world</option>
  </select>
  <label>Balance</label>
  <input type="number" min="5.00" name="balance" value="<?php echo $result["balance"];?>" />
	<input type="submit" name="save" value="Create"/>
</form>


<?php require(__DIR__ . "/../../partials/flash.php");
