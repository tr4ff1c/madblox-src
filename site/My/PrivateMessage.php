<?php
if(isset($_REQUEST['MessageID'])){
    header("location: Message.aspx?MessageID=".$_REQUEST['MessageID']);
    die();
    exit;
}
require ("../core/head.php");

require_once $_SERVER["DOCUMENT_ROOT"]."/ReCaptcha.php";


$uid = $_GET['RecipientID'] ?? 0;
$uid = intval($uid);

$replyto = $_GET['replyto'] ?? 0;
$replyto = intval($replyto);

$userq = $db->prepare("SELECT * FROM users WHERE id=:uid");
$userq->bindParam(':uid', $uid);
$userq->execute();
$user = $userq->fetch(PDO::FETCH_ASSOC);

if (($userq->rowCount() < 1) || ($uid == $_USER['id'])) {
  die("<script>document.location = \"/users/\"</script>");
}

$reply = false;

if ($replyto != 0) {
  $mq = $db->prepare("SELECT * FROM messages WHERE user_from=:uid AND user_to=:user_id AND id=:replyto");
  $mq->bindParam(':uid', $uid);
  $mq->bindParam(':user_id', $_USER['id']);
  $mq->bindParam(':replyto', $replyto);
  $mq->execute();

  if ($mq->rowCount() != 0) {
    $reply = true;
    $reply_msg = $mq->fetch(PDO::FETCH_ASSOC);
  }
}

?>

<script>
  function SubmitForm(token) {
    document.getElementById("msgform").submit();
  }
</script>
 <div id="Body">
                <div class="MessageContainer">
  <div id="MessagePane" >
      <?php
      
if (isset($_POST['subject'])) {
	// empty response
	$response = null;

	if (isset($_POST["g-recaptcha-response"])) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	}
	if ($response != null && $response->success) {
	  $captcha_completed = true;
	} else {
	  $captcha_completed = false;
	}
	if(!$captcha_completed) {
		exit("Please complete the captcha first.");
	} else {
		$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
		$message = filter_var(nl2br($_POST['message']), FILTER_SANITIZE_STRING);

		$currenttimelol = time();

		$stmt = $db->prepare("INSERT IGNORE INTO `messages` (`id`, `user_from`, `user_to`, `subject`, `content`, `datesent`) VALUES (NULL, :user_from, :user_to, :subject, :content, :datesent)");
		$stmt->bindValue(':user_from', $_USER['id']);
		$stmt->bindValue(':user_to', $uid);
		$stmt->bindValue(':subject', $subject);
		$stmt->bindValue(':content', $message);
		$stmt->bindValue(':datesent', $currenttimelol);
		$stmt->execute();
		header('location: /User.aspx?ID='.$uid);
		exit;
	}
}
?>

  <form method="post" id='msgform'>
    <h3>Your Message</h3>
    <div id="MessageEditorContainer">  
      <div class="MessageEditor">
        <table width="100%" style="font-size: 12px;">
          <tbody><tr valign="top">
            <td style="width:12em">
              <div id="From">
                <span class="Label">
                <span id="MsgFrom">From:</span></span> <span class="Field">
                <span id="MsgAuthor"><?php echo htmlspecialchars($_USER['username']); ?></span></span>
              </div>
              <div id="To">
                <span class="Label">
                <span id="MsgTo">Send To:</span></span> <span class="Field">
                <span id="MsgRecipient"><?php echo htmlspecialchars($user['username']); ?></span></span>
              </div>
              
            </td>
            <td style="padding:0 24px 6px 12px">
              <div id="Subject">
                <div class="Label">
                  <label id="MsgSubjectText">Subject:</label>
                </div>
                <div class="Field">
                  <input name="subject" type="text" id="MsgSubject" class="TextBox" style="width:100%;" value="<?php if($reply) {echo "RE: ".filterText(htmlspecialchars($reply_msg["subject"]));} ?>">
                </div>
              </div>
              <div class="Body">
                <div class="Label">
                  <label id="MsgBodyTitle">Message:</label></div>
                <textarea name="message" rows="2" cols="20" id="MsgBody" class="MultilineTextBox" style="width:100%;"></textarea>
              </div>
              <div class="g-recaptcha" data-sitekey="6LfFlMwmAAAAAOzXyNS0urpsP756kM0FUKGY9Fxy"></div>
              <script src="https://www.google.com/recaptcha/api.js" async defer></script>
			 </td>
          </tr>
        </tbody></table>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="Buttons">                
      <input name="sd" data-callback='SubmitForm' value="Send" id="Send" class="Button" type="submit">
          </div>
  </form></div>
  <div style="clear: both;"></div>
  
</div>
            </div>
<?php
require ("../inc/footer.php");
?>