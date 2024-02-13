<?php
include('include.php');
if(isset($_REQUEST["banuser"])) {
    if(
        isset($_REQUEST["id"]) &&
        isset($_REQUEST["reason"]) &&
        isset($_REQUEST["type"]) &&
        isset($_REQUEST["unbantime"])
    ) {
        $id = (int)$_REQUEST["id"];
        $reason = $_REQUEST["reason"];
        $type = $_REQUEST["type"];
        $unban = (int)$_REQUEST["unbantime"];
        if(in_array($type, [
            "reminder",
            "warning",
            "1day",
            "3days",
            "7days",
            "14days",
            "deleted"
        ])) {
            $q = $con->prepare("DELETE FROM bans WHERE userid = :id");
            $q->bindParam(':id', $id, PDO::PARAM_INT);
            $q->execute();
            
            $q = $con->prepare("INSERT INTO bans (id, userid, reason, unbantime, typeBan) VALUES (NULL, :id, :reason, :unbantime, :bantype)");
            $q->bindParam(':id', $id, PDO::PARAM_INT);
            $q->bindParam(':reason', $reason, PDO::PARAM_STR);
            $q->bindParam(':unbantime', $unban, PDO::PARAM_INT);
            $q->bindParam(':bantype', $type, PDO::PARAM_STR);
            $q->execute();
        }
    }
}
?>
<center>
    <a href="/admi/"><h1>< Back</h1></a>
    <form method="POST" action>
        <h1>Ban a User</h1>
        <label>User ID</label><br>
        <input name="id" type="number" placeholder="User ID"><br>
        <label>Reason</label><br>
        <input name="reason" type="text" placeholder="Reason of the ban"><br>
        <label>Ban Type</label><br>
        <input type="radio" name="type" value="reminder" checked><label>Reminder</label><br>
        <input type="radio" name="type" value="warning"><label>Warning</label><br>
        <input type="radio" name="type" value="1day"><label>1day ban</label><br>
        <input type="radio" name="type" value="3days"><label>3days ban</label><br>
        <input type="radio" name="type" value="7days"><label>7days ban</label><br>
        <input type="radio" name="type" value="14days"><label>14days ban</label><br>
        <input type="radio" name="type" value="deleted"><label>Deleted</label><br>
        <label>Unban Time (Unix Timestamps)</label><br>
        <input name="unbantime" type="number" placeholder="Unban Time (UNIX Timestamps)" value="0"><br>
        <input name="banuser" type="submit" value="Ban-hammer!" tabindex="4" class="Button">
    </form>
</center>
<?php include('finclude.php'); ?>