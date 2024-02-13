<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/head.php';
if($loggedin !== 'yes') {header('location: /Login/Default.aspx'); exit;}
  
$querytype = isset($_GET["wtype"]) ? htmlspecialchars($_GET["wtype"]) : 'hat';
$typela = 0;
if($_GET['wtype'] == "shirt"){
  $typela = 1;
}
if($_GET['wtype'] == "pants"){
  $typela = 2;
}          

$headcolor = $RobloxColorsHtml[array_search($_USER['headcolor'], $RobloxColors)];
$torsocolor = $RobloxColorsHtml[array_search($_USER['torsocolor'], $RobloxColors)];
$color_leftarm = $RobloxColorsHtml[array_search($_USER['leftarmcolor'], $RobloxColors)];
$color_rightarm = $RobloxColorsHtml[array_search($_USER['rightarmcolor'], $RobloxColors)];
$color_leftleg = $RobloxColorsHtml[array_search($_USER['leftlegcolor'], $RobloxColors)];
$color_rightleg = $RobloxColorsHtml[array_search($_USER['rightlegcolor'], $RobloxColors)];
?>
<div id="Body">
    <style>

  .clothe
  {
    width:110px;
    /*height: 200px;*/
    margin: 10px;
    text-align: left;
    
    vertical-align: top;
    display: inline-block;
    display: -moz-inline-stack;
    display: inline;
  }
  .clothe .name {
    font-weight: bold;
  }
  .nocl
  {
    font-family: Verdana;
    font-weight: bold;
    text-align: center;
  }
  .img{
    border:none;
    height: 100%;
  }
  .imgc
  {
    border:1px solid black;
    width: 110px;
    height: 110px;
    text-align: center;
    padding: 10px;
    position: relative;
  }
  .fixed
  {
    position:absolute;
    right:0;
    top:0;
    background-color: #EEEEEE;
    border: 1px solid #555555;
    color: blue;
    font-family: Verdana;
    font-size: 10px;
    font-weight: lighter;
  }
  #left{
    width: 69%;
    float: left;
  }
  #right{
    width: 30%;
    float: right;
  }
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
  .margin{
    margin:10px;
  }
  .clickable, .clickable3, .clickable2
  {
    border: none;
    margin:1px;
  }
  .clickable{
    width:50px;
    height: 50px;
  }
  .clickablesm{
    width:40px;
    height:40px;
    margin:5px;
  }
  .clickable2{
    width:47px;
    height: 100px;
  }
  .clickable3{
    width:100px;
    height: 100px;
  }
  .nonsbtn
  {
    font-weight:normal;
  }
  #col{
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -105px;
    margin-left: -205px;
    width: 410px;
    height: 210px;
    z-index: 498;
    background-color: white;
    text-align: center;
    vertical-align: center;
  }
  .tablebody a {
      color:blue;
  }
  .tablebody a:hover {
      cursor:pointer;
  }
#left {
    width: 69%;
    float: left;
}
.clickable2 {
    width: 47px;
    height: 100px;
}
.clickable3 {
    width: 100px;
    height: 100px;
}
#right {
    width: 30%;
    float: right;
}
.tablebody {
    font-weight: lighter;
    background-color: transparent;
    font-family: Verdana;
}
.clickable {
    width: 50px;
    height: 50px;
}
.clickable, .clickable3, .clickable2 {
    border: none;
    margin: 1px;
}
#Body table {
    border: 1px black solid;
}
.tablehead {
    font-size: 16px;
    font-weight: bold;
    border-bottom: black 1px solid;
    width: 100%;
    background-color: #CCCCCC;
    color: #222222;
}
</style>
<script>
  $(document).ready(function () {
    function loadContent(wtype) {
      history.pushState(null, null, '/My/Character.aspx?wtype=' + wtype);

      $.ajax({
        url: '/api/user/getwardrobe.php',
        type: 'GET',
        data: { wtype: wtype },
        success: function (responseData) {
          $('#wardrobe').html(responseData);
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
        }
      });
    }

    // Function to handle link click
    function handleLinkClick(link, wtype) {
      $('.tablebody a').removeClass('bold');
      link.addClass('bold');
      loadContent(wtype);
    }

    $(document).ready(function () {
      handleLinkClick($('#btn7'), 'hat');
    });

    $(document.body).on('click', '#btn2', function (e) {
      e.preventDefault();
      handleLinkClick($('#btn2'), 'tshirt');
    });

    $(document.body).on('click', '#btn5', function (e) {
      e.preventDefault();
      handleLinkClick($('#btn5'), 'shirt');
    });

    $(document.body).on('click', '#btn6', function (e) {
      e.preventDefault();
      handleLinkClick($('#btn6'), 'pants');
    });

    $(document.body).on('click', '#btn7', function (e) {
      e.preventDefault();
      handleLinkClick($('#btn7'), 'hat');
    });

    $(document.body).on('click', '#btn8', function (e) {
      e.preventDefault();
      handleLinkClick($('#btn8'), 'face');
    });

    $(document.body).on('click', '#btn9', function (e) {
      e.preventDefault();
      handleLinkClick($('#btn9'), 'head');
    });
  });
