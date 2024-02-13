
<div id="Body">
<div id="UserContainer">
	<div id="LeftBank">
		<div id="ProfilePane">
			<table width="100%" bgcolor="lightsteelblue" cellpadding="6" cellspacing="0">
				<tbody>
					<tr>
						<td>
														<font face="Verdana" id="1"><span class="Title">Hi, <?=$_USER['username']?>!</span><br></font>
													</td>
					</tr>
					<tr>
						<td>
														<font face="Verdana" id="2">
								<span>Your <?=$sitename?>:</span><br>
								<a href="/User.aspx?ID=<?=$_USER['id']?>">https://mlgblox.xyz/User.aspx?ID=<?=$_USER['id']?></a>
								<br>
								<br>
								<div style="left: 0px; float: left; position: relative; top: 0px;margin-top:67px;margin-left:10px">
									<a disabled="disabled" title="<?=$_USER['username']?>" onclick="return false" style="display:inline-block;height:220px;width:180px;">
										<img src="/img/user/<?=$_USER['id']?>.png" border="0" style="height:200px;width:180px;" id="img" alt="<?=$_USER['username']?>">
									</a>
									<br>
								</div>
								<div style="float:right;text-align:left;width:210px;">
									<font face="Verdana" id="3">
									<p><a href="/My/Messages/Inbox">Inbox</a>&nbsp;</p>
									<p><a href="/My/Character">Change Character</a></p>
									<p><a href="/My/Profile.aspx">Edit Profile</a></p>
									<p><a href="/Upgrades/BuildersClub.aspx">Account Upgrades</a>&nbsp;</p>
									<p><a href="/My/AccountBalance">Account Balance</a></p>
									<p><a href="/User.aspx?ID=<?=$_USER['id']?>">View Public Profile</a></p>
									<p>
																				<a href="/games/create">Create New Place</a> 
																				<br>
										(1 Remaining)
									</p>
									<p><a href="/my/InviteAFriend.aspx">Share <?=$sitename?></a></p>
									<p><a href="/Upgrades/Goldbux.aspx">Buy MADBUX</a></p>
									<p><a href="/my/accountbalance/trade">Trade Currency</a></p>
									<p><a href="/my/AdInventory.aspx">Ad Inventory</a></p>
									<p><a href="/info/TermsOfService.aspx">Terms, Conditions, and Rules</a></p>
									</font>
								</div>
							</font>
													</td>
					</tr>
				</tbody>
			</table>
								</div>
				<div id="UserPageLargeRectangleAd">
			<div id="RobloxLargeRectangleAd">
							</div>
		</div>
				<div id="UserBadgesPane">
			<div id="UserBadges">
				<h4><a href="/Badges.aspx">Badges</a></h4>
				<table cellspacing="0" border="0" align="Center">
					<tbody>
					<tr>              <td></td><td><div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/beta.png" width="75" height="75" title="This badge is given to beta members on the site." alt="beta-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges.aspx">SHIT</a>
                </div>
              </div>
			  </div></td>
      <td>					</td></tr></tbody>
				</table>
			</div>
		</div>
		<div id="UserStatisticsPane">
			<div id="UserStatistics">
				<div id="StatisticsPanel" style="transition: height 0.5s ease-out; overflow: hidden; height: 200px;">
					<h4>Statistics</h4>			
					<div style="margin: 10px 10px 150px 10px;" id="Results">
						<div class="Statistic">
							<div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
												<div class="Statistic">
							<div class="Label"><acronym title="The number of posts this user has made to the GOLDBLOX forum.">Forum Posts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
							<div class="Value"><span>0 (last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's models have been viewed - unfinished.">Model Views</acronym>:</div>
							<div class="Value"><span>TODO</span></div>
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
					<p style="padding: 10px 10px 10px 10px;">You doesn't have any <?=$sitename?> places.</p>       </div>		<div id="FriendsPane">
			<div id="Friends">
			                    <h4>My friends <a href="/Friends.aspx?UserID=6">See all 0></a>
                          (<a href="/my/EditFriends.aspx">Edit</a>)
            </h4>          
            <table cellspacing="0" align="Center" border="0" style="border-collapse:collapse;width: 360px;">
          <tbody><tr></tr>
					<tr>
										</tr>
										
				</tbody></table>
							</div>
							
		</div>
		<div id="FavoritesPane">
			<div id="Favorites">
				<h4>Favorites</h4>
				<div id="FavoritesContent">You should retire NOW!</div>
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
		
		<div id="FriendRequestsPane">
    <div id="FriendRequests">
      <span id="FriendRequestsHeaderLabel"><h4>My Friend Requests</h4></span>

                                               <table cellspacing="0" border="0" style="border-collapse:collapse;">
        <tbody><tr>
           
      </tr>
      </tbody></table>
    </div>
  </div>
    </div>
  </div>
			

				</div>
<style>
#ProfilePane {
    background: #aec0d9;
}
#UserPlaces h4 {
    background-color: #6e99c9;
    color: #fff;
    font-family: Verdana,Sans-Serif;
    font-size: 1.4em;
    font-weight: 400;
    letter-spacing: .1em;
    line-height: 1.5em;
    margin: 0;
}
#UserAssetsPane #UserAssets h4, #UserBadgesPane #UserBadges h4, #UserStatisticsPane #UserStatistics h4, #FavoritesPane #Favorites h4 {
    background-color: #ccc;
    border-bottom: solid 1px #000;
    color: #333;
    font-family: Comic Sans MS,Verdana,Sans-Serif;
    margin: 0;
    text-align: center;
}
#FriendsPane, #FavoritesPane {
    clear: right;
    margin: 10px 0 0;
    background: #fff;
}
#FavoritesPane{
    color: #000;
	border: solid 1px #000;
}
#FavoritesContent {
    background: #eee;
}
#UserPlaces .PanelFooter, #Favorites .PanelFooter {
    background-color: #fff;
    border-top: solid 1px #000;
    color: #333;
    font-family: Verdana,Sans-Serif;
    margin: 0;
    padding: 3px;
    text-align: center;
}
</style>
<style>
.modalBackground {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(100,100,100,0.25);
	opacity: 1;
}
.modalPopup {
    color: black;
    background-color: #ffffdd;
    border-width: 3px;
    border-style: solid;
    border-color: Gray;
    padding: 3px;
    box-shadow: 5px 5px;
    text-align: center;
    width: 27em;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}
</style>