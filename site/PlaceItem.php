<?php
  
require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");  

$id = filter_var($_GET['ID'], FILTER_SANITIZE_NUMBER_INT);
$gameitem = $db->prepare("SELECT * FROM games WHERE id=?");
$gameitem->execute([$id]);
$game = $gameitem->fetch(PDO::FETCH_ASSOC);


if (!$game) {
  die('<script>
  alert("This game does not exist !");
  document.location = "/games";
  </script>');
  exit;
}

$creatorq = $db->prepare("SELECT * FROM users WHERE id=?");
$creatorq->execute([$game['creatorid']]);
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);

$title = filterText(htmlspecialchars($game['name']))." by ".htmlspecialchars($creator['username'])." - ".$sitename." Places";

require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php");  
  
  require_once $_SERVER["DOCUMENT_ROOT"]."/ReCaptcha.php";

  if($testing == 'true' && ($_USER['USER_PERMISSIONS'] !== "Administrator" && $_USER['USER_PERMISSIONS'] !== "beta_tester")) {
    die("<div style='margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;'><strong><p>Games down because site up for testing purposes</p></strong></div>"); }
    
?>


<div id="Body">
<script>
  var sid;
  var token;
  var sid2;
  var activeTab = 1;
  function showTab(num) 
    {
    $("#tab" + activeTab).removeClass("Active");
    $("#tabb" + activeTab).hide();
    activeTab = num;
    $("#tab" + num).addClass("Active");
    $("#tabb" + num).show();
  }
  function JoinGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("The server is ready. Joining the game... ");
        token = data;
        location.href= "play.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function HostGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("Redirecting you to the host page... ");
        token = data;
        <?php // header("Location: /host.aspx?id=".$game['id']); ?>
        location.href= "host.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function StopGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("Stopping server... ");
        token = data;
        <?php // header("Location: /host.aspx?id=".$game['id']); ?>
        location.href= "stopgame.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function checkifProgressChanged() 
    {
    $.getJSON("" + sid, function(result) {
      $("#Requesting").html(result.msg);
      if(result.token == null) 
            {
        if(result.check == true) 
                {
          setTimeout(function() { checkifProgressChanged() }, 750);
        } 
                else 
                {
          $("#Spinner").hide();
        }
      } 
            else 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function joinServer() 
    {
    $.getJSON("" + sid2, function(result) 
        {
      $("#Requesting").html(result.msg);
      if(result.token != null) 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function closeModal() 
    {
    $("#joiningGameDiag").hide();
    $("#Spinner").show();
    $("#Requesting").html("Requesting a server");
  }
    </script>
<style>
  #ItemContainer #Thumbnail_Place {
  height: 230px;
  width: 420px;
  }
  .PlayGames {
  background-color: #ccc;
  border: dashed 1px Green;
  clear: left;
  color: Green;
  float: left;
  margin-top: 10px;
  padding: 10px 5px;
  text-align: center;
  width: 410px;
  }
  #ItemContainer #Actions, #ItemContainer #Actions_Place {
  background-color: #fff;
  border-bottom: dashed 1px #555;
  border-left: dashed 1px #555;
  border-right: dashed 1px #555;
  clear: left;
  float: left;
  padding: 5px;
  text-align: center;
  min-width: 0;
  position: relative;
  }
</style>
<div id="joiningGameDiag" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
  <div class="modalPopup" style="width: 27em; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <div style="margin: 1.5em">
<div id="Spinner" style="float:left;margin:0 1em 1em 0">
        <img src="/images/ProgressIndicator2.gif" style="border-width:0px;">
      </div>
      <div id="Requesting" style="display: inline">
        Requesting a server
      </div>
      <div style="text-align: center; margin-top: 1em">
        <input id="Cancel" onclick="closeModal()" type="button" class="Button" value="Cancel">
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<style>
#ItemContainer {
    background-color: #eee;
    border: solid 1px #555;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#Item {
    font-family: Verdana, Sans-Serif;
    padding: 10px;
}
</style>
<div id="ItemContainer" style="width:725px; margin:unset;float:left;">
  <h2><?php echo filterText(htmlspecialchars($game['name'], ENT_QUOTES, 'UTF-8')); ?></h2>
<div id="Item">
  <div id="Summary" style="width:251px;">
    <h3><?php echo $sitename; ?> Place</h3>
    <div id="Creator" class="Creator">
      <div class="Avatar">
                        <img src="/img/user/<?=$creator['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" frameborder="0" scrolling="no" width="100"></img>

        <a title="<?php echo htmlspecialchars($creator['username']); ?>" href="/User.php?ID=<?php echo htmlspecialchars($game['creator_id']); ?>" style="display:inline-block;cursor:pointer;"></a>
      </div>
      Creator: <a href="/User.php?ID=<?php echo htmlspecialchars($game['creator_id']); ?>"><?php echo htmlspecialchars($creator['username']); ?></a>
    </div>
    <div id="LastUpdate">Updated: <?php echo htmlspecialchars($game['datecreated']); if (is_null($game['datecreated'])) { echo 'Unknown'; }?></div>
    <div class="Visited">Visited: <?php echo htmlspecialchars($visits); ?></div>
    <div>
      <div id="DescriptionLabel">Description:</div>
      <div id="Description" style="width:auto;"><?php echo filterText(htmlspecialchars($game['description'])); ?></div>
      </div>
            <div id="ReportAbuse">
        <div class="ReportAbusePanel">
          <center>
              <br>
            <span class="AbuseIcon"><a><img src="images/abuse.gif" border="0" alt="Report Abuse" border="0"></a></span>
            <span class="AbuseButton"><a>Report Abuse</a></span>
                      </center>
        </div>
      </div>
    </div>
    <div id="Details">
      <div id="Thumbnail_Place">
        <a title="<?php echo filterText(htmlspecialchars($game['name'])); ?>
" style="display:inline-block;cursor:pointer;">
<img src="/img/games/<?php echo $game['id']; ?>.png" width="418" height="228" style="border: 1px solid black" alt="<?php echo filterText(htmlspecialchars($game['name'])); ?>">
</a>
      </div>
      <div id="Actions_Place" style="width: 408px;">
<a href="#">Favorite</a>
              </div>
            <div class="PlayGames">
        <div style="text-align: center; margin: 1em 5px;">
                    <span style="display:inline;"><img src="images/public.png" style="border-width:0px;">&nbsp;Public</span>
                    <img src="images/CopyLocked.png" style="border-width:0px;"> Copy Protection: CopyLocked
                  </div>
        <div>
          <div style="display: inline; width: 10px; ">
            <!--a href="/uriostooold.php"><p style="color: grey;">Play button doesn't work?</p></a-->
				<input type="image" class="ImageButton" src="images/Play.png" alt="Visit Online" onclick="JoinGame()"> <?php if($creator['id'] == $_USER['id']) { ?><br><input type="image" class="ImageButton" src="images/stopbutton.png" alt="Stop Game" style="margin-top: 5px" onclick="StopGame()"><?php } ?>

                     </div>
        </div>
      </div>
      <div style="clear: both;"></div></div>

<div style="margin: 10px; width: 703px;">
      <div class="ajax__tab_xp ajax__tab_container ajax__tab_default" id="TabbedInfo">
<?php echo '<div id="TabbedInfo_header" class="ajax__tab_header">
    <span id="__tab_TabbedInfo_CommentaryTab" class="ajax__tab ajax__tab_active">
        <a class="" id="__tab_TabbedInfo_CommentaryLink" href="#" style="text-decoration:none;">
            <h3>Commentary</h3>
        </a>
    </span>
</div>
'; ?>

        <div id="TabbedInfo_body" class="ajax__tab_body">
                    <div id="TabbedInfo_CommentaryTab" class="ajax__tab_panel">
            <div id="TabbedInfo_CommentaryTab_CommentsPane_CommentsUpdatePanel">
              <h3 style="float:left">Comments (16)</h3>
              <div class="CommentsContainer">
                                <div class="HeaderPager">
                                    <span>Page 1 of 2</span>
                                    <a href="?id=38&amp;page=2">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
                                  </div>
                                <div class="Comments">
                                    <div class="Comment">
                    <div class="Commenter">
                      <div class="Avatar">
                        <a title="Jazzy" href="/User.aspx?ID=9822" style="display:inline-block;height:64px;width:64px;cursor:pointer;">
                        <img style="width:64px;height:64px;" src="" border="0" id="img" alt="You">
                        </a>
                      </div>
                    </div>
                    <div class="Post">
                      <div class="Audit">
                        Posted
                        69 years ago
                        by
                        <a href="/User.aspx?ID=9822">You</a>
                      </div>
                      <div class="Content">Epic test comment</div>
                      <div class="Actions">
                        <div class="ReportAbusePanel">
                          <span class="AbuseIcon"><a href=""><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
                          <span class="AbuseButton"><a href="">Report Abuse</a></span>
                                                  </div>
                      </div>
                    </div>
                    <div style="clear: both;"></div>
                  </div>

                                  </div>
                                <div class="FooterPager">
                                    <span>Page 1 of 2</span>
                                    <a href="?id=38&amp;page=2">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
                                  </div>
                              </div>
            </div>
          </div>
                  </div>
      </div>
    </div>      

  

<script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
<div style="clear: both;"></div>
      </div></div></div></div>


</div>