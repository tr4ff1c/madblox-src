<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php");
$message = "";
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(
        isset($_REQUEST["oldPass"]) &&
        isset($_REQUEST["newPass"]) &&
        isset($_REQUEST["newPassConfirm"])
    ) {
        $old = $_REQUEST["oldPass"];
        $new = $_REQUEST["newPass"];
        $newConfirm = $_REQUEST["newPassConfirm"];
        if($newConfirm === $new) {
            if(password_verify($old, $_USER["password"])) {
                $hashPass = password_hash($new, PASSWORD_BCRYPT, [ "cost" => 12 ]);
                $q = $db->prepare("UPDATE users SET password = :newPass WHERE id = :id");
                $q->bindParam(":newPass", $hashPass, PDO::PARAM_STR);
                $q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
                $q->execute();
                $message = "Changed password successfully";
            } else {
                $message = "Old password is not correct";
            }
        } else {
            $message = "Confirm new password is not correct";
        }
    }
}
?>
<h2>Change account password</h2>
<form method="post" action>
    <p><?php echo htmlspecialchars($message); ?></p>
    <input name="oldPass" type="password" placeholder="Old password"><br>
    <input name="newPass" type="password" placeholder="New password"><br>
    <input name="newPassConfirm" type="password" placeholder="Confirm new password"><br>
    <button type="submit">Change</button>
</form>