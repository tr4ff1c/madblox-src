<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');

$userid = filter_var($_REQUEST['UserID'], FILTER_SANITIZE_NUMBER_INT);
$bbb = $db->prepare("SELECT * FROM users WHERE id=?");
$bbb->execute([$userid]);
$ba = $bbb->fetch(PDO::FETCH_ASSOC);

$a = $db->prepare("SELECT * FROM friends WHERE user_from=? AND areFriends=1 OR user_to=? AND areFriends=1");
$a->execute([$userid, $userid]);
$hisfriends = $a->rowCount();
$result = $a->fetchAll(PDO::FETCH_ASSOC);
$roww = 0;
?>
<div id="Body">
<div id="FriendsContainer">
    <div id="Friends">
        <h4><?=htmlspecialchars($ba['username'])?>'s Friends (<?=$hisfriends?>)</h4>
        <div align="center">
            Pages:
                        <a href="Friends.aspx?UserID=2&amp;Page=2">Next &gt;&gt;</a>        </div>
        <table cellspacing="0" align="Center" border="0">
            <tbody><tr>                <?php foreach($result as $row){ 
if ($row['user_from'] == $_USER['id']) {
                        $friendid = $row['user_to'];
                    } else {
                        $friendid = $row['user_from'];
                    }
$b = $db->prepare("SELECT * FROM users WHERE id=?");
$b->execute([$friendid]);
$user = $b->fetch(PDO::FETCH_ASSOC);

?><td>
                    <div class="Friend">
                        <div class="Avatar"><a title="<?=addslashes($user['username'])?>" href="/User.aspx?ID=<?=$user['id']?>" style="display:inline-block;cursor:pointer;"><img src="/img/user/<?=$user['id']?>.png?rand=<?=random_int(1, 999999999999999999)?>" width="95" border="0" alt="<?=addslashes($user['username'])?>" blankurl="http://t6-cf.roblox.com/blank-100x100.gif"></a></div>
                        <div class="Summary">
                            <span class="OnlineStatus">
<?php $onlinetest = ($user['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
                    echo "$onlinetest"; ?></span> 
</span>
                            <span class="Name"><a href="User.aspx?ID=<?=$user['id']?>"><?=htmlspecialchars($user['username'])?></a></span>
                        </div>
                    </div>
                </td><?php
                    $roww++;

                    if ($roww >= 6) {
                        echo "</tr><tr>";
                        $roww = 0;
                    }
 } ?>
                                
                                
                                
                                
                                
                </tr>
        </tbody></table>
    </div>
</div>
				</div>