<?php
include $_SERVER["DOCUMENT_ROOT"] . '/core/database.php';

$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

if ($loggedin !== 'yes') {
    header('location: /Login/Default.aspx');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $content = htmlspecialchars($_POST["content"]);
    
    $stmt = $db->prepare("INSERT IGNORE INTO comments (id, userid, assetid, content, time_posted) VALUES (NULL, :userid, :assetid, :content, :time_posted)");
    $stmt->bindParam(':userid', $_USER['id'], PDO::PARAM_INT);
    $stmt->bindParam(':assetid', $id, PDO::PARAM_INT);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':time_posted', time(), PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: /Item.aspx?id=$id");
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
    exit;
}

echo "<script>document.location = \"Item.aspx?id=$id\"</script>";

exit;
?>