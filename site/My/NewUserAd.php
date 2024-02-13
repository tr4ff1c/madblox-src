<?php
include '../core/head.php';

if($loggedin !== "yes"){
    header("/Login/Default.aspx");
    exit;
}

$id = filter_var($_REQUEST['targetId'], FILTER_SANITIZE_NUMBER_INT);

$a = $db->prepare("SELECT * FROM catalog WHERE id=?");
$a->execute([$id]);
$ar = $a->rowCount();
if($ar < 1){
    die("Cannot advertise an inexistant item");
}
$item = $a->fetch(PDO::FETCH_ASSOC);
if($item['creatorid'] !== $_USER['id']){
    die("You don't own this.");
}

if (isset($_POST['submit'])) {

    $title = filter_var($_POST['titleol'], FILTER_SANITIZE_STRING);
    $urllol = "/Item.aspx?id=".$item['id'];
   
   $targetDir = "../images/Ads/";
   $fileName = basename($_FILES["file"]["name"]);
   $targetFilePath = $targetDir . $fileName;
   $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
 
   // Check if a file was selected
   if (!empty($_FILES["file"]["tmp_name"])) {
     // Check if the file is a valid image
     $isImage = getimagesize($_FILES["file"]["tmp_name"]);
     if ($isImage !== false) {
       if (file_exists($targetFilePath)) {
    die("Please change the name of the file, it already exists on our servers.");
       } else {
         if ($_FILES["file"]["size"] > 5000 * 1024) {
 }
  else {
 // Check available space before uploading
 $freeSpace = disk_free_space($targetDir);
 $fileSize = $_FILES["file"]["size"];
 
 if ($freeSpace < $fileSize) {
     die("Not enough space available. Please choose a smaller file.");
 }
 
 if (strpos($fileName, ' ') !== false) {
     die("File name cannot contain spaces.");
 }
 
 if($type === 1 || $type === 2){
    if($price < 5){
       die("Minimum price is 5 for shirts or pants."); 
    }
    if($price > 10){
       die("Maximum price is 10 for shirts or pants."); 
    }
 }
 if($type === 0){
    if($price < 1){
       die("Minimum price is 1 for tshirts.");
    }
    if($price > 10){
       die("Maximum price is 10 for tshirts.");
    }
 }
           if ($fileType === "png") {
 $isImage = getimagesize($_FILES["file"]["tmp_name"]);
 $imageWidth = $isImage[0];
 $imageHeight = $isImage[1];
if ($isImage !== false && !file_exists($targetFilePath) && $_FILES["file"]["size"] <= 5000 * 1024) {
    if ($imageWidth == 728 && $imageHeight == 90) {
             if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                  $filenamee = "http://".$sitedomain."/images/Ads/".$fileName."";
 
                  $sql = "INSERT IGNORE INTO ads (id, adOwner, adtitle, adurl, adimg, status, moderation) VALUES (?, ?, ?, ?, ?, ?, ?)";
                  $stmt = $db->prepare($sql);
                  $stmt->execute([NULL, $_USER['id'], $title, $urllol, $filenamee, "stopped", "accepted"]);
                  
               header("location: /My/AdInventory.aspx");
             } else {
               echo "Error uploading the file.";
             }
}}
           } else {
             echo "Only PNG files are allowed.";
           }
         }
}
     } else {
       echo "Invalid file format. Only images are allowed.";
     }
   } else {
     echo "Please select a file.";
   }
 }
?>
<div id="Body">
<form method="post" enctype="multipart/form-data" style="padding:25px;">
    <h2>Instructions</h2>   
    On <?=$sitename?>, users can bid an amount of tickets to buy advertising for their places, clothing, and models. To create an ad:
    <br>
    <div style="margin-top:20px; margin-left:20px">
        <p>1. First you need to choose what size ad you want to make. There are currently one option. Each has a template that you can download to help you get started.</p>
    </div>
    <div style="margin-left:30px">
        <div style="margin-top:20px">
            <a href="/My/AdBannerTemplate.png">Download 728 x 90 Banner Template</a>
        </div>
    </div>
    <div style="margin-top:20px">
        <div style="margin-left:20px">
        2. Use image editing software to craft an enticing ad.
        </div>
    </div>
    <div style="margin-left:20px">
        3. Save the customized ad to your computer.
        <br>
        4. Click the "Upload" button below.
        <br>
        5. Use the File Explorer that pops up to browse your computer.
        <br>
        6. Find and select the newly created ad.
        <br>
    </div>
    <div style="margin-top:20px">
        The ad you have uploaded will be reviewed by our team of moderators, please allow several hours for this process. Once your ad has been approved, you will be able to launch the ad from your <a href="AdInventory.aspx">Ad Inventory</a> page.
    </div>
    <div style="margin-top:20px">
        Crafting an effective ad is an art. A good ad can get you more visitors for less money compared to a poor ad. 
    </div>
    <div style="margin-top:20px">
                <b>Upload an Ad</b>
    </div>
    <input name="file" type="file" id="fileToUpload">
    <div style="margin-top:0px">
        <b>Name your ad (users will see this text when they mouse-over your ad)</b>
    </div>
    <input name="titleol" type="text" id="Name" class="TextBox" style="width:150px;">
    <div style="margin-top:5px">
        <input name="submit" type="submit" id="Upload" class="Button" value="Upload">
    </div></form>
				</div>