</script>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div id="left">
    <table cellspacing="0px" width="100%" style="margin-bottom:10px;<?php if($_USER["afison"] !== 1) { echo "display:none;"; } ?>">
    <tbody><tr>
        <th class="tablehead">Custom</th>
    </tr>
  </tbody><tbody><tr>
  <th class="tablebody">


<p style="margin: 0;font-weight: bold;">Queue</p>
 <h2 style="margin: 0;font-size: 15px;letter-spacing: normal;"><div id="renderQueue">Please wait 2 seconds.</div></h2>
<script>
let showingrender = true;
const queue = document.querySelector("#renderQueue");
setInterval(async () => {
	try{
		const req = await fetch("/img/userGetQueue");
		const res = await req.json();
		if(res.success) {
			if(res.inqueue) {
				showingrender = false;
				document.querySelector("#renderEngineIcon").style.display = "block";
				document.getElementById("mycharacterrender").style.animation = "shake 0.3s infinite";
				queue.innerText = "You are in " + res.queuePlace + "th Place out of " + res.allRows + ".";
			} else {
				queue.innerText = "You are not rendering. (" + res.allRows + " processing renders)";
				if(!showingrender) {
					showingrender = true;
					queue.innerText = "Your render is finished. (" + res.allRows + " processing renders)";
					document.querySelector("#renderEngineIcon").style.display = "none";
					document.getElementById("mycharacterrender").style.animation = null;
					document.getElementById("mycharacterrender").src = "/api/avatar/getthumb.php?id=<?php echo (int)$_USER["id"]; ?>";
				}
			}
			if(res.rsLastPing >= 7) {
				queue.innerHTML += "<br><span style='color: red;display: inline-block;animation: shake 0.3s infinite;'>Last RenderServer ping: " + res.rsLastPing + " seconds ago.</span>";
			} else {
				queue.innerHTML += "<br>Last RenderServer ping: " + res.rsLastPing + " seconds ago.";
			}
		} else {
			queue.innerText = "Oops! An error occurred: " + res.message;
		}
	} catch(err) {
		queue.innerText = "Oops! An error occurred: " + err;
	}
}, 2000);
</script>
<hr>
<p style="margin: 0;font-weight: bold;">Poses</p>
<select id="positions">
	<option<?php if($_USER["renderPosition"] === "default") {echo " selected";} ?> value="default">Default</option>
	<option<?php if($_USER["renderPosition"] === "siu") {echo " selected";} ?> value="siu">SIUUUUUUUUU</option>
	<option<?php if($_USER["renderPosition"] === "walk") {echo " selected";} ?> value="walk">Walking</option>
	<option<?php if($_USER["renderPosition"] === "sit") {echo " selected";} ?> value="sit">Sitting</option>
	<option<?php if($_USER["renderPosition"] === "lefthand") {echo " selected";} ?> value="lefthand">Left Hand</option>
	<option<?php if($_USER["renderPosition"] === "righthand") {echo " selected";} ?> value="righthand">Right Hand</option>
	<option<?php if($_USER["renderPosition"] === "wave") {echo " selected";} ?> value="wave">Wave</option>
