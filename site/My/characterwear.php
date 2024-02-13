<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
if($loggedin !== 'yes') {
    header('location: /');
    exit;
}
  
if($_GET["id"] === 0){
    exit("I will NOT let that slide ????");
}
  
$sqlcaca = $db->prepare("SELECT * FROM catalog WHERE id=:id");
$sqlcaca->execute([':id' => $_GET['id']]);
$caca = $sqlcaca->fetch(PDO::FETCH_ASSOC);

$sqlcacad = $db->prepare("SELECT * FROM renders WHERE render_id=? AND type='user'");
$sqlcacad->execute([$_USER['id']]);
$cacad = $sqlcacad->rowCount();
if($cacad > 0){
    //exit("Please wait for ur character to render.");
}

if(!$caca) {
    exit("I will NOT let that slide ????");
}
  
if($caca['status'] === "Declined"){
    exit("I will NOT let that slide ????");
}

if($caca['status'] === "Pending"){
    exit("I will NOT let that slide ????");
}

$sqlowned = $db->prepare("SELECT * FROM owneditems WHERE itemid=:itid AND ownerid=:uid");
$sqlowned->execute([':itid' => htmlspecialchars($_GET['id']), ':uid' => $_USER['id']]);
$owned = $sqlowned->rowCount();
if($owned === 0){
	die("Bro.. You don't own that item...");
}

$id = filter_var($_GET["ID"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$sql1 = "SELECT * FROM wearing WHERE itemid = :itemid AND userid = :userid AND type = :type;";
$stmt1 = $db->prepare($sql1);
$stmt1->bindParam(':itemid', $id);
$stmt1->bindParam(':type', $caca["type"]);
$stmt1->bindParam(':userid', $_USER["id"]);
$stmt1->execute();
$resultCheck1 = $stmt1->rowCount();
  
$sql2 = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmt2 = $db->prepare($sql2);
$stmt2->bindParam(':type', $caca["type"]);
$stmt2->bindParam(':userid', $_USER["id"]);
$stmt2->execute();
$resultCheck2 = $stmt2->rowCount();
 
$sqlshirt = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmtshirt = $db->prepare($sqlshirt);
$stmtshirt->bindValue(':type', 'shirt');
$stmtshirt->bindParam(':userid', $_USER["id"]);
$stmtshirt->execute();
$shirtID = $stmtshirt->fetch();
  
$sqltshirt = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmttshirt = $db->prepare($sqltshirt);
$stmttshirt->bindValue(':type', 'tshirt');
$stmttshirt->bindParam(':userid', $_USER["id"]);
$stmttshirt->execute();
$tshirtID = $stmttshirt->fetch();
  
$sqlhat = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmthat = $db->prepare($sqlhat);
$stmthat->bindValue(':type', 'hat1');
$stmthat->bindParam(':userid', $_USER["id"]);
$stmthat->execute();
$hat1ID = $stmthat->fetch();

$sqlhat = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmthat = $db->prepare($sqlhat);
$stmthat->bindValue(':type', 'hat2');
$stmthat->bindParam(':userid', $_USER["id"]);
$stmthat->execute();
$hat2ID = $stmthat->fetch();

$sqlhat = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmthat = $db->prepare($sqlhat);
$stmthat->bindValue(':type', 'hat3');
$stmthat->bindParam(':userid', $_USER["id"]);
$stmthat->execute();
$hat3ID = $stmthat->fetch();

if($caca['type'] === "hat") {
    if ($resultCheck2 >= 3) {
        $deleteQuery4 = $db->prepare("DELETE FROM wearing WHERE userid=:id AND type=:type");
        $deleteQuery4->bindValue(':id', $_USER['id']);
        $deleteQuery4->bindValue(':type', 'hat');
        $deleteQuery4->execute();
    }
} else {
    if ($resultCheck2 > 0) {
        $deleteQuery4 = $db->prepare("DELETE FROM wearing WHERE userid=:id AND type=:type");
        $deleteQuery4->bindValue(':id', $_USER['id']);
        $deleteQuery4->bindValue(':type', $caca['type']);
        $deleteQuery4->execute();
    }
}

$sql = "INSERT IGNORE INTO `wearing` (`id`, `userid`, `itemid`, `type`) VALUES (NULL, :userid, :itemid, :type); ";
$stmt = $db->prepare($sql);
$stmt->bindParam(':userid', $_USER["id"]);
$stmt->bindParam(':itemid', $caca["id"]);
$stmt->bindParam(':type', $caca["type"]);
$stmt->execute();
header("location: ../api/render.php");

?>