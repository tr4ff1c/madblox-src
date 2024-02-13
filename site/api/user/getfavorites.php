<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/database.php';
  
$querytype = isset($_GET["wtype"]) ? htmlspecialchars($_GET["wtype"]) : 'hat';
$typela = 0;
if($_GET['wtype'] == "shirt"){
  $typela = 1;
}
if($_GET['wtype'] == "pants"){
  $typela = 2;
}          

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$a = $db->prepare("SELECT * FROM users WHERE id=?");
$a->execute([$id]);
$arows = $a->rowCount();
if($arows < 1){
	die("Failed to get favourites.");
}
?>
                  <?php
$stmt = $db->prepare("SELECT * FROM favorites WHERE userid = ? AND type = ?");
$stmt->execute([$id,  $querytype]);
$ab = $stmt->rowCount();
if($ab < 1){
  die("This user has no favorites for this type");
}
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $stmt2 = $db->prepare("SELECT * FROM catalog WHERE id = :itemid");
    $stmt2->execute(array(':itemid' => $row['itemid']));
    $item = $stmt2->fetch(PDO::FETCH_ASSOC);

    if($item['type'] == "hat"){
	$typeala = "catalog/hats";
    }
    if($item['type'] == "shirt"){
	$typeala = "catalog/shirts";
    }
    if($item['type'] == "pants"){
	$typeala = "catalog/pants";
    }

    if($item['type'] == "head"){
	$typeala = "catalog/heads";
    }

    if ($item['type'] !== "face" && $item['type'] !== "tshirt") {
    $thumburl = "http://" . $sitedomain . "/img/" . $typeala . "/" . $item['id'] . ".png?rand=" . random_int(1, 999999999999999999);
} else {
    if ($item['type'] == "face") {
        $thumburl = $item['thumbnail'];
    } else {
        $thumburl = $item['filename'];
    }
}

    $stmt3 = $db->prepare("SELECT * FROM users WHERE id = :creatorid");
    $stmt3->execute(array(':creatorid' => $item['creatorid']));
    $user = $stmt3->fetch(PDO::FETCH_ASSOC);

    $name = htmlspecialchars($item['name']);
    $creator = htmlspecialchars($user['username']);
  
    $itemtype = "Unknown";
    if($item['type'] == "hat"){
      $itemtype = "Hat";
    }
    if($item['type'] == "pants"){
      $itemtype = "Pants";
    }
    if($item['type'] == "shirt"){
      $itemtype = "Shirt";
    }
    if($item['type'] == "face"){
      $itemtype = "Face";
    }
    if($item['type'] == "tshirt"){
      $itemtype = "T-Shirt";
    }

    if($item['type'] == "hat" || $item['type'] == "head" || $item['type'] == "shirt" || $item['type'] == "pants"){ $alawidth = "100"; } else { $alawidth = "120"; }

    if($item['type'] !== "tshirt"){
    echo "<div class='Asset' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
        <div id='".addslashes($name)."' class='AssetThumbnail' style='cursor:pointer;'><img class='img' width='".$alawidth."' height='120' src='".$thumburl."'>
            
        </div>
        <a class='name' href='/Item.aspx?ID=".$item["id"]."'>".filterText(htmlspecialchars($name))."</a><br>
        <div class='AssetCreator'><span class='Label'>Creator:</span> <span class='Detail'><a id='ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_GameCreatorHyperLink' href='/User.aspx?ID=".$item['creatorid']."'>".$creator."</a></span></div>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } else { echo "<div class='Asset' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
        <div id='".addslashes($name)."' class='AssetThumbnail' style='cursor:pointer;'><a id='ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_AssetThumbnailHyperLink' title='' href='/Item.aspx?ID=".$id."' style='display:inline-block;cursor:pointer; background-image: url(/images/tshirt.png); background-size: 110px 120px; height: 120px; width: 110px;'><img src='".$thumburl."' width='120' height='120' border='0' id='imga' alt='' blankurl='http://t6.roblox.com:80/blank-120x120.gif' style='height: 60px; width: 60px; margin-top: 27px;'></a>
           
        </div>
        <a class='name' href='/Item.aspx?ID=".$item["id"]."'>".filterText(htmlspecialchars($name))."</a><br>
        <div class='AssetCreator'><span class='Label'>Creator:</span> <span class='Detail'><a id='ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_GameCreatorHyperLink' href='/User.aspx?ID=".$item['creatorid']."'>".$creator."</a></span></div>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
}

$stmt4 = $db->prepare("SELECT * FROM owneditems WHERE ownerid = :ownerid AND type = :querytype");
$stmt4->execute(array(':ownerid' => $id, ':querytype' => $querytype));
                   
    
          
                                    
     ?>
              <?php
       if(is_null($querytype)) {
    echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='padding-left:13px;'>Please select a category.</div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
      }
    
                                  ?>
               
                                  
                                            </div>
        <div style="clear:both;"></div>