<?php
require($_SERVER["DOCUMENT_ROOT"]."/main/nav.php");

require_once $_SERVER["DOCUMENT_ROOT"]."/Login/ReCaptcha.php";

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

if($_SERVER['REQUEST_METHOD'] === "POST"){
$username = filter_var($_POST['UserName'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
$confirm_password = filter_var($_POST['PasswordConfirm'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

 if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
          die("Please fill out all fields.");
          exit;
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          die("Please enter a valid email address.");
          exit;
      }
      if ($password !== $confirm_password) {
          die("Passwords do not match.");
          exit;
      }
      
      if (!$captcha_completed) {
        die("reCAPTCHA failed, please try again.");
	exit;
      }

      if (strlen($username) == 0) {
        die("Your username must be at least 3 characters.");
	exit;
      }
      
      if (strlen($username) < 3) {
        die("Your username must be at least 3 characters.");
	exit;
      }

      if (strlen($username) > 20) {
        die("Your username's length must be less than 20 characters");
	exit;
      }

      if (preg_match('/[^a-zA-Z\d]/', $username)) {
        die("Username contains special characters");
	exit;
      }
$b = $db->prepare("SELECT * FROM users WHERE username = ?");
$b->execute([$username]);
$aa = $b->rowCount();

if($aa > 0){
	die("User already exists");
	exit;
}
	  $passwordh = password_hash($password, PASSWORD_DEFAULT);
$a = $db->prepare("INSERT INTO users (id, username, password, email) VALUES (NULL, ?, ?, ?)");
$a->execute([$username, $passwordh, $email]);
$_SESSION['id'] = $db->lastInsertId();
$_SESSION['loggedin'] = true;

header("location: /Api/RenderAvatar.aspx");
exit;

}
?>

<div id="Body">
					
	
		<div id="Registration">
			<div id="ctl00_cphRoblox_upAccountRegistration">
	
					<h2>Sign Up and Play</h2>
					<h3>Step 1 of 2: Create Account</h3><form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
					<div id="EnterAgeGroup">
						<fieldset title="Provide your age-group">
							<legend>Provide your age-group</legend>
							<div class="Suggestion">
								This will help us to customize your experience.  Users under 13 years will only be shown pre-approved images.
							</div>
							<div class="AgeGroupRow">
								<span id="ctl00_cphRoblox_rblAgeGroup"><input id="ctl00_cphRoblox_rblAgeGroup_0" type="radio" name="ctl00$cphRoblox$rblAgeGroup" value="1" checked="checked" tabindex="5"><label for="ctl00_cphRoblox_rblAgeGroup_0">Under 13 years</label><br><input id="ctl00_cphRoblox_rblAgeGroup_1" type="radio" name="ctl00$cphRoblox$rblAgeGroup" value="2" onclick="javascript:setTimeout('__doPostBack(\'ctl00$cphRoblox$rblAgeGroup$1\',\'\')', 0)" tabindex="5"><label for="ctl00_cphRoblox_rblAgeGroup_1">13 years or older</label></span>
							</div>
						</fieldset>
					</div>
					<div id="EnterUsername">
						<fieldset title="Choose a name for your <?=$sitename?> character">
							<legend>Choose a name for your <?=$sitename?> character</legend>
							<div class="Suggestion">
								Use 3-20 alphanumeric characters: A-Z, a-z, 0-9, no spaces
							</div>
							<div class="Validators">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
							<div class="UsernameRow">
								<label for="ctl00_cphRoblox_UserName" id="ctl00_cphRoblox_UserNameLabel" class="Label">Character Name:</label>&nbsp;<input name="UserName" type="text" id="ctl00_cphRoblox_UserName" tabindex="1" class="TextBox">
							</div>
						</fieldset>
					</div>
					<div id="EnterPassword">
						<fieldset title="Choose your <?=$sitename?> password">
							<legend>Choose your <?=$sitename?> password</legend>
							<div class="Suggestion">
								4-10 characters, no spaces
							</div>
							<div class="Validators">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
							<div class="PasswordRow">
								<label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Password:</label>&nbsp;<input name="Password" type="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox">
							</div>
							<div class="ConfirmPasswordRow">
								<label for="ctl00_cphRoblox_TextBoxPasswordConfirm" id="ctl00_cphRoblox_LabelPasswordConfirm" class="Label">Confirm Password:</label>&nbsp;<input name="PasswordConfirm" type="password" id="ctl00_cphRoblox_TextBoxPasswordConfirm" tabindex="3" class="TextBox">
							</div>
						</fieldset>
					</div>
					<div id="EnterChatMode">
						<fieldset title="Choose your chat mode">
							<legend>Choose your chat mode</legend>
							<div class="Suggestion">
								All in-game chat is subject to profanity filtering and moderation.  For enhanced chat safety, choose SuperSafe Chat; only chat from pre-approved menus will be shown to you.
							</div>
							<div class="ChatModeRow">
								<span id="ctl00_cphRoblox_rblChatMode"><input id="ctl00_cphRoblox_rblChatMode_0" type="radio" name="ctl00$cphRoblox$rblChatMode" value="false" checked="checked" tabindex="6"><label for="ctl00_cphRoblox_rblChatMode_0">Safe Chat</label><br><input id="ctl00_cphRoblox_rblChatMode_1" type="radio" name="ctl00$cphRoblox$rblChatMode" value="true" tabindex="6"><label for="ctl00_cphRoblox_rblChatMode_1">SuperSafe Chat</label></span>
							</div>
						</fieldset>
					</div>
					<div id="EnterEmail">
						<fieldset title="Provide your parent's email address">
							<legend>Provide your parent's email address</legend>
							<div class="Suggestion">
								This will allow you to recover a lost password
							</div>
							<div class="Validators">
								<div></div>
								<div></div>
								<div></div>
							</div>
							<div class="EmailRow">
								<label for="ctl00_cphRoblox_TextBoxEMail" id="ctl00_cphRoblox_LabelEmail" class="Label">Your Parent's Email:</label>&nbsp;<input name="email" type="text" id="ctl00_cphRoblox_TextBoxEMail" tabindex="4" class="TextBox">
							</div>
						</fieldset>
					</div>
					 <div id="EnterPassword">
            <fieldset title="reCAPTCHA">
              <legend>reCAPTCHA</legend>
              <div class="Suggestion">
               To verify it is you
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="g-recaptcha" data-sitekey="6LfFlMwmAAAAAOzXyNS0urpsP756kM0FUKGY9Fxy"></div>
            </fieldset>
          </div>
					<div class="Confirm">
						<input type="submit" name="ctl00$cphRoblox$ButtonCreateAccount" value="Register" id="ctl00_cphRoblox_ButtonCreateAccount" tabindex="5" class="BigButton">
					</div></form>
				
</div>
		</div>
		<div id="Sidebars">
			<div id="AlreadyRegistered">
				<h3>Already Registered?</h3>
				<p>If you just need to login, go to the <a id="ctl00_cphRoblox_HyperLinkLogin" href="Default.aspx?ReturnUrl=%2f">Login</a> page.</p>
				<p>If you have already registered but you still need to download the game installer, go directly to <a id="ctl00_cphRoblox_HyperLinkDownload" href="/web/20070804083927/http://roblox.com/Install/Default.aspx?ReturnUrl=%2f">download</a>.</p>
			</div>
			<div id="TermsAndConditions">
				<h3>Terms &amp; Conditions</h3>
				<p>Registration does not provide any guarantees of service. See our <a id="ctl00_cphRoblox_HyperLinkToS" href="/web/20070804083927/http://roblox.com/Info/TermsOfService.aspx?layout=null" target="_blank">Terms of Service</a> and <a id="ctl00_cphRoblox_HyperLinkEULA" href="/web/20070804083927/http://roblox.com/Info/EULA.htm" target="_blank">Licensing Agreement</a> for details.</p>
				<p><?=$sitename?> will not share your email address with 3rd parties. See our <a id="ctl00_cphRoblox_HyperLinkPrivacy" href="/web/20070804083927/http://roblox.com/Info/Privacy.aspx?layout=null" target="_blank">Privacy Policy</a> for details.</p>
			</div>
		</div>
		<div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>

				</div>
				<?php require($_SERVER["DOCUMENT_ROOT"]."/main/footer.php");
				?>  <script src="https://www.google.com/recaptcha/api.js" async defer></script>