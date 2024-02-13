<?php
require_once("nav.php");

if ($loggedin !== "yes") {
    header("Location: /");
    exit;
}

if($_USER['blurb'] == ""){
	$blurb = "No blurb set.";
}else{
	$blurb = $_USER['blurb'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $sitename ?> | Home</title>
    <style>
        .avatar {
            float: left;
            margin-right: 20px;
        }

        h1 {
            margin: 0;
            font-size: 1.5em;
        }
    </style>

</head>

<body><br>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Larger Card -->
                <div class="card mb-3">
                    <h3 class="card-header">My Account</h3>
                    <div class="card-body">
                        <h5 class="card-title">Welcome, <?= $_USER['username'] ?>!</h5>
                    </div>
                    <img src="renders/<?=$_USER['id']?>.png">

                    <div class="card-footer text-muted">
                        Account created on <br><?= $_USER['creationdate'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Smaller Card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Statistics</h4><br>
                        <h6 class="card-subtitle mb-2 text-muted">My Friends: 0 (0 last week)</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Place Visits: 0 (0 last week)</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Followers: 0 (0 last week)</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Following: 0 (0 last week)</h6>
                    </div>
                </div><br><br>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Friends</h4><br><center>
                        <h6 class="card-subtitle mb-2 text-muted">WIP</h6></center>
                    </div>
                </div><br><br>
		<div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recently Played</h4><br><center>
                        <h6 class="card-subtitle mb-2 text-muted">WIP</h6></center>
                    </div>
                </div><br><br>
		<div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Settings</h4><br><center>
                        <a href="/avatar.php"><h6 class="card-subtitle mb-2 text-muted">Change your avatar</h6><a>
<a href="/blurb.php"><h6 class="card-subtitle mb-2 text-muted">Change your blurb</h6><a>
<a href="/inventory.php"><h6 class="card-subtitle mb-2 text-muted">My Inventory</h6><a>
<a href="/develop.php"><h6 class="card-subtitle mb-2 text-muted">Game Creation</h6><a>

</center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

