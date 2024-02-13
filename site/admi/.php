<?php require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php'); 


// Anti-Skid Spray from 608
// ok bro wtf -dude

if ($_USER['USER_PERMISSIONS'] !== "Administrator") {
    
    $sql = "INSERT INTO skids (user_id, action, log_timestamp) VALUES (:user_id, :action, NOW())";

    $user_id = $_USER['id'];
    $action = "admin";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':action', $action, PDO::PARAM_STR);

    $stmt->execute();
    
    header("Location: /");
    exit; // needs to exit page lmfao
}


?>
<style>
    #Item {
        font-family: Verdana, Sans-Serif;
        padding: 10px;
    }

    #ItemContainer {
        background-color: #eee;
        border: solid 1px #555;
        color: #555;
        margin: 0 auto;
        width: 620px;
    }

    #Actions {
        background-color: #fff;
        border-bottom: dashed 1px #555;
        border-left: dashed 1px #555;
        border-right: dashed 1px #555;
        clear: left;
        float: left;
        padding: 5px;
        text-align: center;
        min-width: 0;
        position: relative;
    }

    .PlayGames {
        background-color: #ccc;
        border: dashed 1px Green;
        color: Green;
        float: right;
        margin-top: 10px;
        padding: 10px 5px;
        text-align: right;
        width: 325px;
    }
</style>
<br>
<div id="ItemContainer">
    <h2>Admin Panel</h2>
    <div id="Item">
        
<center>

<h3>Content</h3>
<a href="items.aspx">Accept Items (N/A)</a>
<br>
<a href="reports.aspx">Manage Reports (N/A)</a>

<br>
<br>

<h3>Users</h3>
<a href="alts.aspx">Find Alts</a>
<br>
<a href="ban.aspx">Moderate User</a>
<br>
<a href="unban.aspx">Unmoderate User</a>

<br>
<br>

<h3>Site</h3>
<a href="alerts.aspx">Manage Alerts</a>
<br>
<a href="maintenance.aspx">Manage Maintenance</a>
<br>
<?php
$sql = "SELECT COUNT(*) AS unresolved_count FROM skids WHERE resolved = 'no'";

    $stmt = $db->query($sql);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<a href="security.aspx">Manage Security Issues (<?=number_format($result['unresolved_count']);?>)</a>


</center>

        </div>

    </div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/core/footer.php'); ?>