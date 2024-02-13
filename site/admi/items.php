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


if (isset($_GET['accept'])) {
    try {
        $id = (int)$_GET['accept'];

        $query = "UPDATE catalog SET status = 'Accepted' WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $searchforowner = $db->prepare("SELECT * FROM catalog WHERE id=:id");
        $searchforowner->execute([$id]);
        $item = $searchforowner->fetch(PDO::FETCH_ASSOC);

        $query2 = "INSERT INTO owneditems (id, ownerid, itemid, type) VALUES (NULL, ?, ?, ?)";
        $statement2 = $db->prepare($query2);
        $statement2->execute([$item['creatorid'], $id, $item['type']]);

        header("Location: /api/RenderItems?id=".$id);

    } catch (PDOException $e) {
        // echo "Error: " . $e->getMessage();
    }
} elseif (isset($_GET['deny'])) {
    try {
        $id = $_GET['deny'];

        $query = "UPDATE catalog SET status = 'Declined' WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
    <h2>Accept Items</h2>
    <div id="Item">
        
<center>

<?php

$recordsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

try {
    $query = "SELECT * FROM catalog WHERE status = 'Pending' LIMIT :offset, :recordsPerPage";
    $statement = $db->prepare($query);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        foreach ($result as $row) {
?>
Name: <?=htmlspecialchars($row['name']);?>
<br>
Price: <?=number_format($row['price']);?> <?=ucfirst($row['buywith']);?>
<br>
<img src="<?=$row['filename'];?>" style="border: 1px solid black; height: 80px; width: 80px;">
<br>
<a href="?accept=<?=$row['id'];?>" style="color: green;">Accept</a> <a href="?deny=<?=$row['id'];?>" style="color: red;">Deny</a>
<br>
<br>
<?php
        }
    } else {
        echo "Nothing new to accept or deny!";
    }

    // Pagination links
    $query = "SELECT COUNT(*) as total FROM catalog WHERE status = 'Pending'";
    $totalRecords = $db->query($query)->fetchColumn();
    $totalPages = ceil($totalRecords / $recordsPerPage);

    echo "<br><br>Pages: ";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i'>$i</a> ";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


</center>

        </div>

    </div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/core/footer.php'); ?>