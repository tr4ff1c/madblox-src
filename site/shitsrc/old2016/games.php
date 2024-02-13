<?php
require_once("nav.php");

if ($loggedin !== "yes") {
    header("Location: /");
    exit;
}

$gameq = $db->prepare("SELECT * FROM games");
$gameq->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h2 class="mb-4">Last Updated Games</h2>
        <div class="row">
            <?php $count = 0; ?>
            <?php foreach ($gameq as $game) : 
$creatorq = $db->prepare("SELECT * FROM users WHERE id=?");
$creatorq->execute([$game['creatorid']]);
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);
$creatorName = $creator['username']; ?>
                <div class="col-md-3">
                    <div class="card mb-4"><a href="/place.php?id=<?=$game['id']?>">
                        <div class="card-body">
<img src="https://picsum.photos/300/200" class="card-img-top" alt="Placeholder Image">
                            <h5 class="card-title"><?= $game['name'] ?></h5>
                            Creator: <?=$creatorName ?><br>
                            Players: <?= $game['players'] ?><br>
                        </div></a>
                    </div>
                </div>
                <?php if (++$count % 3 === 0) : ?>
                    </div><div class="row">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>
