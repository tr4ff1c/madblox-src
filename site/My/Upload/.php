<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php");

$type = htmlspecialchars((int)$_GET['type']);

if($loggedin !== "yes"){
   header("/Login/Default.aspx");
   exit;
}
?>

<?php if($type == 0){ 
$what = "T-Shirt";
$whata = "tshirt";
$typelol = "tshirts";
$explanation = '
                <p>On '.$sitename.', a T-Shirt is a transparent torso adornment with a decal applied to the front surface. To create a T-Shirt:</p>
                <ol>
                    <li>Click the "Browse" button below.</li>
                    <li>Use the File Explorer that pops up to browse your computer.</li>
                    <li>Find and select the picture that you want to use as the shirt\'s decal. Most standard images (.png, .bmp, .gif) will work.</li>
                    <li>Finally, click the "Create T-Shirt" button.</li>
                </ol>
                <p>The image you selected will be uploaded to '.$sitename.', where we will create a T-Shirt and add it to your inventory. To wear this T-Shirt, simply go to the <a href="/My/Character">Change Character</a> page, find them in your wardrobe, and click to wear them.</p>
';
}elseif($type == 1){
$what = "Shirt";
$whata = "shirt";
$typelol = "shirts";
$explanation = '
<p>On '.$sitename.', a Shirt is a textured character adornment that is applied to all surfaces of the character\'s arms and torso. To create Shirts:</p>
                <ol>
                    <li>Open the <a href="Template1.png">Shirt Template</a> in the image editor of your choice.</li>
                    <li>Modify the template to suit your tastes.</li>
                    <li>Save the customized Shirt texture to your computer.</li>
                    <li>Click the "Browse" button below.</li>
                    <li>Use the File Explorer that pops up to browse your computer.</li>
                    <li>Find and select the newly created Shirt Texture.</li>
                    <li>Finally, click the "Create Shirt" button.</li>
                </ol>
                <p>The texture you created will be uploaded to '.$sitename.', where we will add your Shirt and add it to your inventory. To wear this Shirt, simply go to the <a href="/My/Character">Change Character</a> page, find them in your wardrobe, and click to wear them.</p>
                <p style="display:none;">For more information, read the tutorial: <a href="#">How to Make Shirts and Pants</a>.</p>
';
}elseif($type == 2){
$what = "Pants";
$whata = "pants";
$typelol = "pants";
$explanation = '
<p>On '.$sitename.', a Pants is a textured character adornment that is applied to all surfaces of the character\'s legs and torso. To create Pants:</p>
                <ol>
                    <li>Open the <a href="Template2.png">Pants Template</a> in the image editor of your choice.</li>
                    <li>Modify the template to suit your tastes.</li>
                    <li>Save the customized Pants texture to your computer.</li>
                    <li>Click the "Browse" button below.</li>
                    <li>Use the File Explorer that pops up to browse your computer.</li>
                    <li>Find and select the newly created Pants Texture.</li>
                    <li>Finally, click the "Create Pants" button.</li>
                </ol>
                <p>The texture you created will be uploaded to '.$sitename.', where we will add your Pants and add it to your inventory. To wear this Pants, simply go to the <a href="/My/Character">Change Character</a> page, find them in your wardrobe, and click to wear them.</p>
                <p style="display:none;">For more information, read the tutorial: <a href="#">How to Make Shirts and Pants</a>.</p>
';
}elseif($type == 3){
$what = "Decal";
$whata = "decal";
$typelol = "decals";
$explanation = '
<p>On '.$sitename.', a Decal is an image that can be applied to one of a part\'s faces. To create a Decal:</p>
                <ol>
                    <li>Click the "Browse" button below.</li>
                    <li>Use the File Explorer that pops up to browse your computer.</li>
                    <li>Find and select the picture that you want to use as your decal. Only (.png) will work temporarily.</li>
                    <li>Finally, click the "Create Decal" button.</li>
                </ol>
                <p>The image you selected will be uploaded to '.$sitename.', where we will add your Decal and add it to your inventory. To use this Decal, simply open the <strong>Insert</strong> menu in '.$sitename.', choose My Decals, and click the Decal you wish to insert. You can drag the Decal onto the part you wish to decorate.</p>
';
}
?>
<div id="Body">
	<style>
	#Body table
	{
		border: 1px black solid;
	}
	.tablehead
	{
		font-size:16px; font-weight: bold; border-bottom:black 1px solid; width: 100%; background-color: #CCCCCC; color: #222222;
	}
	.tablebody
	{
		font-weight: lighter; background-color: transparent;font-family: Verdana;
	}
	.tablebody a {
	    color:blue;
	}
	.tablebody a:hover {
	    cursor:pointer;
	}
	th.tablebody {
    text-align: left;
    padding-left: 10px;
}
</style>

<h1><?=$what;?> Builder</h1>
<big>
   <table cellspacing="0px" width="100%">
      <tbody>
         <tr>
            <th class="tablehead">Instructions</th>
         </tr>
         <tr>
            <th class="tablebody">
                <?=$explanation;?>
            </th>
         </tr>
      </tbody>
   </table>
   <br>
   <table cellspacing="0px" width="100%">
      <tbody>
         <tr>
            <th class="tablehead">Upload Texture</th>
         </tr>
         <tr>
            <th class="tablebody">
               <center>
                  <form method="post" enctype="multipart/form-data" style="padding:25px;">
                    <input type="file" name="file" id="fileToUpload">
                    <br><br>
                    <input type="submit" name="submit" value="Create <?=$what;?>" name="<?=$what;?>">
                  </form>
               </center>
            </th>
         </tr>
      </tbody>
   </table>
</big>
</div>

<?php
if (isset($_POST['submit'])) {
   
   $targetDir = "../../ast/".$typelol."/";
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
if ($isImage !== false && !file_exists($targetFilePath) && $_FILES["file"]["size"] <= 5000 * 1024) {
             if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                  $filename = "http://".$sitedomain."/ast/".$typelol."/".$fileName."";
 
                  $sql = "INSERT IGNORE INTO catalog (id, name, description, thumbnail, creatorid, creation_date, price, type, assetid, filename, offsale) VALUES (NULL, :name, :description, :thumbnail, :creatorid, NOW(), :price, :type, 0, :filename, 1)";

                  $stmt = $db->prepare($sql);
                  
                  $tt = 'B';
                  if ($type == 'tshirt') {
                      $tt = $filename;
                  }
                  
                  $stmt->bindParam(':name', $fileName);
                  $stmt->bindValue(':description', 'h');
                  $stmt->bindParam(':thumbnail', $thumbnail);
                  $stmt->bindParam(':creatorid', $_USER['id']);
                  $stmt->bindValue(':price', '0');
                  $stmt->bindParam(':type', $whata);
                  $stmt->bindParam(':filename', $filename);

                  
                  $new = $stmt->execute();
                  
               header("location: /Catalog.aspx");
             } else {
               echo "Error uploading the file.";
             }
}
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
