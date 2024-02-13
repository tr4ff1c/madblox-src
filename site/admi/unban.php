<?php
include('include.php');
if(isset($_REQUEST["banuser"])) {
    if(
        isset($_REQUEST["id"])
    ) {
        $id = (int)$_REQUEST["id"];
        $q = $con->prepare("DELETE FROM bans WHERE userid = :id");
        $q->bindParam(':id', $id, PDO::PARAM_INT);
        $q->execute();
    }
}
?>
<center>
    <a href="/admi/"><h1>< Back</h1></a>
    <form method="POST" action>
        <h1>Unban a User</h1>
        <label>User ID</label><br>
        <input name="id" type="number" placeholder="User ID"><br>
        <input name="banuser" type="submit" value="Unban" tabindex="4" class="Button">
    </form>
</center>
<?php include('finclude.php'); ?>