</select>
<button id="positionSubmit">Submit</button>
<script>
const positions = document.querySelector("#positions");
document.querySelector("#positionSubmit").addEventListener("click", async () => {
	setPosition(positions.value, true);
	render();
});
</script>
<!--hr>
<p style="margin: 0;font-weight: bold;">Daytime</p>
<select id="daytimes">
	<option<?php if($_USER["renderDaytime"] == 12) {echo " selected";} ?> value="12">12 (Default)</option>
	<option<?php if($_USER["renderDaytime"] == 0) {echo " selected";} ?> value="0">0</option>
	<option<?php if($_USER["renderDaytime"] == 1) {echo " selected";} ?> value="1">1</option>
	<option<?php if($_USER["renderDaytime"] == 2) {echo " selected";} ?> value="2">2</option>
	<option<?php if($_USER["renderDaytime"] == 3) {echo " selected";} ?> value="3">3</option>
	<option<?php if($_USER["renderDaytime"] == 4) {echo " selected";} ?> value="4">4</option>
	<option<?php if($_USER["renderDaytime"] == 5) {echo " selected";} ?> value="5">5</option>
	<option<?php if($_USER["renderDaytime"] == 6) {echo " selected";} ?> value="6">6</option>
	<option<?php if($_USER["renderDaytime"] == 7) {echo " selected";} ?> value="7">7</option>
	<option<?php if($_USER["renderDaytime"] == 8) {echo " selected";} ?> value="8">8</option>
	<option<?php if($_USER["renderDaytime"] == 9) {echo " selected";} ?> value="9">9</option>
	<option<?php if($_USER["renderDaytime"] == 10) {echo " selected";} ?> value="10">10</option>
	<option<?php if($_USER["renderDaytime"] == 11) {echo " selected";} ?> value="11">11</option>
	<option<?php if($_USER["renderDaytime"] == 13) {echo " selected";} ?> value="13">13</option>
	<option<?php if($_USER["renderDaytime"] == 14) {echo " selected";} ?> value="14">14</option>
	<option<?php if($_USER["renderDaytime"] == 15) {echo " selected";} ?> value="15">15</option>
	<option<?php if($_USER["renderDaytime"] == 16) {echo " selected";} ?> value="16">16</option>
	<option<?php if($_USER["renderDaytime"] == 17) {echo " selected";} ?> value="17">17</option>
	<option<?php if($_USER["renderDaytime"] == 18) {echo " selected";} ?> value="18">18</option>
	<option<?php if($_USER["renderDaytime"] == 19) {echo " selected";} ?> value="19">19</option>
	<option<?php if($_USER["renderDaytime"] == 20) {echo " selected";} ?> value="20">20</option>
	<option<?php if($_USER["renderDaytime"] == 21) {echo " selected";} ?> value="21">21</option>
	<option<?php if($_USER["renderDaytime"] == 22) {echo " selected";} ?> value="22">22</option>
	<option<?php if($_USER["renderDaytime"] == 23) {echo " selected";} ?> value="23">23</option>
</select>
<button id="daytimeSubmit">Submit</button>
<script>
const daytimes = document.querySelector("#daytimes");
document.querySelector("#daytimeSubmit").addEventListener("click", async () => {
	setDaytime(parseInt(daytimes.value), true);
	render();
});
</script-->
</th>
                                  </tr>
    
    
    </tbody></table>
  <table cellspacing="0px" width="100%" style="margin-bottom:10px;">
    <tbody><tr>
        <th class="tablehead">My Wardrobe</th>
    </tr>
   <tr>
    <td class="tablebody" style="font-size:12px; text-align: center; border-bottom: 1px solid black;">
        <a id="btn2" href="/My/Character.aspx?wtype=tshirt" onclick="makeBold('btn2')">T-Shirts</a>
        |
        <a id="btn5" href="/My/Character.aspx?wtype=shirt" onclick="makeBold('btn5')">Shirts</a>
        |
        <a id="btn6" href="/My/Character.aspx?wtype=pants" onclick="makeBold('btn6')">Pants</a>
        |
        <a id="btn7" href="/My/Character.aspx?wtype=hat" onclick="makeBold('btn7')">Hats</a>
        |
        <a id="btn8" href="?wtype=face" onclick="makeBold('btn8')">Faces</a>
        |
        <a id="btn9" href="?wtype=head" onclick="makeBold('btn9')">Heads</a>
        <br>
        <a href="/Catalog.aspx">Shop</a> |
        <a href="/my/upload/?type=<?php echo $typela; ?>">Create</a>
    </td>

