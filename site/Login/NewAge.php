

<?php


require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');


die("Registration disabled, come back later.");

if ($loggedin === "yes") {
    header("location: /");
    exit;
}

require_once $_SERVER["DOCUMENT_ROOT"]."/ReCaptcha.php";

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

?>
<?php
$error = 'NULL';
    if($_SERVER["REQUEST_METHOD"] == "POST") {

      $username = trim($_POST['username']);
      $email = trim($_POST['email']);
      $password = htmlspecialchars($_POST['password']);
      $confirm_password = htmlspecialchars($_POST['confirm_password']);
      $referral = htmlspecialchars(trim($_POST['referral']));

      $code = $db->quote(md5(rand()));
	
      if($referral != NULL){
      $referralQ = $db->prepare("SELECT * FROM users WHERE username=:rf");
      $referralQ->execute([":rf" => $referral]);
      $refral = $referralQ->rowCount();

      if($refral < 1){
	/*$error = die("Unknown referral");
	exit;*/
      }
      }

      if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
          $error = die("Please fill out all fields.");
          exit;
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = die("Please enter a valid email address.");
          exit;
      }
      if ($password !== $confirm_password) {
          $error = die("Passwords do not match.");
          exit;
      }
      
      if (!$captcha_completed) {
        $error = die("reCAPTCHA failed, please try again.");
	exit;
      }

      if (strlen($username) == 0) {
        $error = die("Your username must be at least 3 characters.");
	exit;
      }
      
      if (strlen($username) < 3) {
        $error = die("Your username must be at least 3 characters.");
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

      if(isFiltered($username)) {
        die("Username is inappropriate");
      }

    
      $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {
          $error = "Username or email already registered.";
          exit;
      }

      $stmt = $db->prepare("INSERT IGNORE INTO users (id, username, email, password, referral) VALUES (NULL, :username, :email, :password, :referral)");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT, [ "cost" => 12 ]));
      $stmt->bindParam(':referral', $referral);
      $stmt->execute();

      $sqlq = $db->prepare("SELECT * from users WHERE username = ?");
      $sqlq->execute([$username]);
      $user = $sqlq->fetch(PDO::FETCH_ASSOC);

      $sessKey = generateSessionCookie();
      $id = $user['id'];
      $time = time();
      $q = $db->prepare("INSERT INTO `sessions` (`id`, `sessKey`, `userId`, `created`) VALUES (NULL, :session, :id, :time)");
      $q->bindParam(':session', $sessKey, PDO::PARAM_STR);
      $q->bindParam(':id', $id, PDO::PARAM_INT);
      $q->bindParam(':time', $time, PDO::PARAM_INT);
      $q->execute();
      setSessionCookie($sessKey);

      header('location: /api/render.aspx');
      exit;
}
?>
<div id="Registration">
      <div id="ctl00_cphRoblox_upAccountRegistration">
  
          <h2>Sign Up and Play</h2>
          <h3>Create Account</h3>
          <form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
          
          <div id="EnterUsername">
            <fieldset title="Choose a name for your <?=$sitename ?> character">
              <legend>Choose a name for your <?=$sitename ?> character</legend>
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
                <label for="ctl00_cphRoblox_UserName" id="ctl00_cphRoblox_UserNameLabel" class="Label">Character Name:</label>&nbsp;<input name="username" type="text" id="ctl00_cphRoblox_UserName" tabindex="1" class="TextBox"/>
              </div>
            </fieldset>
          </div>
          <div id="EnterPassword">
            <fieldset title="Choose your <?=$sitename ?> password">
              <legend>Choose your <?=$sitename ?> password</legend>
              <div class="Suggestion">
                Passwords must be atleast 8 characters
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="PasswordRow">
                <label for="ctl00_cphRoblox_Password" id="ctl00_cphRoblox_LabelPassword" class="Label">Password:</label>&nbsp;<input name="password" type="password" id="ctl00_cphRoblox_Password" tabindex="2" class="TextBox"/>
              </div>
              <div class="ConfirmPasswordRow">
                <label for="ctl00_cphRoblox_TextBoxPasswordConfirm" id="ctl00_cphRoblox_LabelPasswordConfirm" class="Label">Confirm Password:</label>&nbsp;<input name="confirm_password" type="password" id="ctl00_cphRoblox_TextBoxPasswordConfirm" tabindex="3" class="TextBox"/>
              </div>
            </fieldset>
          </div>
          
          
          <div id="EnterEmail">
            <fieldset title="Provide your parent's email address">
              <legend>Provide your email address</legend>
              <div class="Suggestion">
                This will allow you to recover a lost password
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="EmailRow">
                <label for="ctl00_cphRoblox_TextBoxEMail" id="ctl00_cphRoblox_LabelEmail" class="Label">Your Email:</label>&nbsp;<input name="email" type="text" id="ctl00_cphRoblox_TextBoxEMail" tabindex="4" class="TextBox"/>
              </div>
            </fieldset>
          </div>
            <div id="EnterEmail">
            <fieldset title="Provide a referral">
              <legend>Provide a referral</legend>
              <div class="Suggestion">
                Enter the username of the person that has referred you to <?=$sitename?>. This is optional.
              </div>
              <div class="Validators">
                <div></div>
                <div></div>
                <div></div>
              </div>
              <div class="EmailRow">
                <label for="ctl00_cphRoblox_TextBoxEMail" id="ctl00_cphRoblox_LabelEmail" class="Label">Username:</label>&nbsp;<input name="referral" type="text" id="ctl00_cphRoblox_TextBoxEMail" tabindex="4" class="TextBox"/>
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
            <input type="submit" name="ctl00$cphRoblox$ButtonCreateAccount" value="Register" id="ctl00_cphRoblox_ButtonCreateAccount" tabindex="5" class="BigButton"/>
          </div>
            </form>
        
</div>
    </div>
    <div id="Sidebars">
      <div id="AlreadyRegistered">
        <h3>Already Registered?</h3>
        <p>If you just need to login, go to the <a id="ctl00_cphRoblox_HyperLinkLogin" href="login.aspx">Login</a> page.</p>
        <p>If you have already registered but you still need to download the game installer, go directly to <a id="ctl00_cphRoblox_HyperLinkDownload" href="/Install/Default.aspx">download</a>.</p>
      </div>
      <div id="TermsAndConditions">
        <h3>Terms &amp; Conditions</h3>
        <p>Registration does not provide any guarantees of service.</p>
        <p><?=$sitename ?> will not share your email address with 3rd parties.</p>
      </div>
    </div>
    <div id="ctl00_cphRoblox_ie6_peekaboo" style="clear: both"></div>

                <?php
include '../core/footer.php';
?>
            </div>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 