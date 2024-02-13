<?php
require_once("nav.php");

if($loggedin !== "yes"){
	header("Location: /");
	exit;
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$gameq = $db->prepare("SELECT * FROM games WHERE id=?");
$gameq->execute([$id]);
$game = $gameq->fetch(PDO::FETCH_ASSOC);
$timestamp = $game['creatd'];
$created = date("m/d/Y", strtotime($timestamp));
$visitsq = $db->prepare("SELECT * FROM gamevisits WHERE gameid=?");
$visitsq->execute([$game['id']]);
$visits = $visitsq->rowCount();
$creatorq = $db->prepare("SELECT * FROM users WHERE id=?");
$creatorq->execute([$game['creatorid']]);
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);
$creatorName = $creator['username'];
?>
<br>
<body>

  <div class="container mt-6">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <img src="https://via.placeholder.com/800x400" class="card-img-top" alt="Placeholder Image">
          <div class="card-body">
            <h5 class="card-title"><?=$game['name']?></h5>
            <p class="card-text">by <?=$creatorName?></p>
            <a href="/play.php?gameid=<?=$game['id']?>" class="btn btn-primary">Play</a><br><br>
	    <p style="text-align: right;"> Visits: <?=$visits?> | Players: <?=$game['players']?> | Created: <?=$created?> </p>
	    <h4>Description</h4>
	    <?=$game['description']?>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
           <div class="card-body">
            <center><h4>Servers</h4></center>
	    this is an WIP
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>