<script>
    $(document).ready(function () {
        function setHatBold() {
            $('a[id^="btn"]').css('font-weight', 'normal');
            $('#btn7').css('font-weight', 'bold');
        }

        setHatBold();

        $('.tablebody a').click(function () {
            $('a[id^="btn"]').css('font-weight', 'normal');
            $(this).css('font-weight', 'bold');
        });
    });
</script>




</tr>

    <tr>
        <td class="tablebody">
            <div id="wardrobe" style="padding-left:13px;">
                  
               
                                  
                                            </div>
        <div style="clear:both;"></div>
      </td>
    </tr>
  </tbody></table><div class="seperator"></div>
  <table cellspacing="0px" width="100%" style="margin-bottom: 10px;">
    <tbody><tr>
        <th class="tablehead">Currently Wearing</th>
    </tr>
  </tbody><tbody><tr>
  <th class="tablebody">
  <?php
$itemsq = $db->prepare("SELECT * FROM wearing WHERE userid=:user_id");
$itemsq->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);
$itemsq->execute();

while($row = $itemsq->fetch(PDO::FETCH_ASSOC)) {
    $itemq = $db->prepare("SELECT * FROM catalog WHERE id=:item_id");
    $itemq->bindParam(':item_id', $row['itemid'], PDO::PARAM_INT);
    $itemq->execute();
    $item = $itemq->fetch(PDO::FETCH_ASSOC);

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

    $iteml = $db->prepare("SELECT * FROM users WHERE id=:creator_id");
    $iteml->bindParam(':creator_id', $item['creatorid'], PDO::PARAM_INT);
    $iteml->execute();
    $user = $iteml->fetch(PDO::FETCH_ASSOC);
    
    $name = filterText(htmlspecialchars($item['name']));
    $creator = htmlspecialchars($user['username']);
    $id = (int)$item['id'];
  
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

    if($item['type'] == "hat" ){ $alawidth = "100"; } else { $alawidth = "120"; }
    if($item['type'] !== "tshirt"){
    echo "<div class='clothe' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
        <div id='".$name."' class='imgc' style='cursor:pointer;'><img class='img' width='".$alawidth."' height='120' src='".$thumburl."'>
            <div class='fixed'><a href=\"/My/characterremove.php?id=".$item['id']."&wtype=".$querytype."\">[ remove ]</a></div>
        </div>
        <a class='name' href='/Item.aspx?ID=".$id."'>".$name."</a><br>
        Type: ".$itemtype."<br>
        Creator: <a href='/User.aspx?ID=".$item['creatorid']."'>".$creator."</a>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; } else { echo "<div class='clothe' style='font-size:10.85px; display:inline-block; *display:inline; margin:5px; display: inline-block; display: -moz-inline-stack; *display: inline; vertial-align:top;'>
        <div id='".$name."' class='imgc' style='cursor:pointer;'><a id='ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_AssetThumbnailHyperLink' title='' href='/Item.aspx?ID=".$id."' style='display:inline-block;cursor:pointer; background-image: url(/images/tshirt.png); background-size: 120px 120px; height: 120px; width: 120px;'><img src='".$thumburl."' width='120' height='120' border='0' id='imga' alt='' blankurl='http://t6.roblox.com:80/blank-120x120.gif' style='height: 70px; width: 70px; margin-top: 27px;'></a>
            <div class='fixed'><a href=\"/My/characterremove.php?id=".$item['id']."&wtype=".$querytype."\">[ remove ]</a></div>
        </div>
        <a class='name' href='/Item.aspx?ID=".$id."'>".$name."</a><br>
        Type: ".$itemtype."<br>
        Creator: <a href='/User.aspx?ID=".$item['creatorid']."'>".$creator."</a>
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
}
?>
</th>
                                  </tr>
    
    
    </table>
</div>
    <div id="right">
                    <table cellspacing="0px" width="100%">
                        <tbody>
                            <tr><th class="tablehead">My Character</th></tr>
                            <tr>
                                <th class="tablebody">
				    <img id="renderEngineIcon" src="/images/rendersettings.png" style="display: none;position: absolute;width: 45px;z-index: 99999;animation: spin 1s infinite linear;margin: 20px;">
                                    <iframe width="180" height="220" frameborder="0" style="margin-left: 30px;" class="margin" id="mycharacterrender" src="/api/avatar/getthumb.php?id=<?php echo $_USER["id"]; ?>"></iframe>
                                    <img class="margin" id="uimg" src="">
                                    <form method="post">
                                        Something wrong with your avatar? Click <a href="#" onclick="render();">here</a> to fix the problem!
                                    </form>
                                </th>
                            </tr>
                        </tbody>
                    </table>
      <table cellspacing="0px" width="100%" style="margin-top: 10px;">
    <tbody><tr><th class="tablehead">Color Chooser</th></tr>
    <tr><th class="tablebody"><br>
      <button class="clickable" id="head" style="background-color:<?=$headcolor?>" onclick="openColorPanel('head');"></button><div class="seperator" style="height: 5px;"></div>
      <button class="clickable2" id="rightarm" style="background-color:<?=$color_rightarm?>" onclick="openColorPanel('rightarm');"></button>
      <button class="clickable3" id="torso" style="background-color:<?=$torsocolor?>" onclick="openColorPanel('torso');"></button>
      <button class="clickable2" id="leftarm" style="background-color:<?=$color_leftarm?>" onclick="openColorPanel('leftarm');"></button><div class="seperator" style="height: 5px;"></div>
      <button class="clickable2" id="rightleg" style="background-color:<?=$color_rightleg?>" onclick="openColorPanel('rightleg');"></button>
      <button class="clickable2" id="leftleg" style="background-color:<?=$color_leftleg?>" onclick="openColorPanel('leftleg');"></button>
    <br>Click <a href="#" disabled="disabled">here</a> to reset your character.<br></th></tr>
  </tbody></table>
</div>
<div id="colorPanel" class="popupControl" style="top: 435px; right: 165px; display: none; visibility: visible !important;">
  <table cellspacing="0" border="0" style="border-width:0px;border-collapse:collapse;">
    <tr>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('1')" style="display:inline-block;background-color:#F2F3F2;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('208')" style="display:inline-block;background-color:#E5E4DE;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('194')" style="display:inline-block;background-color:#A3A2A4;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('199')" style="display:inline-block;background-color:#635F61;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('26')" style="display:inline-block;background-color:#1B2A34;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('21')" style="display:inline-block;background-color:#C4281B;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('24')" style="display:inline-block;background-color:#F5CD2F;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('226')" style="display:inline-block;background-color:#FDEA8C;height:32px;width:32px;">
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('23')" style="display:inline-block;background-color:#0D69AB;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('107')" style="display:inline-block;background-color:#008F9B;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('102')" style="display:inline-block;background-color:#6E99C9;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('11')" style="display:inline-block;background-color:#80BBDB;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('45')" style="display:inline-block;background-color:#B4D2E3;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('135')" style="display:inline-block;background-color:#74869C;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('106')" style="display:inline-block;background-color:#DA8540;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('105')" style="display:inline-block;background-color:#E29B3F;height:32px;width:32px;">
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('141')" style="display:inline-block;background-color:#27462C;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('28')" style="display:inline-block;background-color:#287F46;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('37')" style="display:inline-block;background-color:#4B974A;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('119')" style="display:inline-block;background-color:#A4BD46;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('29')" style="display:inline-block;background-color:#A1C48B;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('210')" style="display:inline-block;background-color:#789081;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('38')" style="display:inline-block;background-color:#A05F34;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('192')" style="display:inline-block;background-color:#694027;height:32px;width:32px;">
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('104')" style="display:inline-block;background-color:#6B327B;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('9')" style="display:inline-block;background-color:#E8BAC7;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('101')" style="display:inline-block;background-color:#DA8679;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('5')" style="display:inline-block;background-color:#D7C599;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('153')" style="display:inline-block;background-color:#957976;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('217')" style="display:inline-block;background-color:#7C5C45;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('18')" style="display:inline-block;background-color:#CC8E68;height:32px;width:32px;">
        </div>
      </td>
      <td>
        <div class="ColorPickerItem" onclick="selBodyC('125')" style="display:inline-block;background-color:#EAB891;height:32px;width:32px;">
        </div>
      </td>
    </tr>
  </table>
</div>
<div style="clear:both;"></div>

<script>

function setColorPickerActive(part) {
	selectedPart = part;
	document.getElementById("ColorPopupPanel").classList.remove('popupControl');
	document.getElementById("ColorPopupPanel").classList.add('popupControlShown');

	document.getElementById("ModalCloser").classList.add('modalBackground');
	document.getElementById("ModalCloser").classList.remove('modalBackgroundClosed');
}

function CloseColorChooser() {
	document.getElementById("ColorPopupPanel").classList.add('popupControl');
	document.getElementById("ColorPopupPanel").classList.remove('popupControlShown');

	document.getElementById("ModalCloser").classList.remove('modalBackground');
	document.getElementById("ModalCloser").classList.add('modalBackgroundClosed');
}

  // Keep track of the last render time
  let lastRenderTime = 0;

async function setDaytime(dt, norender = false) {
	const data = new FormData();
	data.append("daytime", dt);
	data.append("norender", true);
    const req = await fetch("/My/setrenderdaytime", {
		method: "POST",
		body: data
	});
    const res = await req.json();
    if(!res.success) {
        alert("Error while setting daytime: " + res.message);
    }
	if(!norender) { render(); }
}

async function setPosition(pos, norender = false) {
	const data = new FormData();
	data.append("position", pos);
	data.append("norender", true);
	const req = await fetch("/My/setrenderposition", {
		method: "POST",
		body: data
	});
    const res = await req.json();
    if(!res.success) {
        alert("Error while setting daytime: " + res.message);
    }
	if(!norender) { render(); }
}

  function render() {
    // Get the current timestamp
    const currentTime = Date.now();

    // Check if the time between the current render request and the last render request is less than 5 seconds
    if (currentTime - lastRenderTime < 3000) {
      /*alert("Please wait at least 3 seconds between render requests.");
      return;*/
    }

    // Update the last render time with the current timestamp
    lastRenderTime = currentTime;

    // Trigger the render action by changing the iframe source
    document.getElementById("mycharacterrender").src = "/api/render";
  }
</script>

<script>
  var BP = 0;
  var OP = false;
  function changeBC(bdp,colour) 
  {
    console.log(bdp);
    console.log(colour);
    // $("#"+bdp).css("background-color", "#ffffff");
    $("#limg").attr("src", "/images/redrawing.png");
        $.post("/my/character/bodycolornew.php", {bodyP:bdp,color:colour,csrf:$("#csrf_token").val()}, function(){ location.reload(); })
        .fail(function() 
        {
          $("#wardrobe").html("Failed to change body colour");
        });
  }

  function resetBC() 
  {
    changeBC(0,"#F5CD2F");
    changeBC(3,"#F5CD2F");
    changeBC(2,"#C4281B");
    changeBC(1,"#F5CD2F");
    changeBC(4,"#4B974A");
    changeBC(5,"#4B974A");
    $("#colorPanel").hide();
  }

  function openColorPanel(bodyPart) {
    if ($("#colorPanel").is(":visible")) 
    {
      if(bodyPart !== BP) 
      {
        BP = bodyPart;
      } 
      else 
      {
        $("#colorPanel").hide();
      }
    } 
    else 
    {
      BP = bodyPart;
      console.log(BP);
      console.log(BP);
      console.log("test");
      $("#colorPanel").show();
    }
    //$("#colorPanel").attr("data-body-part", BP);
  }
  
  var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 
  function rgb2hex(rgb) 
  {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
  }
  function hex(x) 
  {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
  }
  function selBodyC(color) 
  {
    changeBC(BP, color);
    $("#colorPanel").hide();
  }
</script>

