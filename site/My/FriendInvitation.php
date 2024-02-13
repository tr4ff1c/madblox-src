<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');
if($loggedin !== "yes"){
    header("location: /Login/NewAge.aspx");
    exit;
}
$id = filter_var($_GET["ID"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$findfr = $db->prepare("SELECT * FROM friends WHERE id=:idd AND user_to=:id AND areFriends=0 AND declined=0");
$findfr->execute(array(":id" => $_USER['id'], ":idd" => $id));
$ffr = $findfr->rowCount();

if($ffr < 1){
    header("location: /");
    exit;
}else{
    $fr = $findfr->fetch(PDO::FETCH_ASSOC);
    $dateTimeObject = new DateTime($fr['timeAdded']);
    $date = $dateTimeObject->format('n/j/Y g:i:s A');
    
    $userq = $db->prepare("SELECT * FROM users WHERE id=:id");
    $userq->execute([":id" => $fr['user_from']]);
    $user = $userq->fetch(PDO::FETCH_ASSOC);
    
    $subject = htmlspecialchars($fr['subject']);
}
?>
<div id="Body">
					
	<div id="InvitationContainer">
        <div id="InvitationPane">
			<div id="ctl00_cphRoblox_pFriendInvitation">
	
				<div id="ctl00_cphRoblox_pMessageReader">
		
					<h3>Friend Request</h3>
					<div class="MessageReaderContainer">
					    

<div id="Message">
    <table width="100%">
        <tbody><tr valign="top">
            <td style="width: 10em">
                <div id="DateSent"><?=$date?></div>
                <div id="Author">
                    
                    <a id="ctl00_cphRoblox_rbxMessageReader_Avatar" disabled="disabled" title="yea" onclick="return false" style="display:inline-block;height:64px;width:64px;"><img src="/img/user/<?=$user['id']?>.png?rand=<?=random_int(1,999999999999999999)?>" height="64" border="0" id="img" alt="yea"></a><br>
                    <a id="ctl00_cphRoblox_rbxMessageReader_AuthorHyperLink" title="Visit <?=$user['username']?>'s Home Page" href="../User.aspx?ID=<?=$user['id']?>"><?=$user['username']?></a>
                </div>
                <div id="Subject">
                    <?=$subject?><br>
                    <br>
                    <div id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
			
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseIconHyperLink" href="../AbuseReport/Message.aspx?ID=2274830&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fFriendInvitation.aspx%3fInvitationID%3d494536"><img src="../images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseTextHyperLink" href="../AbuseReport/Message.aspx?ID=2274830&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fFriendInvitation.aspx%3fInvitationID%3d494536">Report Abuse</a></span>

		</div>
                </div>
            </td>
            <td style="padding: 0 10px 0 10px">
                <div class="Body">
                    <div id="ctl00_cphRoblox_rbxMessageReader_pBody" class="MultilineTextBox" style="height:250px;overflow-y:scroll;width:455px;">
      
                       <?php echo htmlspecialchars(nl2br($fr['content'])); ?>                   
    </div> <p style="color:red;"><b>Remember, <?=$sitename;?> staff will never ask you for your <br>password.<br>
People who ask for your password are trying to steal <br>your account.
</b></p>
                </div>
                
            </td>
        </tr>
    </tbody></table>
</div>
					    <div style="clear:both"></div>
					</div>		
	</div>	
				<div id="ctl00_cphRoblox_pSubmit_ExistingInvitation">
					<div class="Buttons">
						<a id="ctl00_cphRoblox_lbCancel" class="Button" href="javascript:history.go(-1)">Cancel</a>
						<a id="ctl00_cphRoblox_lbDecline" class="Button" href="/api/user/DeclineFriendRequest.php?id=<?=$fr['id']?>">Decline</a>
						<a id="ctl00_cphRoblox_lbAccept" class="Button" href="/api/user/AcceptFriendRequest.php?id=<?=$fr['id']?>">Accept</a>
					</div>
	</div>		
</div>
		</div>
	</div>
				</div>