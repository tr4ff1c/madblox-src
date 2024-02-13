<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/database.php';
if($loggedin !== 'yes') {exit("<h2>Please login.</h2>");}
  
$querytype = isset($_GET["wtype"]) ? htmlspecialchars($_GET["wtype"]) : 'hat';
$typela = 0;
if($_GET['wtype'] == "shirt"){
  $typela = 1;
}
if($_GET['wtype'] == "pants"){
  $typela = 2;
}          
?>

<td class="tablebody">
            <div id="wardrobe" style="padding-left:13px;">
                  <?php
$stmt = $db->prepare("SELECT * FROM owneditems WHERE ownerid = :ownerid AND type = :querytype");
$stmt->execute(array(':ownerid' => $_USER["id"], ':querytype' => $querytype));
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

    $name = filterText(htmlspecialchars($item['name']));
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
    echo "<div class='clothe' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
        <div id='".$name."' class='imgc' style='cursor:pointer;'><img class='img' width='".$alawidth."' height='120' src='".$thumburl."'>
            <div class='fixed'><a href=\"/My/characterwear.php?id=".$item['id']."&wtype=".$querytype."\">[ wear ]</a></div>
        </div>
        <a class='name' href='/Item.aspx?ID=".$item['id']."'>".$name."</a><br>
        Type: ".$itemtype."<br>
        Creator: <a href='/User.aspx?ID=".$item['creatorid']."'>".$creator."</a>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } else { echo "<div class='clothe' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
        <div id='".$name."' class='imgc' style='cursor:pointer;'><a id='ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_AssetThumbnailHyperLink' title='' href='/Item.aspx?ID=".$id."' style='display:inline-block;cursor:pointer; background-image: url(/images/tshirt.png); background-size: 120px 120px; height: 120px; width: 120px;'><img src='".$thumburl."' width='120' height='120' border='0' id='imga' alt='' blankurl='http://t6.roblox.com:80/blank-120x120.gif' style='height: 70px; width: 70px; margin-top: 27px;'></a>
            <div class='fixed'><a href=\"/My/characterwear.php?id=".$item['id']."&wtype=".$querytype."\">[ wear ]</a></div>
        </div>
        <a class='name' href='/Item.aspx?ID=".$item['id']."'>".$name."</a><br>
        Type: ".$itemtype."<br>
        Creator: <a href='/User.aspx?ID=".$item['creatorid']."'>".$creator."</a>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
}

$stmt4 = $db->prepare("SELECT * FROM owneditems WHERE ownerid = :ownerid AND type = :querytype");
$stmt4->execute(array(':ownerid' => $_USER["id"], ':querytype' => $querytype));
                   
    
          
                                    
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
      </td>
    </tr>