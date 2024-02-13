<?php
require($_SERVER["DOCUMENT_ROOT"]."/main/nav.php");
$searched = $_POST["search"] ?? null;
?>
<div id="Body">


    <div id="ctl00_cphRoblox_Panel1">
        <div id="BrowseContainer" style="text-align:center">
            <div><form action="" method="POST">
<div id="SearchBar" class="SearchBar">
			<span class="SearchBox"><input name="search" type="text" maxlength="100" id="ctl00_cphRoblox_SearchTextBox" class="TextBox" value="<?=htmlspecialchars($searched);?>"></span>
			<span class="SearchButton"><input type="submit" name="ctl00$cphRoblox$SearchButton" value="Search" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions('ctl00$cphRoblox$SearchButton', '', true, '', '', false, false))" id="ctl00_cphRoblox_SearchButton"></span>
			<span class="SearchLinks"><sup><a id="ctl00_cphRoblox_ResetSearchButton" href="/Browse.aspx">Reset</a>&nbsp;|&nbsp;</sup><a href="#" class="tips"><sup>Tips</sup>
			<span>Exact Phrase: "red brick"<br>
			Find ALL Terms: red and brick =OR=  red + brick<br>
			Find ANY Term: red or brick =OR= red | brick<br>
			Wildcard Suffix: tel* (Finds teleport, telamon, telephone, etc.)<br>
			Terms Near each other: red near brick =OR= red ~ brick<br>
			Excluding Terms: red and not brick =OR= red - brick<br>
			Grouping operations: brick and (red or blue) =OR= brick + (red | blue)<br>
			Combinations: "red brick" and not (tele* or tower) =OR= "red brick" - (tele* | tower)<br>
			Wildcard Prefix is NOT supported: *port will not find teleport, airport, etc.
			</span></a>
			</span> 
		</div>
</form>

                <table class="Grid" cellspacing="0" cellpadding="4" border="0" style="border-collapse:collapse;">
                    <tbody>
                        <tr class="GridHeader">
                            <th scope="col">Avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Location / Last Seen</th>
                        </tr>
                        <?php
                        $a = $db->prepare("SELECT * FROM users");
                        $a->execute();
                        
                        foreach($a as $user){
                        ?>
                        <tr class="GridItem">
          <td>
          	<a title="aaaagoodgames" href="/User.aspx?ID=9866" style="display:inline-block;height:48px;width:48px;cursor:pointer;"><img style="height:48px;width:48px" src="http://goodblox.xyz/goodblox/images/render/avatar/9866-small.png" border="0" id="img" alt="aaaagoodgames"></a>
          </td>
          <td style="word-break: break-all;">
            <a href="/User.aspx?ID=<?=$user['id']?>"><?=$user['username']?></a><br>
            <span><?=$user['blurb']?></span>
          </td>
          <?php 
           $onlinetext = ($user['lastseen'] + 300 >= time()) ? "<span class=\"UserOnlineStatus\">Online</span>" : "<span class=\"UserOfflineStatus\">Offline</span>";
           echo "
<td><span>$onlinetext";
$onlinetext2 = ($user['lastseen'] + 300 >= time()) ? "<span class=\"UserOnlineStatus\">Website</span>" : "<span class=\"UserOfflineStatus\">".date('d/m/Y g:i A', $user["lastseen"])."</span>";
           echo "</span><br></td>
<td><span>$onlinetext2</span></td>
</tr>";
          ?>
        </tr>
                        <?php } ?>
               
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/main/footer.php");
?>