<?php

require_once("config.php");

ob_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

    <head>
      <title>
        <?=$title?>
      </title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link id="ctl00_Imports" rel="stylesheet" type="text/css" href="/CSS/AllCSS.css" />
      <link rel="stylesheet" type="text/css" href="CSS/Tabs.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <link id="ctl00_Favicon" rel="Shortcut Icon" type="image/ico" href="<?php echo $siteurl; ?>/favicon.ico" />
      <meta name="author" content="<?=$sitename?> Corporation" />
      <meta name="keywords" content="game, video game, building game, construction game, online game, LEGO game, LEGO, MMO, MMORPG, virtual world, avatar chat" />
      <meta name="robots" content="all" />
      <script src="https://pagead2.googlesyndication.com/pagead/managed/js/adsense/m202312070101/show_ads_impl_fy2021.js" id="google_shimpl"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="JS/Tabs.js" type="text/javascript"></script>
		<script src="/JS/MicrosoftAjax.js" type="text/javascript"></script>
		<script src="/resources/PlaceLauncher/ProtocolCheck.js?t=1703449038" type="text/javascript"></script>
		<script src="/resources/PlaceLauncher/PlaceLauncher.js?t=1703449038" type="text/javascript"></script>
		<script data-ad-client="ca-pub-9428704937125405" async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" type="text/javascript" data-checked-head="true"></script>
	<meta http-equiv="origin-trial" content="As0hBNJ8h++fNYlkq8cTye2qDLyom8NddByiVytXGGD0YVE+2CEuTCpqXMDxdhOMILKoaiaYifwEvCRlJ/9GcQ8AAAB8eyJvcmlnaW4iOiJodHRwczovL2RvdWJsZWNsaWNrLm5ldDo0NDMiLCJmZWF0dXJlIjoiV2ViVmlld1hSZXF1ZXN0ZWRXaXRoRGVwcmVjYXRpb24iLCJleHBpcnkiOjE3MTk1MzI3OTksImlzU3ViZG9tYWluIjp0cnVlfQ=="><meta http-equiv="origin-trial" content="AgRYsXo24ypxC89CJanC+JgEmraCCBebKl8ZmG7Tj5oJNx0cmH0NtNRZs3NB5ubhpbX/bIt7l2zJOSyO64NGmwMAAACCeyJvcmlnaW4iOiJodHRwczovL2dvb2dsZXN5bmRpY2F0aW9uLmNvbTo0NDMiLCJmZWF0dXJlIjoiV2ViVmlld1hSZXF1ZXN0ZWRXaXRoRGVwcmVjYXRpb24iLCJleHBpcnkiOjE3MTk1MzI3OTksImlzU3ViZG9tYWluIjp0cnVlfQ=="><meta http-equiv="origin-trial" content="A/ERL66fN363FkXxgDc6F1+ucRUkAhjEca9W3la6xaLnD2Y1lABsqmdaJmPNaUKPKVBRpyMKEhXYl7rSvrQw+AkAAACNeyJvcmlnaW4iOiJodHRwczovL2RvdWJsZWNsaWNrLm5ldDo0NDMiLCJmZWF0dXJlIjoiRmxlZGdlQmlkZGluZ0FuZEF1Y3Rpb25TZXJ2ZXIiLCJleHBpcnkiOjE3MTkzNTk5OTksImlzU3ViZG9tYWluIjp0cnVlLCJpc1RoaXJkUGFydHkiOnRydWV9"><meta http-equiv="origin-trial" content="A6OdGH3fVf4eKRDbXb4thXA4InNqDJDRhZ8U533U/roYjp4Yau0T3YSuc63vmAs/8ga1cD0E3A7LEq6AXk1uXgsAAACTeyJvcmlnaW4iOiJodHRwczovL2dvb2dsZXN5bmRpY2F0aW9uLmNvbTo0NDMiLCJmZWF0dXJlIjoiRmxlZGdlQmlkZGluZ0FuZEF1Y3Rpb25TZXJ2ZXIiLCJleHBpcnkiOjE3MTkzNTk5OTksImlzU3ViZG9tYWluIjp0cnVlLCJpc1RoaXJkUGFydHkiOnRydWV9">
    </head>

    <body>
      <div id="Container">
		<div id="AdvertisingLeaderboard">
  			<center>
  				<div style="border: solid 1px #000;width:728px;position:relative;font-family: Comic Sans MS;">
					<a href="#" title="click to report an offensive ad" onclick="alert('Soon')" style="position:absolute;background-color:#EEE;border:solid 1px #000;color:blue;font-size:10px;font-weight:lighter;bottom:0;right:0">
                        [ report ]
                    </a>
    				<img src="https://media.discordapp.net/attachments/1200146784694046841/1201176676944584734/gtestad.png?ex=65c8ddf4&is=65b668f4&hm=b486f05acf014f065b1145210a65687602b671f73bfedd015f0263272c29aee3&=&format=webp&quality=lossless">
				</div>
			</center>
		</div>
		<div id="Header">
					<div id="Banner">
						<div id="Options">
						<?php if($loggedin){ ?>
							<div id="Authentication">
								<span>Logged in as <?=$_USER['username']?>&nbsp;<strong>|</strong>&nbsp;<a href="/Logout.aspx">Logout</a></span>
							</div><?php } else { ?> 
							
							<div id="Authentication">
              <a href="/Login/Default.aspx">Login</a>                            </div>
							
							<?php } if($loggedin){ ?>
							<div id="Settings">
								<span>Age: 13+, Safety Mode: Filter</span>
							</div><?php } ?>
						</div>
						<div id="Logo">
							<a title="<?=$sitename?>" href="/" style="display:inline-block;cursor:pointer;">
								<img src="/images/madbloxlogo.png" alt="<?=$sitename?>" blankurl="http://t2.roblox.com:80/blank-267x70.gif" border="0">
							</a>
						</div>
						<?php if($loggedin){ ?>
						<div id="Alerts" style="position:relative;">
							<table style="position: absolute; height: 101%; right: 0;">
								<tbody><tr>
									<td valign="middle">
										<div>
											<div id="AlertSpace">
												<div>
													<div id="TicketsAlert">
														<a class="TicketsAlertIcon" href="/my/accountbalance"><img src="/images/Tickets.png" style="border-width:0px;"></a>&nbsp;
														<a class="TicketsAlertCaption" href="/my/accountbalance">110 Tickets</a>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody></table>
						</div><?php } ?>
						<?php if(!$loggedin){ ?>
						<div style="float: right; height: 72px; width: 287px;">
							<table style="width:100%;height:100%">
								<tbody>
									<tr>
										<td valign="middle">
											<a class="SignUpAndPlay" href="/Login/NewAge.aspx">
												<img src="/images/SignupBannerV2.png" alt="Sign-up and Play!" border="0">
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<?php } ?>
					</div>
					<div class="Navigation">
						<span><a class="MenuItem" href="/User.aspx">My <?=$sitename?></a></span>
						<span class="Separator">&nbsp;|&nbsp;</span>
						<span><a class="MenuItem" href="/Games.aspx">Games</a></span>
						<span class="Separator">&nbsp;|&nbsp;</span>
						<span><a class="MenuItem" href="/Catalog.aspx">Catalog</a></span>
						<span class="Separator">&nbsp;|&nbsp;</span>
						<span><a class="MenuItem" href="/Browse.aspx">People</a></span>
						<span class="Separator">&nbsp;|&nbsp;</span>
						<span><a class="MenuItem" href="/Upgrades/BuildersClub.aspx">Builders Club</a></span>
						<span class="Separator">&nbsp;|&nbsp;</span>
						<span><a class="MenuItem" href="/Forum/Default.aspx">Forum</a></span>
						<span class="Separator">&nbsp;|&nbsp;</span>
						<span><a class="MenuItem" href="#">News</a>&nbsp;<a id="NewsFeed" href="#"><img src="/images/feed-icon-14x14.png" alt="RSS" border="0"></a></span>
		                <span class="Separator">&nbsp;|&nbsp;</span>
		                <span><a class="MenuItem" href="#">Help</a></span>
					</div>
					<div class="SystemAlert">
						<div class="SystemAlertText" style="background-color: #ff0000">
							<div class="Exclamation">
							</div>
							<div>Beta MADBLOX website, only authorized users to see.</div>
						</div>
					</div>
				</div>