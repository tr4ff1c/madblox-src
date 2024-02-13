<?php

require("../../core/database.php");

if($_POST['bodyP'] == "head"){

    $color = (int)htmlspecialchars($_POST['color']);

    $stmt = $db->prepare("UPDATE users SET headcolor = :color WHERE id = :user_id");

    $stmt->bindParam(':color', $color, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("ERR: " . $e->getMessage());
    }

}

if($_POST['bodyP'] == "torso"){

    $color = (int)htmlspecialchars($_POST['color']);

    $stmt = $db->prepare("UPDATE users SET torsocolor = :color WHERE id = :user_id");

    $stmt->bindParam(':color', $color, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("ERR: " . $e->getMessage());
    }

}

if($_POST['bodyP'] == "leftarm"){

    $color = (int)htmlspecialchars($_POST['color']);

    $stmt = $db->prepare("UPDATE users SET leftarmcolor = :color WHERE id = :user_id");

    $stmt->bindParam(':color', $color, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("ERR: " . $e->getMessage());
    }

}

if($_POST['bodyP'] == "rightarm"){

    $color = (int)htmlspecialchars($_POST['color']);

    $stmt = $db->prepare("UPDATE users SET rightarmcolor = :color WHERE id = :user_id");

    $stmt->bindParam(':color', $color, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("ERR: " . $e->getMessage());
    }

}

if($_POST['bodyP'] == "leftleg"){

    $color = (int)htmlspecialchars($_POST['color']);

    $stmt = $db->prepare("UPDATE users SET leftlegcolor = :color WHERE id = :user_id");

    $stmt->bindParam(':color', $color, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("ERR: " . $e->getMessage());
    }

}

if ($_POST['bodyP'] == "rightleg") {
    $color = (int)htmlspecialchars($_POST['color']);

    $stmt = $db->prepare("UPDATE users SET rightlegcolor = :color WHERE id = :user_id");

    $stmt->bindParam(':color', $color, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("ERR: " . $e->getMessage());
    }
}


//if (isset($_SERVER["HTTP_REFERER"])) {
//        header("Location: " . $_SERVER["HTTP_REFERER"]);
//}

header("Location: /api/render.php?id=".$_USER['id']); die(); exit;