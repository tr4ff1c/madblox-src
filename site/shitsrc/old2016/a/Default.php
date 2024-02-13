<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');

$thing = "/Login/NewAge.aspx";
if($loggedin == "yes"){
    $thing = "/Install/Default.aspx";
}
?>
<div id="Body">
					
    
	<div id="SplashContainer">
		<div id="SignInPane">
			
<div id="LoginViewContainer">
	
			<div id="LoginView">
				<?php if($loggedin == 'yes') { ?><h5>Logged In</h5>
  <div id="AlreadySignedIn">
          <a title="<?=$_USER['username']?>" href="/User.aspx" style="display:inline-block;height:190px;width:152px;cursor:pointer;"><img src="/img/user/<?=$_USER['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" style="display:inline-block;width:145px;margin-top:15px;" border="0" id="img" alt="<?=$_USER['username']?>"></a>
        <?php } else { ?><h5>Member Login</h5>
				
<div class="AspNet-Login">
            <div class="AspNet-Login"><form method="POST" action="/Login/Default.aspx">
              <div class="AspNet-Login-UserPanel">
                <label for="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserName" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserNameLabel" class="Label">Character Name</label>
                <input name="UserName" type="text" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserName" tabindex="1" class="Text">
              </div>
              <div class="AspNet-Login-PasswordPanel">
                <label for="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Password" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_PasswordLabel" class="Label">Password</label>
                <input name="Password" type="password" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Password" tabindex="2" class="Text">
              </div>
							<div class="AspNet-Login-SubmitPanel">
								<button type="submit" name="lb" tabindex="4" type="submit" class="Button">Login</button>
							</div>
							<div class="AspNet-Login-PasswordRecoveryPanel">
								<a id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_hlPasswordRecovery" tabindex="5" href="Login/ResetPasswordRequest.aspx">Forgot your password?</a>
							</div>
						</div> <?php } ?>
					
</div>
			</div>
		
</div>

			<br>
            
				    <div id="Figure">
				        <a id="ctl00_cphRoblox_LoginView1_ImageFigure" disabled="disabled" title="Figure" onclick="return false" style="display:inline-block;"><img src="/images/NewFrontPageGuy.png" border="0" alt="Figure" blankurl="http://t1.roblox.com:80/blank-115x130.gif"></a>
				    </div>
			    
		</div>
		
		        

<div id="RobloxAtAGlance">
	<h2><?=$sitename?> Virtual Playworld</h2>
	<h3><?=$sitename?> is Free!</h3>
	<ul id="ThingsToDo">
		<li id="Point1">
			<h3>Build your personal Place</h3>
			<div>Create buildings, vehicles, scenery, and traps with thousands of virtual bricks.</div>
		</li>
		<li id="Point2">
			<h3>Meet new friends online</h3>
			<div>Visit your friend's place, chat in 3D, and build together.</div>
		</li>
		<li id="Point3">
			<h3>Battle in the Brick Arenas</h3>
			<div>Play with the slingshot, rocket, or other brick battle tools.  Be careful not to get "bloxxed".</div>
		</li>
	</ul>
	<div id="Showcase" style="margin-right: 10px;">
        <iframe id="embedplayer" src="https://web.archive.org/web/20231216125426if_/http://www.bitview.net/embed?v=j2BeacZsxMU" width="400" height="326" allowfullscreen="" scrolling="off" frameborder="0" data-ruffle-polyfilled=""></iframe>
        <br><br>
      </div>
	<div id="Install">
		<div id="CompatibilityNote">Works with your<br>Windows PC!</div>
		<div id="DownloadAndPlay"><a id="ctl00_cphRoblox_RobloxAtAGlanceLoginView_RobloxAtAGlance_Anonymous_hlDownloadAndPlay" href="<?=$thing?>"><img src="/images/DownloadAndPlay.png" alt="FREE - Download and Play!" border="0"></a></div>
	</div>
	<div id="ForParents">
		<a id="ctl00_cphRoblox_RobloxAtAGlanceLoginView_RobloxAtAGlance_Anonymous_hlKidSafe" title="ROBLOX is kid-safe!" href="Parents.aspx" style="display:inline-block;"><img title="<?=$sitename?> is not kid-safe!" src="/images/GamerSeal.png" border="0"></a>
	</div>
</div>
		    
		
<div id="UserPlacesPane">
	<div id="UserPlaces_Content">
		<table id="ctl00_cphRoblox_CoolPlaces_CoolPlacesDataList" cellspacing="0" border="0" width="100%">
	<tbody><tr>
		<td class="UserPlace">
				<a id="ctl00_cphRoblox_CoolPlaces_CoolPlacesDataList_ctl00_rbxContentImage" title="Can you survive a Flash Flood?" href="/web/20080730072110/http://www.roblox.com/Item.aspx?ID=456398" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20080730072110im_/http://t3.roblox.com:80/b148bf915e11a6a0c1be22c6abcf032f" border="0" alt="Can you survive a Flash Flood?"></a>
			</td><td class="UserPlace">
				<a id="ctl00_cphRoblox_CoolPlaces_CoolPlacesDataList_ctl01_rbxContentImage" title="be a prisoner or a cop have a life in jail! fixed" href="/web/20080730072110/http://www.roblox.com/Item.aspx?ID=2170968" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20080730072110im_/http://t2.roblox.com:80/2c195ce28a2ea76a63789f48c1dbffbe" border="0" alt="be a prisoner or a cop have a life in jail! fixed"></a>
			</td><td class="UserPlace">
				<a id="ctl00_cphRoblox_CoolPlaces_CoolPlacesDataList_ctl02_rbxContentImage" title="Build your armor and weapons *roof* *60k visits*" href="/web/20080730072110/http://www.roblox.com/Item.aspx?ID=1801900" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20080730072110im_/http://t1.roblox.com:80/7634d01d337887186b3af2227d618ab5" border="0" alt="Build your armor and weapons *roof* *60k visits*"></a>
			</td><td class="UserPlace">
				<a id="ctl00_cphRoblox_CoolPlaces_CoolPlacesDataList_ctl03_rbxContentImage" title="Avatar: Air Nomad Legends" href="/web/20080730072110/http://www.roblox.com/Item.aspx?ID=199135" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20080730072110im_/http://t1.roblox.com:80/3ae17c671f5c0bf901a27e648f9b23af" border="0" alt="Avatar: Air Nomad Legends"></a>
			</td><td class="UserPlace">
				<a id="ctl00_cphRoblox_CoolPlaces_CoolPlacesDataList_ctl04_rbxContentImage" title="✪Ultimate Paintball CTF" href="/web/20080730072110/http://www.roblox.com/Item.aspx?ID=47828" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20080730072110im_/http://t5.roblox.com:80/bf1fb219ebfeec2521a5a6fbc588a483" border="0" alt="✪Ultimate Paintball CTF"></a>
			</td>
	</tr>
</tbody></table>
	</div>
	<div id="UserPlaces_Header">
		<h3>Cool Places</h3>
		<p>Check out some of our favorite <?=$sitename?> places!</p>
	</div>
	<div id="ctl00_cphRoblox_CoolPlaces_ie6_peekaboo" style="clear: both"></div>
</div>
	</div>

				</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/core/footer.php'); ?>