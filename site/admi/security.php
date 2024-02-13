<?php require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php'); 


// Anti-Skid Spray from 608

if ($_USER['USER_PERMISSIONS'] !== "Administrator") {
    
    $sql = "INSERT INTO skids (user_id, action, log_timestamp) VALUES (:user_id, :action, NOW())";

    $user_id = $_USER['id'];
    $action = "admin";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':action', $action, PDO::PARAM_STR);

    $stmt->execute();
    
    header("Location: /");
    exit; // the exit is very important, some browsers can ignore redirects
}


try {
    if (isset($_GET['resolve'])) {
        $skidId = filter_var($_GET['resolve'], FILTER_SANITIZE_NUMBER_INT);

        $sql = "UPDATE skids SET resolved = 'yes' WHERE id = :skid_id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':skid_id', $skidId, PDO::PARAM_INT);
        $stmt->execute();

    }
} catch (PDOException $e) {
    // Handle PDO exceptions if any
    echo "Error: " . $e->getMessage();
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
    <h2>Security Issues</h2>
    <div id="Item">
        
<center>

<?php

try {
    $entriesPerPage = 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $offset = ($currentPage - 1) * $entriesPerPage;

    $sql = "SELECT * FROM skids WHERE resolved = 'no' ORDER BY id DESC LIMIT :limit OFFSET :offset";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', $entriesPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() === 0) {
        echo "<h3>No unresolved security issues, good job!</h3>";
    }

    foreach ($entries as $entry) {



// edit reasons here lo
$actionReasonMap = [
    "admin" => "tried to visit an admin page",
];

$defaultReason = "tried to do something, but we cannot figure out (please report this error to 608)";

$action = $entry['action'];

$reason = isset($actionReasonMap[$action]) ? $actionReasonMap[$action] : $defaultReason;


$userId = $entry['user_id'];

    $sql = "SELECT * FROM users WHERE id = :user_id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $who = $user['username'];
    } else {
        $who = "Not Found";
    }


        echo "<a href='?resolve={$entry['id']}'>User #{$entry['user_id']} ({$who}) {$reason} [CLICK TO RESOLVE]</a><br>";
    }

    $totalEntries = $db->query("SELECT COUNT(*) FROM skids WHERE resolved = 'no'")->fetchColumn();
    $totalPages = ceil($totalEntries / $entriesPerPage);

    echo "<div class='pagination'>Pages: ";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i'>$i</a> ";
    }
    echo "</div>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

</center>

        </div>

    </div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/core/footer.php'); ?>