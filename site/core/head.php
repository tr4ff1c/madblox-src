<?php
require_once("database.php");

ob_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if($loggedin == "yes"){
$uid = $_USER['id'];
  $rightnow = time();

  $q = $db->prepare("UPDATE users SET `lastseen` = :currenttime WHERE id=:id");
  $q->execute(array(":currenttime" => $rightnow, ":id" => $_USER['id']));


if ($_USER['next_tix_reward'] < time()) {
    $dailyreward = 25;
    $nextrew = time() + 86400;

    $q = $db->prepare("UPDATE users SET `tickets` = `tickets` + :dailyreward, `next_tix_reward` = :nextrew WHERE id=:id");
    $q->bindParam(':dailyreward', $dailyreward);
    $q->bindParam(':nextrew', $nextrew);
    $q->bindParam(':id', $_USER['id']);
    $q->execute();


    
  }


$_BANQ = $db->prepare("SELECT * FROM bans WHERE userid=:id");
$_BANQ->execute([':id' => $uid]);
$_BAN = $_BANQ->fetch(PDO::FETCH_ASSOC);
$banrows = $_BANQ->rowCount();

if($banrows > 0 && $_BAN['typeBan'] !== "None"){
$banned = true;
}

if($loggedin == "yes"){
$stmt = $db->prepare("SELECT COUNT(*) FROM messages WHERE readto = '0' AND user_to = :user_to");
$stmt->execute(['user_to' => $_USER['id']]);
$unreadmsg = $stmt->fetchColumn();
}


$sql = "SELECT COUNT(*) as count FROM skids WHERE resolved = :resolved";

$resolved = "no";

$stmt = $db->prepare($sql);
$stmt->bindParam(':resolved', $resolved, PDO::PARAM_STR);

$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['count'] > 0) {
    $issues = true;
} else {
    $issues = false;
}

}
  
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

    <head>
      <title>
        <?=$title?>
      </title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link id="ctl00_Imports" rel="stylesheet" type="text/css" href="/CSS/AllCSS.css" />
      <style>
      <?php echo $_THEMECSS; ?>
      </style>
      <link rel="stylesheet" type="text/css" href="CSS/Tabs.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <link id="ctl00_Favicon" rel="Shortcut Icon" type="image/png" href="/images/<?php echo $sitename; ?>small.png" />
      <meta name="author" content="<?=$sitename?> Corporation" />
      <meta name="keywords" content="game, video game, building game, construction game, online game, LEGO game, LEGO, MMO, MMORPG, virtual world, avatar chat" />
      <meta name="robots" content="all" />
      <script src="https://pagead2.googlesyndication.com/pagead/managed/js/adsense/m202312070101/show_ads_impl_fy2021.js" id="google_shimpl"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="JS/Tabs.js" type="text/javascript"></script>
		<script src="/JS/MicrosoftAjax.js" type="text/javascript"></script>
		<script src="/resources/PlaceLauncher/ProtocolCheck.js?t=1703449038" type="text/javascript"></script>
		<script src="/resources/PlaceLauncher/PlaceLauncher.js?t=1703449038" type="text/javascript"></script>
		<script data-ad-client="ca-pub-9428704937125405" async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" type="text/javascript" data-checked-head="true"></script>
	</head>

    <body>
      <div id="Container">
<?php include($_SERVER["DOCUMENT_ROOT"]."/images/Ads/getrandom.php"); ?><br>

