<?php
require("core/head.php");

$usercountq = $db->query("SELECT * FROM users");
$usercount = $usercountq->rowCount();
$usersperpage = 10;
$pages = ceil($usercount / $usersperpage);
$page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);
$page = intval($page);

if ($page < 1 || $page > 9223372036854775807) {
    $page = 1;
}

if ($page >= $pages) {
    $page = $pages;
}

$offset = ($page * $usersperpage) - $usersperpage;

if ($offset < 1) {
    $offset = 0;
}
                        $resultsperpage = 10;
                        $usercountq = $db->query("SELECT * FROM users ORDER BY lastseen");
                        $usercount = $usercountq->rowCount();
                        $numberofpages = ceil($usercount / $resultsperpage);

                        $thispagefirstresult = ($page - 1) * $resultsperpage;
                        
                        $searchbar = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

                        $stmt = $db->prepare("SELECT * FROM users WHERE username LIKE ? ORDER BY lastseen DESC LIMIT ?, ?");
if(isset($searchbar)){
    $stmt->bindValue(1, "%".$searchbar."%", PDO::PARAM_STR);
    $stmt->bindValue(2, $thispagefirstresult, PDO::PARAM_INT);
    $stmt->bindValue(3, $resultsperpage, PDO::PARAM_INT);
} else {
    $stmt->bindValue(2, $thispagefirstresult, PDO::PARAM_INT);
    $stmt->bindValue(3, $resultsperpage, PDO::PARAM_INT);
}

                        $stmt->execute(); ?>
<div id="Body">


    <div id="ctl00_cphRoblox_Panel1">
        <div id="BrowseContainer" style="text-align:center">
            <div><form action="" method="POST">
<div id="SearchBar" class="SearchBar">
			<span class="SearchBox"><input name="search" type="text" maxlength="100" id="ctl00_cphRoblox_SearchTextBox" class="TextBox" value="<?=htmlspecialchars($_POST['search']);?>"></span>
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


                        foreach ($stmt as $row) {
$banned = false;
$q = $db->prepare("SELECT * FROM bans WHERE userid = :id");
$q->bindParam(':id', $row["id"], PDO::PARAM_INT);
$q->execute();
$ban = $q->fetch();
if($ban && $ban["typeBan"] !== "None") $banned = true;
if(!$banned) {
    $badge = "";
    if($row["USER_PERMISSIONS"] === "Administrator") $badge = "/images/madbloxadmin.png";

    if(strlen($badge) >= 1) $badge = '<img src="'.$badge.'" style="width: 13px;margin-left: 6px;margin-bottom: -3px;">';
    $blurb = filterText(htmlspecialchars($row['blurb']));
	$blurb = str_replace('{tix}', $row["tickets"], $blurb);
	$blurb = str_replace('{madbux}', $row["mlgbux"], $blurb);
                            echo "<tr class='GridItem'>
    <td>
          <img src='/img/user/".$row['id'].".png?rand=".random_int(1,999999999999999999)." title='".addslashes(htmlspecialchars($row['username']))."' width='60'>
    </td>
    <td href='/User.aspx?ID=" . $row['id'] . "' style='word-break: break-all;'>
    <a href='/User.aspx?ID=" . $row['id'] . "'>" . htmlspecialchars($row['username']) . $badge . "</a><br>
    <span>" . $blurb . "</span>
    </td>";
                            $onlinetext = ($row['lastseen'] + 300 >= time()) ? "<span class=\"UserOnlineStatus\">Online</span>" : "<span class=\"UserOfflineStatus\">Offline</span>";
                            echo "
    <td><span>$onlinetext";
    $onlinetext2 = ($row['lastseen'] + 300 >= time()) ? "<span class=\"UserOnlineStatus\">Website</span>" : "<span class=\"UserOfflineStatus\">".date('d/m/Y g:i A', $row["lastseen"])."</span>";
                            echo "</span><br></td>
    <td><span>$onlinetext2</span></td>
    </tr>";
                        }}
                        echo "
                        <tr class='GridPager'>
                            <td colspan='4'>
                                <table border='0'>
                                    <tbody>
                        ";

                        if ($page <= $page) {
                            $pagefix = $page + 9;
                        }
                        if ($pagefix > $numberofpages) {
                            $pagefix = $numberofpages;
                        }
                        $page2 = $page - 1;
                        $page3 = $page - 2;
                        $page4 = $page - 3;
                        $page5 = $page - 4;
                        $page6 = $page - 5;


                        if ($page == 1 or $page == 2 or $page == 3 or $page == 4 or $page == 5) {
                        } else {
                            echo "<td>
                            <a href='/Browse.aspx?page=" . $page6 . "'>" . $page6 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $page5 . "'>" . $page5 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $page4 . "'>" . $page4 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $page3 . "'>" . $page3 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $page2 . "'>" . $page2 . " </a>
                        </td>
                    ";
                        }

                        $pager = $page - 1;
                        $pager1 = $page - 2;
                        $pager2 = $page - 3;
                        $pager3 = $page - 4;
                        if ($page == 5) {
                            echo "<td>
                            <a href='/Browse.aspx?page=" . $pager3 . "'>" . $pager3 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $pager2 . "'>" . $pager2 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $pager1 . "'>" . $pager1 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $pager . "'>" . $pager . " </a>
                        </td>
                    ";
                        } else {
                        }

                        $pagej = $page - 1;
                        $pagej1 = $page - 2;
                        $pagej2 = $page - 3;
                        if ($page == 4) {
                            echo "<td>
                            <a href='/Browse.aspx?page=" . $pagej2 . "'>" . $pagej2 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $pagej1 . "'>" . $pagej1 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $pagej . "'>" . $pagej . " </a>
                        </td>
                    ";
                        } else {
                        }

                        $pagey = $page - 1;
                        $pagey1 = $page - 2;
                        if ($page == 3) {
                            echo "<td>
                            <a href='/Browse.aspx?page=" . $pagey1 . "'>" . $pagey1 . " </a>
                        </td>
                    <td>
                            <a href='/Browse.aspx?page=" . $pagey . "'>" . $pagey . " </a>
                        </td>
                    ";
                        } else {
                        }

                        $paget = $page - 1;
                        if ($page == 2) {
                            echo "<td>
                            <a href='/Browse.aspx?page=" . $paget . "'>" . $paget . " </a>
                        </td>
                    ";
                        } else {
                        }


                        for ($page <= $pagefix; $page <= $pagefix; $page++) {

                            echo "
                        <td>
                            <a href='/Browse.aspx?page=" . $page . "'>" . $page . " </a>
                        </td>
                        ";
                        }
                        echo "
<td><a href='/Browse.aspx?page=$numberofpages'>...</a></td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    ";
                        ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>
<?php
require("core/footer.php");
?>