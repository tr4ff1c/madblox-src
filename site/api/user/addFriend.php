<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');
if(!isset($_GET['userto'])){
    die("Wrong input for api request.");
    exit;
}

if($loggedin != "yes"){
    header("location: /Default.aspx");
    exit;
}

$id = filter_var($_GET["userto"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);
if($id == $_USER['id']){
    die("You cannot friend yourself.");
    exit;
}
$subject = htmlspecialchars($_POST['MsgSubject']);
$content = htmlspecialchars($_POST['MsgBody']);
$usrq = $db->prepare("SELECT * FROM users WHERE id=:id");
$usrq->execute([':id' => $id]);
$user = $usrq->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST"){
$searchusr = $db->prepare("SELECT * FROM users WHERE id=?");
$searchusr->execute([$id]);
$srusr = $searchusr->rowCount();
if($srusr > 0){
    $isfriendq = $db->prepare("SELECT * FROM friends WHERE user_to=? AND user_from=? OR user_to=? AND user_from=?");
    $isfriendq->execute([$id, $_USER['id'], $_USER['id'], $id]);
    $isfriend = $isfriendq->rowCount();
    if($isfriend < 1){
        $stmt = $db->prepare("INSERT IGNORE INTO friends (id, user_from, user_to, areFriends, timeAdded, subject, content) VALUES (NULL, :me, :him, '0', NOW(), :subject, :content)");
        $stmt->bindParam(':me', $_USER['id']);
        $stmt->bindParam(':him', $id);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
        die('<div id="Body">
					
	<div class="MessageContainer">
        <div id="MessagePane">
			<div id="ctl00_cphRoblox_pConfirmation">
				<div id="Confirmation">
					<h3>Message Sent</h3>
					<div id="Message"><span id="ctl00_cphRoblox_lConfirmationMessage">Your friend request has been sent to '.$user['username'].'.</span></div>
					<div class="Buttons"><a id="ctl00_cphRoblox_lbContinue" class="Button" href="/User.aspx?ID='.$user['id'].'">Continue</a></div>
				</div>
			
</div>
		</div>
		<div style="clear: both;"></div>
	</div>

				</div>');
    }else{
        die("Already friends or request already sent.");
    }
}else{
    die("User not found.");
}
}

?>
<div id="Body">
<div class="MessageContainer">
	<div id="AdsPane">
		<div class="Ads_WideSkyscraper">
					</div>
	</div>
	<div id="MessagePane">
		<form method="POST" action="">
			<h3>Your Friend Request</h3>
			<div id="MessageEditorContainer">  
				<div class="MessageEditor">
					<table width="100%">
						<tbody><tr valign="top">
							<td style="width:12em">
								<div id="From">
									<span class="Label">
										<span id="MsgFrom">From:</span>
									</span> 
									<span class="Field">
										<span id="MsgAuthor"><?=$_USER['username']?></span>
									</span>
								</div>
								<div id="To">
									<span class="Label">
										<span id="MsgTo">Send To:</span>
									</span> 
									<span class="Field">
										<span id="MsgRecipient"><?=$user['username']?></span>
									</span>
								</div>
															</td>
							<td style="padding:0 24px 6px 12px">
								<div id="Subject">
									<div class="Label">
										<label id="MsgSubjectText">Subject:</label>
									</div>
									<div class="Field">
										<input name="MsgSubject" type="text" id="MsgSubject" class="TextBox" style="width:100%;" value="Friend Request">
									</div>
								</div>
								<div class="Body">
									<div class="Label">
										<label id="MsgBodyTitle">Message:</label></div>
									<textarea name="MsgBody" rows="2" cols="20" id="MsgBody" class="MultilineTextBox" style="width:100%;"></textarea>
								</div> 
								
								<p style="font-size: medium; color: red"><b>Remember, <?=$sitename?> staff will never ask you for your password.<br>People who ask for your password are trying to steal your account.</b></p>
							</td>
						</tr>
					</tbody></table>
				</div>
				<div style="clear:both"></div>
			</div>
			<div class="Buttons">
				<input name="Send" value="Send" id="Send" class="Button" type="submit">
			</div>
		</form>
	</div>
	<div style="clear: both;"></div>
</div>
				</div>