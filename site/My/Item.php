<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');

if($loggedin !== "yes"){
    header("location: /Login/Default.aspx");
    exit;
}

$id = intval((int)$_GET['ID']);

$itemq = $db->prepare("SELECT * FROM catalog WHERE id=?");
$itemq->execute([$id]);
$itemcount = $itemq->rowCount();
$item = $itemq->fetch(PDO::FETCH_ASSOC);

if($itemcount < 1){
    header("location: /");
    exit;
}
elseif($item['creatorid'] !== $_USER['id']){
    header("location: /");
    exit;
}else{
$typea = "a";
$chekc = "";
$trueorfalseccb = 'false';
if($item['allowComments'] == 1){
    $chekc = 'checked=""';
    $trueorfalseccb = 'true';
}
if($item['type'] == "tshirt"){
    $typea = 'T-Shirt';
}
if($item['type'] == "shirt"){
    $typea = 'Shirt';
}
if($item['type'] == "pants"){
    $typea = 'Pants';
}
if($item['type'] == "face"){
    $typea = 'Face';
}
if($item['type'] == "hat"){
    $typea = 'Hat';
}
$ishidden = 'hidden';
$sellitemthing = 'style="display: none;"';
if($item['offsale'] == 0){
    $sellitemthing = '';;
}
$checkc = "";
if($item['offsale' == 0]){
    $checkc = 'checked="checked"';
}
?>
<?php
            if(isset($_POST['updatend'])){
                $name = filter_var(htmlspecialchars($_POST['iName']), FILTER_SANITIZE_STRING);
                $desc = filter_var(htmlspecialchars($_POST['iDesc']), FILTER_SANITIZE_STRING);

                $uca5 = $db->prepare("UPDATE catalog SET name=?, description=? WHERE id=?");
                $uca5->execute([$name, $desc, $id]);
            }

            if(isset($_POST['updateall'])){
                $Value = (int)$_POST["robuxTxt"];

                if(isset($_POST['sellItem'])){
                $dabuylol = "tix";

                if(isset($_POST['mlgbuxRadio'])){

                $Fee = round($Value * 0.1);
                $dabuylol = "robux";

                }elseif(isset($_POST['ticketsRadio'])){
        
                $Fee = round($Value * 0.1);
                $dabuylol = "tix";

                }
                if(isset($_POST['sellItem']))
                    $uca2 = $db->prepare("UPDATE catalog SET offsale='0' WHERE id=:id");
                    $uca2->execute([':id' => $item['id']]);
                    if($_POST['robuxN'] < 1){
                            die("Minimum price for items is 1 !");
                    }
                    if($_POST['robuxN'] > 10){
                        die("Maximum price for items is 10 !");
                    }
                        $uca3 = $db->prepare("UPDATE catalog SET price='".(int)$_POST['robuxN']."' WHERE id=:id");
                        $uca3->execute([':id' => $item['id']]);
                        if($_POST['paymentType'] === "tickets"){
                            $uca4 = $db->prepare("UPDATE catalog SET buywith='tix' WHERE id=:id");
                            $uca4->execute([':id' => $item['id']]);
                        }
                        elseif($_POST['paymentType'] === "mlgbux"){
                            $uca4 = $db->prepare("UPDATE catalog SET buywith='robux' WHERE id=:id");
                            $uca4->execute([':id' => $item['id']]);
                        }else{
                            die("Please choose a type.");
                        }
                    
                    
                }else{
                    $uca2 = $db->prepare("UPDATE catalog SET offsale='1' WHERE id=?");
                    $uca2->execute([$item['id']]);
                }
                if(isset($_POST['commentschk'])){
                    $uca = $db->prepare("UPDATE catalog SET allowComments='1' WHERE id=?");
                    $uca->execute([$item['id']]);
                }else{
                    $uca = $db->prepare("UPDATE catalog SET allowComments='0' WHERE id=:?");
                    $uca->execute([$item['id']]);
                }
                header("/Item.aspx?id=".$id);
            }



            ?>
<style>
#EditItem 
{
    background-color: #eee;
    border: solid 1px #000;
    color: #555;
    float: left;
    font-family: Verdana, Sans-Serif;
    margin: 0;
    width: 725px;
}

/*#EditItemContainer
{
	background-color: #eee;
	border: solid 1px #000;
	color: #555;
	margin: 0 auto;
	width: 620px;
}*/

#EditItemContainer h2
{
	background-color: #ccc;
    border-bottom: solid 1px #000;
    color: #333;
    font-family: Comic Sans MS, Sans-Serif;
    font-size: x-large;
    margin: 0;
    text-align: center;
}

#EditItemContainer fieldset
{
	font-size: 1.2em;
	margin: 0;
}

#EditItemContainer #Confirmation
{
	border: dashed 1px #ff0000;
	background-color: #ccc;
	color: #ff0000;
	margin: 0 auto;
	margin-top: 10px;
	padding: 10px 5px;
	width: 410px;
	float: center;
}

#EditItemContainer #ItemName
{
	margin: 0 auto;
	margin-top: 10px;
	padding: 0;
	text-align: left;
	width: 420px;
}

#EditItemContainer #ItemThumbnail 
{
    border: solid 1px #555;
    height: 230px;
    margin: 0 auto;
    margin-top: 10px;
    padding: 0;
    text-align: left;
    width: 420px;
}

#EditItemContainer #ItemDescription
{
	margin: 0 auto;
	margin-top: 10px;
	padding: 0;
	text-align: left;
	width: 420px;
}

#EditItemContainer #Comments, 
#EditItemContainer #PlaceAccess, 
#EditItemContainer #PlaceCopyProtection, 
#EditItemContainer #PublicDomain, 
#EditItemContainer #SellThisItem, 
#EditItemContainer #PlaceReset 
{
    margin: 0 auto;
    margin-top: 10px;
    width: 420px;
}

#EditItemContainer #SellThisItem,
#EditItemContainer #Comments
{
    margin: 0 auto;
    margin-top: 10px;
    width: 420px;
}

#EditItemContainer #SellThisItem #Pricing
{
    background-color: #fff;
    border: dashed 1px #000;
    margin: 15px 5px 5px 5px;
    padding: 5px;
}

#EditItemContainer #SellThisItem #Price,
#EditItemContainer #SellThisItem #Fee,
#EditItemContainer #SellThisItem #Profit
{
}

#EditItemContainer #SellThisItem #Price
{
	margin-top: 10px;
}

#EditItemContainer #SellThisItem #Price .TextBox
{
	padding: 2px 4px;
	width: 75px;
}

#EditItemContainer .SellThisItemRow,
#EditItemContainer .EnableCommentsRow
{
	font-size: .9em;
	margin: 10px 0;
	text-align: center;
}

#EditItemContainer .PricingLabel
{
	float: left;
	font-weight: bold;
	margin-right: 6px;
	margin-left: -10px;
	text-align: right;
	width: 155px;
}

#EditItemContainer .PricingField_Robux
{
	float: left;
	text-align: left;
	width: 110px;
}

#EditItemContainer .PricingField_Tickets
{
	float: left;
	text-align: left;
	width: 108px;
	margin-left: 5px;
}

#EditItemContainer .Buttons
{
	margin: 0 auto;
	margin-top: 10px;
	margin-bottom: 10px;
	text-align: center;
}

#EditItemContainer .Button
{
	border-color: #555;
	color: #555;
	cursor: pointer;
}

#EditItemContainer .Button:hover
{
	background-color: #6e99c9;
	color: #fff;
}

#EditItemContainer .Label
{
	font-size: 1.2em;
	margin: 0;
	padding: 0;
}

#EditItemContainer .TextBox
{
	border: dashed 1px #555;
	margin: 0;
	padding: 5px 10px;
	width: 400px;
}

#EditItemContainer .MultilineTextBox
{
	border: dashed 1px #555;
	margin: 0;
	padding: 5px 10px;
	width: 400px;
	resize: none;
}

#EditItemContainer .Suggestion
{
	font: normal .8em/normal Verdana, sans-serif;
	padding-left: 9px;
}

#ItemContainer .Ads_WideSkyscraper, #EditItemContainer .Ads_WideSkyscraper 
{
    border: solid 1px #000;
    float: right;
    text-align: right;
    width: 160px;
}

</style>
<script>
	$(document).ready(function() {
	

	$(".commentCheckbox").prop("checked", <?=$trueorfalseccb?>);

	

	
		$("#robuxTxt, #tixTxt").bind({
			keydown: function(e) {
				if (e.shiftKey === true ) {
					if (e.which == 9) {
						return true;
					}
					return false;
				}
				if (e.which > 57) {
					return false;
				}
				if (e.which==32) {
					return false;
				}
				return true;
			}
		});
		$("#sellItemChk").click(function() {
			if($(this).is(':checked')) {
				$('#PricingPanel').show();
			} else {
				$('#PricingPanel').hide();
			}
		});
	});
	
	$(window).on('load', function() {
		$(".robuxCheckbox").change(function() {
			if(this.checked) {
				$("#robuxTxt").prop("disabled", false);
				$("#robuxTxt").val(0);
				$(".buxFee").removeAttr("style");
				$(".buxEarn").removeAttr("style");
				$(".robuxFee").text("");
				$(".robuxEarn").text("");
			} else {
				$("#robuxTxt").prop("disabled", true);
				$("#robuxTxt").val(0);
				$(".buxFee").css("display", "none");
				$(".buxEarn").css("display", "none");
				$(".robuxFee").text("---");
				$(".robuxEarn").text("---");
			}
		});

		$(".tixCheckbox").change(function() {
			if(this.checked) {
				$("#robuxTxt").prop("disabled", false);
				$("#robuxTxt").val(0);
				$(".tixFee").removeAttr("style");
				$(".tixEarn").removeAttr("style");
				$(".ticketFee").text("");
				$(".ticketEarn").text("");
			} else {
				$("#robuxTxt").prop("disabled", true);
				$("#robuxTxt").val(0);
				$(".tixFee").css("display", "none");
				$(".tixEarn").css("display", "none");
				$(".ticketFee").text("---");
				$(".ticketEarn").text("---");
			}
		});

		$('#robuxTxt').on('input propertychange paste', function() {
			$(".robuxFee").text(Math.round($("#robuxTxt").val() * 0.1));
			$(".robuxEarn").text(Math.round($("#robuxTxt").val() - $("#robuxTxt").val() * 0.1));
		});

		$('#tixTxt').on('input propertychange paste', function() {
			$(".ticketFee").text(Math.round($("#robuxTxt").val() * 0.1));
			$(".ticketEarn").text(Math.round($("#robuxTxt").val() - $("#robuxTxt").val() * 0.1));
		});
	});
</script>
<div id="Body">

	<div id="EditItemContainer">
		<div id="EditItem">
			<h2>Edit <?=$typea?></h2>
			<form method="post">
			<div id="ItemName">
				<span style="font-weight: bold;">Name:</span><br>
				<input name="iName" type="text" value="<?=$item['name']?>" maxlength="64" class="TextBox">
				<span style="color:Red;visibility:<?=$ishidden?>;">A Name is Required</span>
			</div>
			<div id="ItemDescription">
				<span style="font-weight: bold;">Description:</span><br>
				<textarea name="iDesc" maxlength="1000" rows="2" cols="20" class="TextBox" style="height:150px;width: 410px;padding: 5px;"><?=$item['description']?></textarea>
			</div>
			
			<div class="Buttons">
				<input name="updatend" id="Submit" tabindex="4" class="Button" type="submit" value="Update">&nbsp;
				<a id="Cancel" tabindex="5" class="Button" href="/Item.aspx?id=<?=$id?>">Cancel</a>
			</div></form>
<form method="post">
			<div id="Comments">
				<fieldset title="Turn comments on/off">
					<legend>Turn comments on/off</legend>
					<div class="Suggestion">
						Choose whether or not this item is open for comments.
					</div>
					<div class="EnableCommentsRow">
						<input class="commentCheckbox" type="checkbox" name="commentschk" <?=$chekc?>><label>Allow Comments</label>
					</div>
				</fieldset>
			</div> 
			 
			
			<div id="SellThisItem">
				<fieldset title="Sell this Item">
					<legend>Sell this Item</legend>
					<div class="Suggestion">
						Check the box below and enter a price if you want to sell this item in the <?=$sitename?>
						catalog. Uncheck the box to remove the item from the catalog.
					</div>
					<div class="SellThisItemRow">
						<input id="sellItemChk" class="sellCheckbox" <?php if($item['offsale'] === 0){ ?> checked="" <?php }?> type="checkbox" name="sellItem"><label>Sell this Item</label>
						<div id="PricingPanel" class="PricingPanel" <?=$sellitemthing?>>
							<div id="Pricing">
								<div id="Currency" style="margin-left: 151px;">
									<div class="PricingLabel">
									</div>
									<div class="PricingField_Robux">
    <input type="radio" name="paymentType" id="mlgbuxRadio" class="tixCheckbox" value="mlgbux">
    <label for="mlgbuxRadio">for MLGBUX</label>

    <input type="radio" name="paymentType" id="ticketsRadio" class="tixCheckbox" value="tickets">
    <label for="ticketsRadio">for Tickets</label>
</div>

									<div style="clear: both;">
									</div>
								</div>
								<div id="Price">
									<div class="PricingLabel">
										Price:
									</div>
									<div class="PricingField_Robux">
										<input id="robuxTxt" name="robuxN" type="number" maxlength="9" class="TextBox" value="<?=$item['price']?>" disabled="">
									</div>
									<span id="PricingError" style="display:none;color:red;">
										The minimum price for this item is <span>5</span>
									</span>
									<span id="PricingErrorMax" style="display:none;color:red;">
										The maximum price for this item is <span>10</span>
									</span>
									<div style="clear: both;"></div>
								</div>
								<div id="Fee" style="margin-top: 18px;">
									<div class="PricingLabel">
											Marketplace Fee @ <br> 10%:
											<br><span class="Suggestion">(minimum 1)</span>
									</div>
									<div class="PricingField_Robux">
										<span class="buxFee" style="display: none;">G$&nbsp;</span>
										<span class="robuxFee">---</span>
									</div>
									<div class="PricingField_Tickets">
										<span class="tixFee" style="display: none;">Tx&nbsp;</span>
										<span class="ticketFee">---</span>
									</div>
									<div style="clear: both;">
									</div>
								</div>
								<div id="Profit" style="margin-top:10px">
									<div class="PricingLabel">
										You Earn:</div>
										<div class="PricingField_Robux">
											<span class="buxEarn" style="display: none;">G$&nbsp;</span>
											<span class="robuxEarn">---</span>
										</div>
										<div class="PricingField_Tickets">
											<span class="tixEarn" style="display: none;">Tx&nbsp;</span>
											<span class="ticketEarn">---</span>
										</div>
									<div style="clear: both;">
									</div>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="Buttons">
				<input name="updateall" tabindex="4" class="Button" type="submit" value="Update">&nbsp;
				<a id="Cancel" tabindex="5" class="Button" href="/Item.aspx?id=<?=$id?>">Cancel</a>
			</div>
</div>
		<div style="clear: both;"></div>
	</div>
</form>
</div>
<?php } ?>