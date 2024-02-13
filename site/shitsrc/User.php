<?php

require_once("main/nav.php");

if(!isset($_GET['ID'])){
$id = 0;
} else {
$id = filter_var($_GET['ID'], FILTER_SANITIZE_NUMBER_INT);
}

$aa = $db->prepare("SELECT * FROM users WHERE id=?");
$aa->execute([$id]);
$a = $aa->fetch(PDO::FETCH_ASSOC);
$b = $aa->rowCount();
if($loggedin){
    if($b < 1){
        include("My/Home.php");
        exit;
    }
}else{
    if($b < 1){
        header("location: Browse.php");
        exit;
    }
}

?>
<div id="Body">
<div id="UserContainer">
    <div id="LeftBank">
      <div id="ProfilePane">
        
<table width="100%" bgcolor="lightsteelblue" cellpadding="6" cellspacing="0">
    <tbody><tr>
        <td>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserName" class="Title"><?=$a['username']?></span><br>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserOnlineStatus" class="UserOnlineMessage">[ Online ]</span>        </td>
    </tr>
    <tr>
        <td>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserRobloxURL"><?=$a['username']?>'s <?=$sitename?>:</span><br>
            <a id="ctl00_cphRoblox_rbxUserPane_hlUserRobloxURL" href="/User.aspx?ID=1">https://<?=$sitedomain?>/User.aspx?ID=1</a><br>
            <br>
            <table width="100%">
                <tbody><tr>
                    <td>
                        <a id="ctl00_cphRoblox_rbxUserPane_AvatarImage" disabled="disabled" title="<?=$a['username']?>" onclick="return false" style="display:inline-block;"><img src="/api/avatar/getthumb.php?id=1" height="200" border="0" alt="Avatar" blankurl="http://t0-cf.roblox.com/blank-150x200.gif"></a><br>
                        
                    </td>
                    <td>
                        
                        

<p></p>
<p></p>
<div class="ReportAbusePanel">
                                  </div>
              
                                            <p><span id="ctl00_cphRoblox_rbxUserPane_rbxPublicUser_lBlurb" style="word-break: break-word;"><?=$a['blurb']?></span></p>
                    </td>
                </tr>
<tr><td>

  <a href="1"><span class="AbuseIcon"><img src="/images/abuse.gif" alt="Report Abuse" border="0"></span></a>
                  <a href=""><span class="AbuseButton">Report Abuse</span></a></td></tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>
          

      </div>
         
      <div id="UserBadgesPane">
        
 
<div id="UserBadges">
  <h4><a id="ctl00_cphRoblox_rbxUserBadgesPane_hlHeader" href="/Badges.aspx">Badges</a></h4>
  <table id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges" cellspacing="0" align="Center" border="0">
    <tbody><tr><td></td></tr><tr>
caca
 
                      </div></td><td></td><td></td><td></td>
  </tr>
</tbody></table>

  
</div>
      </div>
      <div id="UserStatisticsPane" style="margin-bottom: 0px;">
      <div id="UserStatistics">
        <div id="StatisticsPanel" style="transition: height 0.5s ease-out; overflow: hidden; height: 200px;">
          <h4>Statistics</h4>      
          <div style="margin: 10px 10px 150px 10px;" id="Results">
            <div class="Statistic">
              <div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
                        <div class="Statistic">
              <div class="Label"><acronym title="The number of posts this user has made to the NOUNBLOX forum.">Forum Posts</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
            <div class="Statistic">
              <div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
            <div class="Statistic">
              <div class="Label"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
            <div class="Statistic">
              <div class="Label"><acronym title="The number of times this user's models have been viewed.">Model Views</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
            <div class="Statistic">
              <div class="Label"><acronym title="The number of times this user's character has destroyed another user's character in-game.">Knockouts</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
            <div class="Statistic">
              <div class="Label"><acronym title="The number of times this user's character has been destroyed in-game.">Wipeouts</acronym>:</div>
              <div class="Value"><span>0 (0 last week)</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
    <div id="RightBank">
      <div id="UserPlacesPane">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="/ajax.js" type="text/javascript"></script>
<script src="/ajaxcommon.js" type="text/javascript"></script>
<script src="/ajaxtimer.js" type="text/javascript"></script>
<script src="/ajaxanimations.js" type="text/javascript"></script>
<script src="/ajaxextenderbase.js" type="text/javascript"></script>
<script src="/accordian.js" type="text/javascript"></script>

<script>
Sys.Application.add_init(function() {
    $create(Sys.Extended.UI.AccordionBehavior, {"ClientStateFieldID":"AccordionExtender_ClientState","FramesPerSecond":40,"HeaderCssClass":"AccordionHeader","id":"ShowcasePlacesAccordion_AccordionExtender"}, null, null, $get("ShowcasePlacesAccordion")); 
}); 
</script>
        
<div id="UserPlaces">
			 <p style="padding:10px">This person doesn't have any <?=$sitename?> places.</p> 		</div>  
      
    

      
    
  

      </div>
      <div id="FriendsPane" style="background:white;">
        

<div id="Friends">
  <h4>rcc.service's Friends <a href="/Friends.aspx?UserID=1">See all 0</a></h4>    
  <div class="columns">


</div><div class="columns">


</div><div class="columns"></div><table id="ctl00_cphRoblox_rbxFriendsPane_dlFriends" cellspacing="0" align="Center" border="0">
  <tbody><tr>

  Can't fetch friend




</tr><tr></tr></tbody></table>

<style>
fix {
    display: table-cell;
    vertical-align: inherit;
}
</style>



  

  
</div>
      </div>
      <div id="FavoritesPane" style="margin-top: 10px; margin-bottom: 0px;">
      <div id="Favorites">
        <h4>Favorites</h4>
        <div id="FavoritesContent">
<table cellspacing="0" border="0" style="margin: auto;">
    <tbody>
        
      
      
      
            
      
      
      
    </tbody>
</table>

This user does not have any favorites for this type</div>
        <div class="PanelFooter">
          Category:&nbsp;
        <select id="FavCategories">
            
            <option value="7">Heads</option>
            <option value="8">Faces</option>
            <option value="2">T-Shirts</option>
            <option value="5">Shirts</option>
            <option value="6">Pants</option>
            <option value="1">Hats</option>
            <option value="4">Decals</option>
            <option value="3">Models</option>
            <option selected="selected" value="0">Places</option>
          </select>
             </div>
      </div>
    </div>



    </div>
    </div>
</font>
</div>