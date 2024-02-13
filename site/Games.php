<?php

require_once 'core/database.php';

$title = $sitename. ' Games - Most Popular (Now)';

include 'core/head.php';



if ($testing == 'true' && ($_USER['USER_PERMISSIONS'] !== "Administrator" && $_USER['USER_PERMISSIONS'] !== "beta_tester")) {
  die("<div style='margin: 150px auto 150px auto; width: 500px; border: thin solid; padding: 22px;'><strong><p>Games down because site up for testing purposes</p></strong></div>");
}
$stmt = $db->prepare('SELECT * FROM games ORDER BY players DESC');
$stmt->execute();



 
?>
<br>
<div id="GamesContainer">
        <div class="Ads_WideSkyscraper">
    
    

            <script type="text/javascript"><!--
                google_ad_client = "pub-2247123265392502";
                /* Old Games Side Banner */
                google_ad_slot = "7010215018";
                google_ad_width = 160;
                google_ad_height = 600;
                //-->
            </script>

            <script type="text/javascript" src="">
            </script><img name="google_ads_frame" width="160" height="600" frameborder="0" src="testad.png" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" data-ruffle-polyfilled=""></img>

        
</div>
<div id="ctl00_cphRoblox_rbxGames_GamesContainerPanel">
  
    <div class="DisplayFilters">
      <h2>Games&nbsp;<a id="ctl00_cphRoblox_rbxGames_hlNewsFeed" href="#" onclick="alert('You cannot do this.');"><img src="/images/feed-icon-14x14.png" border="0"/></a></h2>
      <div id="BrowseMode">
        <h4>Browse</h4>
        <ul>
          <li><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="#" onclick="alert('You cannot do this.');">Most Popular</a></li>
          <li><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="#" onclick="alert('You cannot do this.');">Recently Updated</a></li>
          <li><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="#" onclick="alert('You cannot do this.');">Featured Games</a></li>
        </ul>
      </div>
      <div id="ctl00_cphRoblox_rbxGames_pTimespan">
    
        <div id="Timespan">
          <h4>Time</h4>
          <ul>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="#" onclick="alert('You cannot do this.');">Now</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="#" onclick="alert('You cannot do this.');">Past Day</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="#" onclick="alert('You cannot do this.');">Past Week</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="#" onclick="alert('You cannot do this.');">Past Month</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="#" onclick="alert('You cannot do this.');">All-time</a></li>
          </ul>
        </div>
      
  </div>
    </div>
    
            <div id="Games">
                <span id="ctl00_cphRoblox_rbxGames_lGamesDisplaySet" class="GamesDisplaySet">Most Popular (Now)</span>
          <div id="ctl00_cphRoblox_rbxGames_HeaderPagerPanel" class="HeaderPager">
            <span id="ctl00_cphRoblox_rbxGames_HeaderPagerLabel">Page 1 of 1:</span>
            
            <a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="games.aspx?m=MostPopular&amp;t=Now&amp;p=2">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
        </div>
          <table id="ctl00_cphRoblox_rbxGames_dlGames" cellspacing="0" align="Left" border="0" width="550">
    <tr>
      
    </tr>
  </table>
              <div id="Games">
      <td class="Game" valign="top">
          <div style="display:inline-block;cursor:pointer;">
            <?php

foreach ($stmt as $game) {
    $creatorq = $db->prepare("SELECT * FROM users WHERE id=:creator");
    $creatorq->bindValue(':creator', $game['creatorid'], PDO::PARAM_INT);
    $creatorq->execute();
    $creator = $creatorq->fetch(PDO::FETCH_ASSOC);
    $game['players'] -= 1;
    echo '<span class="Game" valign="top">
            <div style="display:inline-block;cursor:pointer;">
              <div class="GameThumbnail">
                <a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_ciGame" title="' . filterText(htmlspecialchars($game['name'])) . '" href="/PlaceItem.aspx?ID=' . htmlspecialchars($game['id']) . '" style="display:inline-block;cursor:pointer;"><img src="/img/games/'.$game['id'].'.png" width="160" height="100" border="0" id="img" alt="' . filterText(htmlspecialchars($game['name'])) . '"/></a>
              </div>
              <div class="GameDetails">
                <div class="GameName"><a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameName" href="/PlaceItem.aspx?ID=' . htmlspecialchars($game['id']) . '">' . filterText(htmlspecialchars($game['name'])) . '</a></div>
                <div class="GameLastUpdate"><span class="Label">Updated:</span> <span class="Detail">IDK</span></div>
                <div class="GameCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameCreator" href="/User.php?ID=' . htmlspecialchars($game['creatorid']) . '">' . htmlspecialchars($creator['username']) . '</a></span></div>
                <div class="GamePlays"><span class="Label">Played:</span> <span class="Detail">0 times today</span></div>
                <div id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_pGameCurrentPlayers"> ';

    if ($game['players'] > 0) {
        echo '<div class="GameCurrentPlayers"><span class="DetailHighlighted">' . htmlspecialchars($game['players']) . ' players online</span></div>';
    }

    echo '</div>
          </div>
          </div>
    </span>';
}


      ?>
              
      
</div>



