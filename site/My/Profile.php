<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');

if($loggedin != "yes"){
    header("location: ../Login/Default.aspx");
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if ($_POST["Blurb"]) {
        $desiredblurb = $_POST["Blurb"];

        $stmt = $db->prepare("UPDATE users SET blurb = :blurb WHERE id = :id");
        $stmt->execute(['blurb' => $desiredblurb, 'id' => $_USER['id']]);
    }

}
?>
<style>
#EditProfileContainer {
    background-color: #eeeeee;
    border: 1px solid #000;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
fieldset {
    font-size: 1.2em;
    margin: 15px 0 0 0;
}
</style>
<div id="Body">
<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	<div id="EditProfileContainer">
		<h2>Edit Profile</h2>
		<div id="ResetPassword">
			<fieldset title="Reset your password">
				<legend>Change your password</legend>
				<div class="Suggestion">Click the button below to change your password.</div>
				<div class="ResetPasswordRow">
					&nbsp;<a href="/Login/ChangePassword.aspx">Change Password</a>
		    	</div>
			</fieldset>
		</div>
		<div id="EnterEmail">
			<fieldset title="Update Your Email Address">
				<legend>Update Your Email Address</legend>
				<div class="Suggestion">Click the button below to update your email address.</div>
				<div class="Validators">
									</div>
				<div class="ResetPasswordRow">
					&nbsp;<a href="Email.aspx">Update Email</a>
							    	</div>
		    	<!--p><b>Email Verified</b></p-->			</fieldset>
		</div>
		<div id="Blurb">
			<fieldset title="Update your personal blurb">
				<legend>Update your personal blurb</legend>
				<div class="Suggestion">Describe yourself here (max. 1000 characters). Make sure not to provide any details that can be used to identify you outside <?=$sitename?>.</div>
				<div class="Suggestion" style="color:RED"></div>
				<div class="BlurbRow">
					<?php if(isFiltered($_USER["blurb"])) { ?><p style="color:red;">Your blurb has been filtered by the chat filter.</p><?php } ?>
					<textarea name="Blurb" rows="12" cols="20" id="Blurb" class="MultilineTextBox"><?php echo htmlspecialchars($_USER["blurb"]); ?></textarea>
				</div>
			</fieldset>
		</div>
                <div id="ResetPassword">
			<fieldset title="Reset your password">
				<legend>Get additional features</legend>
				<div class="Suggestion">Click the button below to enable additional features.</div>
				<div class="ResetPasswordRow">
					&nbsp;<?php if($_USER["afison"] === 1) { echo "<span style='color: grey;'>Enable</span> / <a href='/My/AdditionalFeatures.php'>Disable</a>"; } else { echo "<a href='/My/AdditionalFeatures.php'>Enable</a> / <span style='color: grey;'>Disable</span>"; } ?>
		    	</div>
			</fieldset>
		</div>
		<div id="Theme">
			<fieldset title="Reset your password">
				<legend>Change Theme</legend>
				<div class="Suggestion">Click the button below to change your site theme.</div>
				<div class="ResetPasswordRow">
					&nbsp;<?php if($_USER["theme"] === "default") {
						echo "<span style='color: grey;'>Default</span> / <a href='/My/SetTheme.php?theme=dark'>Dark</a> / <a href='/My/SetTheme.php?theme=calebblox'>CalebBlox</a>";
					} elseif($_USER["theme"] === "dark") {
						echo "<a href='/My/SetTheme.php?theme=default'>Default</a> / <span style='color: grey;'>Dark</span> / <a href='/My/SetTheme.php?theme=calebblox'>CalebBlox</a>";
					} elseif($_USER["theme"] === "calebblox") {
						echo "<a href='/My/SetTheme.php?theme=default'>Default</a> / <a href='/My/SetTheme.php?theme=dark'>Dark</a> / <span style='color: grey;'>CalebBlox</span>";
					} else {
						echo "<a href='/My/SetTheme.php?theme=default'>Default</a> / <a href='/My/SetTheme.php?theme=dark'>Dark</a> / <a href='/My/SetTheme.php?theme=calebblox'>CalebBlox</a>";
					} ?>
		    	</div>
			</fieldset>
		</div>
		<div id="LogOut">
			<fieldset title="Reset your password">
				<legend>Logout</legend>
				<div class="Suggestion">Click the buttons below to logout.</div>
				<div class="ResetPasswordRow">
					&nbsp;<a href='/api/LogoutRequest.aspx'>Logout only on this device</a> / <a href='/api/LogoutRequest.aspx?all'>Logout on all devices</a>
		    	</div>
			</fieldset>
		</div>
				<div class="Buttons">
			<input name="Update" id="Update" tabindex="4" class="Button" type="submit" value="Update">&nbsp;<a id="Cancel" tabindex="5" class="Button" href="/User.aspx">Cancel</a>
		</div>
	</div>
</form>
<style>
				#EditProfileContainer {
    background-color: #eeeeee;
    border: 1px solid #000;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#EditProfileContainer #AgeGroup, #EditProfileContainer #ChatMode, #EditProfileContainer #PrivacyMode, #EditProfileContainer #EnterEmail, #EditProfileContainer #ResetPassword, #EditProfileContainer #Blurb, #Theme, #LogOut {
    margin: 0 auto;
    width: 60%;
}
				</style>
				</div>
				<?php require_once($_SERVER['DOCUMENT_ROOT'].'/core/footer.php'); ?>