<style>
@keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

        <div id="">
          <script type="text/javascript">
            <!--
            <
            h1 > oops < /h1>
            google_ad_client = "pub-2247123265392502";
            google_ad_width = 728;
            google_ad_height = 90;
            google_ad_format = "728x90_as";
            google_ad_type = "text_image";
            google_ad_channel = "";
            //-->
          </script>
          <script type="text/javascript" src="pagead/show_ads.js"></script>
        <?php if($securitydown == 'true'){?>
        <div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: orange">
            <div class="Exclamation">
            </div>
            <div id="sitealert1txt">Warning: Site is under security maintenance</div>
          </div>
        </div><br>
<?php } ?>
        </div>
        <?php
         if($testing == 'true'){?>
        <div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: orange">
            <div class="Exclamation">
            </div>
            <div id="sitealert1txt">Warning: Site is up for testing purposes</div>
          </div>
        </div><br>
<?php } ?>
<?php if($loggedin == "yes"){ if($issues == true){
if($_USER['USER_PERMISSIONS'] == "Administrator"){
?>
<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: red">
            <div class="Exclamation">
            </div>
            <div id="sitealert1txt">System Alert: Unresolved security issues. It is highly advised to <a href="/admi/security.aspx" class="Button">check!</a></div>
          </div>
        </div><br>
<?php } } } ?>
        <div id="Header">
          <div id="Banner">
            <div id="Options">
              <div id="Authentication">
  <?php if($loggedin == "yes"){ ?> Logged in as <?=htmlspecialchars($_USER['username'])?> &nbsp;<strong>|</strong>&nbsp;<a href="/api/LogoutRequest.aspx">Logout</a> <?php } else { ?> <a id="ctl00_BannerOptionsLoginView_BannerOptions_Anonymous_LoginHyperLink" href="/Login/Default.aspx">Login</a> <?php } ?>
              </div><?php if($loggedin == "yes"){ ?><div id="Settings">
              Age 13+, Chat Mode: Filter              </div><?php } ?>
            </div>
            <div id="Logo"><a id="ctl00_rbxImage_Logo" title="<?=$sitename?>" href="<?php echo $siteurl; ?>/" style="display:inline-block;cursor:pointer;"><img style="width:257px;height:67px;" src="<?=$sitelogo?>" border="0" id="img" alt="<?=$sitename?>" blankurl="http://t2.roblox.com:80/blank-267x70.gif" class="thebannerlogo"/></a>
            </div>
            <div id="Alerts">
              <table style="width:100%;height:100%">
                <tr>
                    <?php if($loggedin == "yes") { ?>
                  <td valign="middle">
                                        <table style="width:123%;height:101%;padding-right:20px;">
                <tbody><tr>
                  <td valign="middle">
          
                    <div>
                      <div id="AlertSpace" style="background-opacity: 0.5">
                      <?php if($_USER["mlgbux"] <= 0 || $_USER["tickets"] <= 0) { ?>
                        <img src="/images/debtmoji.png" style="position: absolute;width: 55px;margin-left: -135px;margin-top: -29px;">
                        <?php } ?>
                        <div>
                        <?php if($unreadmsg > 0){ ?>
                          
                          <div id="MessageAlert">
                              <a class="TicketsAlertIcon"><img src="/images/Message.gif" style="border-width:0px;"></a>&nbsp;
                              <a href="/My/Messages/Inbox.aspx" class="TicketsAlertCaption"><?=$unreadmsg?> New Messages!</a>
                            </div>
                          
                          <?php } ?>
                          <div id="RobuxAlert">
                            <a class="GoldbuxAlertIcon"><img src="/images/Robux.png" style="border-width:0px;"></a>&nbsp;
                            <a href="/my/accountbalance" class="GoldbuxAlertCaption"><?=$_USER['mlgbux']?> MADBUX</a>
						</div>
                          <div id="TicketsAlert">
                            <a class="TicketsAlertIcon"><img src="/images/Tickets.png" style="border-width:0px;"></a>&nbsp;
                            <a href="/my/accountbalance" class="TicketsAlertCaption"><?=$_USER['tickets']?> Tickets</a>
						</div> 
                  </div>
                      </div>
                    </div>
                  </td>
                      </tr>
                    </tbody></table>              
</td><?php } else { ?>
<td valign="middle">
            <a id="ctl00_rbxAlerts_SignupAndPlayHyperLink" class="SignUpAndPlay" href="/Login/NewAge.aspx"><img src="/images/SignupBannerV2.png" alt="Sign-up and Play!" border="0"></a>                          
</td>
<?php } ?>
                </tr>
              </table>
            </div>
          </div>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="Navigation">
         
            <span><a id="ctl00_hlMyRoblox" class="MenuItem<?php if($_SERVER["PHP_SELF"] === "/User.php") { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/User.aspx">My <?=$sitename?></a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlGames" class="MenuItem<?php if($_SERVER["PHP_SELF"] === "/games.php") { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/games.aspx">Games</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlCatalog" class="MenuItem<?php if($_SERVER["PHP_SELF"] === "/Catalog.php") { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/Catalog.aspx">Catalog</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlBrowse" class="MenuItem<?php if($_SERVER["PHP_SELF"] === "/Browse.php") { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/Browse.aspx">People</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlForum" class="MenuItem<?php if($_SERVER["PHP_SELF"] === "/BuildersClub.php") { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/BuildersClub.aspx">Builders Club</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
           
            <span><a id="ctl00_hlForum" class="MenuItem<?php if(str_starts_with($_SERVER["PHP_SELF"], "/Forum")) { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/Forum/Default.aspx">Forum</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlNews" class="MenuItem" href="<?php echo $siteurl; ?>/blog/index.aspx" target="_blank">News</a>&nbsp;<a id="ctl00_hlNewsFeed" href=""><img src="<?php echo $siteurl; ?>/images/feed-icon-14x14.png" border="0"/></a></span>
	    <span class="Separator">&nbsp;|&nbsp;</span>
	    <span><a id="ctl00_hlForum" class="MenuItem<?php if($_SERVER["PHP_SELF"] === "/Help.php") { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/Help.aspx">Help</a></span>
<?php if($_USER['USER_PERMISSIONS'] == "Administrator"){?>
<span class="Separator">&nbsp;|&nbsp;</span>
	    <span><a id="ctl00_hlForum" class="MenuItem<?php if(str_starts_with($_SERVER["PHP_SELF"], "/admi")) { echo " navbarSelected"; } ?>" href="<?php echo $siteurl; ?>/admi">Admin (N/A)</a></span>
<?php } ?>            
</div></div>
<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/alerts.php");
if($loggedin === "yes" && $_USER["id"] !== 68) {/*
?>
<center>
<h3>Security inspection is in process...</h3>
<p>You can use the site like normal. Do not mention it in the Discord server or anywhere else.</p>
</center>
<?php*/
}
?>

<?php if($banned == true){

$timestampdr = $_BAN['bandate'];
        $reviewed = $timestampdr;

if($_BAN['typeBan'] == "deleted"){
}else{
}

?>
<div id="Body">
                    
    
    <div style="margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;">
        <h2>
            <?php if($_BAN['typeBan'] == 'reminder') {echo 'Reminder';} elseif($_BAN['typeBan'] == 'warning') {echo 'Warning';} elseif($_BAN['typeBan'] == 'deleted') {echo 'Account Deleted';} elseif($_BAN['typeBan'] == '1day') {echo 'Banned for 1 day';} elseif($_BAN['typeBan'] == '3days') {echo 'Banned for 3 days';}  ?>
        </h2>
        <p>
            Our content monitors have determined that your behavior at <?=$sitename;?> has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.</p>
        
<p>
            Reviewed:<span style="font-weight: bold">
                <?=$reviewed?></span>
            
        </p>
<p>
            Moderator Note:<span style="font-weight: bold">
                <?=$_BAN['reason'];?></span>
            
        </p>
        <p>

            Please abide by the <a href=""><?=$sitename?> Community Guidelines</a> so that <?=$sitename?> can be fun for users of all ages.
        </p>
        
        
        <div id="ctl00_cphRoblox_Panel3">
    
            <?php if($_BAN['typeBan'] !== "deleted" ){ $timestamp = $_BAN['unbantime'];
        $unbanned_time = date('n/j/Y g:i:s A', $timestamp); ?> <p>
                Your account has been disabled for <?php if($_BAN['typeBan'] == '1day') {echo '1 day';}  if($_BAN['typeBan'] == '3days') {echo '3 days';} ?>. You may re-activate it after
                <span id="ctl00_cphRoblox_Label6"><?=$unbanned_time?></span><br>
            </p><?php } else { echo 'Your account has been terminated'; }?> <br>
<?php if($_BAN['typeBan'] == 'warning') {echo '<br>
<center>
<input type="checkbox" id="checker"> <span>I Agree</span>
<br>
<a href="/reactivate-account.aspx"><button id="sendbtn" disabled>Reactivate My Account</button></a>
<br> <script>
var checker = document.getElementById("checker");
 var sendbtn = document.getElementById("sendbtn");
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>
<br>
<a href="../logout.aspx"><button>Logout</button></a>
</center>';} ?>  </p>
    <?php if($_BAN['typeBan'] == 'reminder') {echo '<br>
<center>
<input type="checkbox" id="checker"> <span>I Agree</span>
<br>
<a href="/reactivate-account.aspx"><button id="sendbtn" disabled>Reactivate My Account</button></a>
<br> <script>
var checker = document.getElementById("checker");
 var sendbtn = document.getElementById("sendbtn");
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>
<br>
<a href="../logout.aspx"><button>Logout</button></a>
</center>';} ?>
    <?php if($_BAN['typeBan'] == '1day') {echo '<br>
<center>
'; if (($_BAN['unbantime'] <= time()) && ($_BAN['typeBan'] != 'deleted')) {
echo '
<input type="checkbox" id="checker"> <span>I Agree</span>
<br>'; } if (($_BAN['unbantime'] <= time()) && ($_BAN['typeBan'] != 'deleted')) {
echo'
<a href="/reactivate-account.aspx"><button id="sendbtn" disabled>Reactivate My Account</button></a>
<br> <script> 
var checker = document.getElementById("checker");
 var sendbtn = document.getElementById("sendbtn");
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>' ; } echo'
<a href="/logout.aspx"><button>Logout</button></a>
</center>'; } ?>

        
</div>
        <div id="ctl00_cphRoblox_UpdatePanel1">
    
                
            
</div>
    </div>

                </div>
<?php include("footer.php"); exit; } ?>