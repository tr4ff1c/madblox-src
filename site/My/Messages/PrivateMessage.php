<?php
require_once("../../core/head.php");
  
$MessageID = (int)$_GET['MessageID'] ?? 0;

$stmt = $db->prepare("SELECT * FROM messages WHERE id = :id");
$stmt->execute(['id' => $MessageID]);
$fpost = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fpost) {
  die("Invalid ID.");
}

if ($fpost['user_to'] != $_USER['id']) {
  die("This message wasn't sent to you.");
}

$stmt = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $fpost['user_from']]);
$fauthor = $stmt->fetch(PDO::FETCH_ASSOC);

$q = $db->prepare("UPDATE messages SET readto = 1 WHERE id = :id");
$q->bindParam(':id', $MessageID, PDO::PARAM_INT);
$q->execute();

?>
<div id="Body">
          
  <div class="MessageContainer">

        <div id="MessagePane">
      <div id="ctl00_cphRoblox_pPrivateMessage">
  
        <div id="ctl00_cphRoblox_pPrivateMessageReader">
    
          <h3>Private Message</h3>
          <div class="MessageReaderContainer">
              

<div id="Message">
    <table width="100%">
        <tbody><tr valign="top">
            <td style="width: 10em">
                <div id="DateSent"><?php echo date("m/d/Y", $fpost['datesent']); echo " "; echo date("g:i A", $fpost['datesent']) ?></div>
                <div id="Author">
                    
                    <a id="ctl00_cphRoblox_rbxMessageReader_Avatar" disabled="disabled" title="<?php echo htmlspecialchars($fauthor['username']); ?>" onclick="return false" style="display:inline-block;height:64px;width:64px;"><img src="/img/user/<?=(int)$fauthor['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" border="0" id="img" alt="<?php echo addslashes($fauthor['username']); ?>" height="64px"></a><br>
                    <a id="ctl00_cphRoblox_rbxMessageReader_AuthorHyperLink" title="Visit <?php echo htmlspecialchars($fauthor['username']); ?>'s Home Page" href="/User.aspx?id=<?php echo (int)$fpost['user_from']; ?>"><?php echo htmlspecialchars($fauthor['username']); ?></a>
                </div>
                <div id="Subject">
                    <?php echo filterText(htmlspecialchars($fpost['subject'])); ?><br>
                    <br>
                    <div id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
      
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseIconHyperLink" href="../AbuseReport/Message.aspx?ID=2274781&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fPrivateMessage.aspx%3fMessageID%3d2274781"><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseTextHyperLink" href="../AbuseReport/Message.aspx?ID=2274781&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fPrivateMessage.aspx%3fMessageID%3d2274781">Report Abuse</a></span>

    </div>
                </div>
            </td>
            <td style="padding: 0 10px 0 10px">
                <div class="Body">
                    <div id="ctl00_cphRoblox_rbxMessageReader_pBody" class="MultilineTextBox" style="height:250px;overflow-y:scroll;width:455px;">
      
                       <?php echo filterText(nl2br(htmlspecialchars($fpost['content']))); ?>                   
    </div> <p style="color:red;"><b>Remember, <?=$sitename;?> staff will never ask you for your <br>password.<br>
People who ask for your password are trying to steal <br>your account.
</b></p>
                </div>
                
            </td>
        </tr>
    </tbody></table>
</div>
              <div style="clear:both"></div>
<script>
        function yea() {
            window.location.replace("/My/DeleteMessage.aspx?ID=<?php echo $fpost['id'] ?>");
        }
    </script>
          </div><form action="" method="POST" id="formok">
          <div class="Buttons">
            <a id="ctl00_cphRoblox_lbCancel" class="Button" href="/My/Messages/Inbox.aspx">Cancel</a>
            <a id="ctl00_cphRoblox_lbDelete" class="Button" href="/My/Messages/Delete.aspx?MessageID=<?php echo (int)$MessageID; ?>" onclick="yea();" name="delete">Delete</a>
            <a id="ctl00_cphRoblox_lbReply" class="Button" href="/My/PrivateMessage?RecipientID=<?php echo $fauthor['id'] ?>&replyto=<?php echo $fpost['id'] ?>">Reply</a>
          </div></form>
          <div style="clear:both"></div>
        
  </div>
        
      
</div>
      
    </div>
    <div style="clear: both;"></div>
  </div>

        </div>