<?php
include $_SERVER["DOCUMENT_ROOT"] . '/core/database.php';

try {
    $db->beginTransaction();

    $id = (int)$_GET["id"] ?? 0;

    $sql = "SELECT * FROM catalog WHERE id = :id AND status = 'Accepted' AND offsale = 0";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        die("Invalid item or item not for sale");
    }

    $sql = "SELECT * FROM owneditems WHERE itemid = :itemid AND ownerid = :ownerid";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':itemid', $id, PDO::PARAM_INT);
    $stmt->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
    $stmt->execute();
    $owneditems = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($owneditems) {
        header('location: /Item.aspx?id=' . $id);
        exit();
    }

    $sql = "SELECT * FROM users WHERE id = :id;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $item['creatorid'], PDO::PARAM_INT);
    $stmt->execute();
    $creator = $stmt->fetch(PDO::FETCH_ASSOC);

    $currency = ($item['buywith'] == 'tix') ? 'tix' : 'robux';

    $price = (int)$item['price'] ?? 0;
    $buyerColumn = ($currency == 'tix') ? 'tickets' : 'mlgbux';
    $sellerColumn = ($currency == 'tix') ? 'tickets' : 'mlgbux';

    if ($_USER[$buyerColumn] >= $price) {
        $buyerAfterPurchase = $_USER[$buyerColumn] - $price;
        $sellerAfterPurchase = $creator[$sellerColumn] + $item['price'];

        // Update currency for buyer
        $sql = "UPDATE users SET $buyerColumn = :buyerAfterPurchase WHERE id = :buyerId";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':buyerAfterPurchase', $buyerAfterPurchase, PDO::PARAM_INT);
        $stmt->bindValue(':buyerId', $_USER['id'], PDO::PARAM_INT);
        $stmt->execute();

        // Update currency for seller
        if ($item['creatorid'] !== $_USER['id']) {
            $sql = "UPDATE users SET $sellerColumn = :sellerAfterPurchase WHERE id = :sellerId";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':sellerAfterPurchase', $sellerAfterPurchase, PDO::PARAM_INT);
            $stmt->bindValue(':sellerId', $item['creatorid'], PDO::PARAM_INT);
            $stmt->execute();
        }

        // Insert into owned_items
        $sql = "INSERT INTO owneditems (itemid, ownerid, type) VALUES (:itemid, :ownerid, :type)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':itemid', $id, PDO::PARAM_INT);
        $stmt->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
        $stmt->bindValue(':type', $item['type'], PDO::PARAM_STR);
        $stmt->execute();

        $db->commit();
        header('location: /Item.aspx?id=' . $id);
        exit();
    } else {
        die('<h1>You don\'t have enough ' . strtoupper($currency) . '!</h1>');
    }
} catch (PDOException $e) {
    $db->rollBack();
    die('Error: ' . $e->getMessage());
}
?>
