<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/head.php';
?>
<?php
if (isset($_POST['submit'])) {
    $userId = htmlspecialchars($_USER['id']);

    $conversionType = htmlspecialchars($_POST['mtype']);
    $amount = htmlspecialchars($_POST['amount']);
	if(!is_numeric($amount) || $amount < 0) {
	$date = date("Y-m-d H-m-s");
	$time = time();
	$q = $db->prepare("UPDATE users SET bandate = :date, bantype = 'Warning', unbantime = :time, banreason = 'Trying to exploit Trade Currency system.' WHERE id = :id");
	$q->bindParam(':date', $date, PDO::PARAM_STR);
	$q->bindParam(':time', $time, PDO::PARAM_INT);
	$q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
	$q->execute();
	header('location: /Default.aspx');
	exit;
	}
if ($conversionType == 'rx') {
    $columnToUpdate = 'mlgbux';
    $newAmount = $_USER['mlgbux'] + $amount / 10;
    $columnToUpdates = 'tickets';
    $newAmounts = $_USER['tickets'] - $amount;
    if ($_USER['tickets'] < $amount) {
        die();
    }
    if($newAmount == 0){
	die();
    }
} else {
    $columnToUpdate = 'tickets';
    $newAmount = $_USER['tickets'] + $amount * 10;
    $columnToUpdates = 'mlgbux';
    $newAmounts =  $_USER['mlgbux'] - $amount;
    if ($_USER['mlgbux'] < $amount) {
        die();
    }
    if($newAmount == 0){
	die();
    }
}

$sql = $db->prepare("UPDATE users SET $columnToUpdate = :newAm, $columnToUpdates = :yey WHERE id = :id");
$sql->execute([
    ':newAm' => $newAmount,
    ':yey' => $newAmounts,
    ':id' => $userId
           
]);

header("location: /my/accountbalance/trade.aspx");
}
?>
<div id="TradeCurrencyContainer">
  <h2>Basic Currency Exchange</h2>
  <font face="Verdana">
    <div style="margin-bottom:5px; text-align:center;"><a href="#" onclick="location.reload()">Refresh</a></div>
  </font>
  <div class="LeftColumn">
    <div id="CurrencyBidsPane">
      <div class="CurrencyBids">
        <h4>Available Tickets</h4>
        <div class="CurrencyBid">
          1 @ 10
        </div>
      </div>
    </div>
  </div>
  <div class="CenterColumn">
    <!--<div id="CurrencyQuotePane">
      <div class="CurrencyQuote">
          <div class="TableHeader">
              <div class="Pair">Pair</div>
              <div class="Rate">Rate</div>
              <div class="Spread">Spread</div>
              <div class="HighLow">High/Low</div>
              <div style="clear: both;"></div>
          </div>
          <div class="TableRow">
              <div class="Pair">BUX/TIX</div>
              <div class="Rate">3.8220/3.9023</div>
              <div class="Spread">80</div>
              <div class="HighLow">459/0.0018</div>
              <div style="clear: both;"></div>
          </div>
      </div>
      </div>-->
    <div id="ctl00_cphRoblox_CurrencyTradePane">
      <div class="CurrencyTrade">
        <h4>Trade</h4>
        <!--
          <div class="CurrencyTradeDetails">
              <div class="CurrencyTradeDetail">
                  <span title="A market order is a buy or sell order to be executed immediately at current market prices. As long as there are willing sellers and buyers, a market order will be filled."><input id="ctl00_cphRoblox_MarketOrderRadioButton" type="radio" name="ctl00$cphRoblox$OrderType" value="MarketOrderRadioButton" checked="checked" onclick="if (document.getElementById(&#39;ctl00_cphRoblox_MarketOrderRadioButton&#39;).checked) { document.getElementById(&#39;LimitOrder&#39;).style.display=&#39;none&#39;; document.getElementById(&#39;SplitTrades&#39;).style.display=&#39;none&#39;; document.getElementById(&#39;MarketOrder&#39;).style.display=&#39;&#39;; } else { document.getElementById(&#39;LimitOrder&#39;).style.display=&#39;&#39;; document.getElementById(&#39;SplitTrades&#39;).style.display=&#39;&#39;; document.getElementById(&#39;MarketOrder&#39;).style.display=&#39;none&#39;; };"><label for="ctl00_cphRoblox_MarketOrderRadioButton">Market Order</label></span>&nbsp;
                  <span title="A limit order is an order to buy at no more (or sell at no less) than a specific price. This gives you some control over the price at which the trade is executed, but may prevent the order from being executed."><input id="ctl00_cphRoblox_LimitOrderRadioButton" type="radio" name="ctl00$cphRoblox$OrderType" value="LimitOrderRadioButton" onclick="if (document.getElementById(&#39;ctl00_cphRoblox_LimitOrderRadioButton&#39;).checked) { document.getElementById(&#39;LimitOrder&#39;).style.display=&#39;&#39;; document.getElementById(&#39;SplitTrades&#39;).style.display=&#39;&#39;; document.getElementById(&#39;MarketOrder&#39;).style.display=&#39;none&#39;; } else { document.getElementById(&#39;LimitOrder&#39;).style.display=&#39;none&#39;; document.getElementById(&#39;SplitTrades&#39;).style.display=&#39;none&#39;; document.getElementById(&#39;MarketOrder&#39;).style.display=&#39;&#39;; };"><label for="ctl00_cphRoblox_LimitOrderRadioButton">Limit Order</label></span>
              </div>
              <div class="CurrencyTradeDetail">
                  <div>What I'll give:</div>
                  <input name="ctl00$cphRoblox$HaveAmountTextBox" type="text" maxlength="9" id="ctl00_cphRoblox_HaveAmountTextBox" tabindex="1" class="TradeBox" autocomplete="off" onkeyup="EstimateTrade()" onblur="if (document.getElementById(&#39;ctl00_cphRoblox_MarketOrderRadioButton&#39;).checked) { if (document.getElementById(&#39;ctl00_cphRoblox_HaveCurrencyDropDownList&#39;).selectedIndex == 0) { var haveBox = document.getElementById(&#39;ctl00_cphRoblox_HaveAmountTextBox&#39;); if (parseInt(haveBox.value) < 20) { alert(&#39;Market Orders must be at least 20 Tickets.&#39;); haveBox.value = &#39;&#39;; haveBox.focus(); } } }">
                  
                  
                  &nbsp;&nbsp;
                  <select name="ctl00$cphRoblox$HaveCurrencyDropDownList" id="ctl00_cphRoblox_HaveCurrencyDropDownList" onchange="ctl00_cphRoblox_WantCurrencyDropDownList.selectedIndex = ctl00_cphRoblox_HaveCurrencyDropDownList.selectedIndex; EstimateTrade()">
          <option value="Tickets">Tickets</option>
          <option value="Robux">GoodBux</option>
          
          </select>
              </div>
              <div id="LimitOrder" class="CurrencyTradeDetail" style="display: none;">
                  <div>What I want:</div>
                  <input name="ctl00$cphRoblox$WantAmountTextBox" type="text" maxlength="9" id="ctl00_cphRoblox_WantAmountTextBox" tabindex="2" class="TradeBox" autocomplete="off">
                  
                  
                  &nbsp;
                  <select name="ctl00$cphRoblox$WantCurrencyDropDownList" id="ctl00_cphRoblox_WantCurrencyDropDownList" onchange="ctl00_cphRoblox_HaveCurrencyDropDownList.selectedIndex = ctl00_cphRoblox_WantCurrencyDropDownList.selectedIndex; EstimateTrade()">
          <option value="Robux">GoodBux</option>
          <option value="Tickets">Tickets</option>
          
          </select>
                  <p style="color: Red;">* NOTE: Your money will be held for safe-keeping until either the trade executes or you cancel your position.</p>
                  <p style="font-size: smaller; margin: 15px; text-align: left;">A limit order is an order to buy at no more (or sell at no less) than a specific price. This gives you some control over the price at which the trade is executed, but may prevent the order from being executed.</p>
              </div>
              <div id="SplitTrades" class="CurrencyTradeDetail" style="display: none;">
                  <input id="ctl00_cphRoblox_AllowSplitTradesCheckBox" type="checkbox" name="ctl00$cphRoblox$AllowSplitTradesCheckBox" checked="checked" tabindex="3"><label for="ctl00_cphRoblox_AllowSplitTradesCheckBox">Allow split trades</label>
              </div>
              <div id="MarketOrder" class="CurrencyTradeDetail" style="">
                  <div>What I'll get:</div>
                  <p id="EstimatedTrade" style="color: Red;">Estimated Trade: ?</p>
                  <p style="color: Red;">* NOTE: Your money will be held for safe-keeping until either the trade executes or you cancel your position.</p>
                  <p style="font-size: smaller; margin: 15px; text-align: left;">A market order is a buy or sell order to be executed immediately at current market prices. As long as there are willing sellers and buyers, a market order will be filled.</p>
              </div>
              <div class="CurrencyTradeDetail">
                  <input type="submit" name="ctl00$cphRoblox$SubmitTradeButton" value="Submit Trade" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$SubmitTradeButton&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_cphRoblox_SubmitTradeButton" tabindex="4">
              </div>
          </div>-->
        <form method="post" style="padding:25px;">
          <ul>
            <li>10 Tickets = 1 MADBUX</li>
            <li>1 MADBUX = 10 Tickets</li>
          </ul>
          <input id="radioRX" type="radio" name="mtype" value="rx" checked="checked"><label for="radioRX">To MADBUX</label>
          <input id="radioTX" type="radio" name="mtype" value="tx"><label for="radioTX">To Tickets</label>
          <br><br>
          <input id="amounttxt" name="amount" type="number" maxlength="9" tabindex="2" value="10" class="TradeBox" autocomplete="off" step="1">
          <br><br>
          I will get <span id="amounts">1</span> <span id="type" style="color:green;">GX</span>
          <script>
            $("#amounttxt").on("input", function() {
                if($("input[name=mtype]:checked").val() == "rx") {
                    $("#amounts").text(Math.floor($(this).val() / 10));
                    $("#type").css("color", "green").html("GX");
                } else {
                    $("#amounts").text(Math.floor($(this).val() * 10));
                    $("#type").css("color", "goldenrod").html("TX");
                }
            });
            $("input[name=mtype]").on("change", function() {
                if($("input[name=mtype]:checked").val() == "rx") {
                    $("#amounts").text(Math.floor($("#amounttxt").val() / 10));
                    $("#type").css("color", "green").html("MX");
                } else {
                    $("#amounts").text(Math.floor($("#amounttxt").val() * 10));
                    $("#type").css("color", "goldenrod").html("TX");
                }
            });
          </script>
          <br><br>
          <input type="submit" name="submit" value="Submit Trade">
        </form>
      </div>
    </div>
    <div class="TradingDashboard">
    </div>
  </div>
  <div class="RightColumn">
    <div id="CurrencyOffersPane">
      <div class="CurrencyOffers">
        <h4>Available GOODBUX</h4>
        <div class="CurrencyOffer">
          10 @ 1
        </div>
      </div>
    </div>
  </div>
  <div style="clear: both;"></div>
</div>