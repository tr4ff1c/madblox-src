<?php
require_once("config.php");

if($loggedin == "yes"){
header("Location: home.php");
exit;
}

$response = null;
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        //die("CSRF Token Validation Failed please retry");
    //}

 if (!$captcha_completed) {
        die("reCAPTCHA failed, please try again.");
      }

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirmPassword = $_POST['passwordConfirm'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

   if (strlen($username) < 3 || strlen($username) > 20) {
        die("Username must be between 3 and 20 characters.");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters.");
    }

    if ($password !== $confirmPassword) {
        die("Password and Confirm Password do not match.");
    }

    if (preg_match('/[^a-zA-Z\d]/', $username)) {
        die("Username contains special characters");
	exit;
    }


    try {
        $searchusr = $db->prepare("SELECT * FROM users WHERE username=?");
        $searchusr->execute([$username]);
        $usrs = $searchusr->rowCount();
        if($usrs > 0){
		die("User already exists");
	}
        $stmt = $db->prepare("INSERT IGNORE INTO users (id, username, password) VALUES (NULL, ?, ?)");
        $stmt->execute([$username, $hashedPassword]);
       $user_id = $db->lastInsertId();
        $_SESSION['id'] = $user_id;

        header("Location: home.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<center>
<img src="/content/images/header.png"><br>Powering Nostalgia<br><br><br>
</center>
<link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.css"/>
<style>
body { }
</style>
<title><?=$sitename?> | Register</title>
<br><br><br><br>
<center>
<div class="card text-white bg-info mb-3" style="max-width: 60rem;">
<center>
<br>
<br>
                <div class="clearfix visible-sm"></div>
                <div class="col-xs-12 col-md-6">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post"><div id="SignUpFormContainer" data-return-url="">
                         
    <div class="" data-parent-url="" data-is-from-studio="false" data-is-facebook-button-shown="false">
        <div class="rbx-login-partial-legacy">
                <h3 class="text-center signup-header">
                    Sign up and start having fun!
                </h3>
                <h3 class="text-center login-header" style="display: none;">
                    Log in and start having fun!
                </h3>


<style type="text/css">
    .male {
        background-image: url('https://web.archive.org/web/20160819121539im_/https://images.rbxcdn.com/856241927a2ac609e3033feada3ef9f9.png');
        background-repeat: no-repeat;
    }
    .female {
        background-image: url('https://web.archive.org/web/20160819121539im_/https://images.rbxcdn.com/a0afd0556163477e1023c5aa55d1b9f6.png');
        background-repeat: no-repeat;
    }
</style>

<div class="signup-or-log-in new-username-pwd-rule ng-scope" ng-modules="SignupOrLogin" ng-controller="SignupOrLoginController" data-metadata-params="{&quot;isEligibleForHideAdsAbTest&quot;:&quot;True&quot;}" data-v2-username-password-rules-enabled="1" data-is-login-default-section="false">

    

    <div class="signup-container ng-scope" ng-controller="SignupController" ng-show="isSectionShown">
        <div class="signup-input-area ng-pristine ng-invalid ng-invalid-validusername ng-invalid-password ng-invalid-birthday ng-invalid-match" ng-form="" name="signupForm" rbx-form-context="" context="RollerCoaster">
             

<img src="/content/images/rbx.png" style="position: absolute">
            <div class="form-group" ng-class="{'has-error' : (badSubmit || signupForm.username.$dirty) &amp;&amp; signupForm.username.$invalid, 'has-success': (signupForm.username.$dirty &amp;&amp; signupForm.username.$valid) }">
                <input id="signup-username" ng-trim="false" ng-change="onChange()" name="username" class="form-control input-field ng-pristine ng-invalid ng-invalid-validusername" type="text" tabindex="1" rbx-valid-username="" rbx-form-interaction="" rbx-form-validation="" placeholder="Username (don't use your real name)" value="" ng-model="signup.username">
                <p id="signup-usernameInputValidation" class="form-control-label input-validation text-error ng-binding" ng-bind="(badSubmit || signupForm.username.$dirty) ? signupForm.username.$validationMessage : ''"></p>
            </div>
            <div class="form-group" ng-class="{'has-error' : (badSubmit || signupForm.password.$dirty) &amp;&amp; signupForm.password.$invalid, 'has-success': (signupForm.password.$dirty &amp;&amp; signupForm.password.$valid) }">
                <input id="signup-password" ng-trim="false" name="password" class="form-control input-field ng-pristine ng-invalid ng-invalid-password" type="password" tabindex="2" rbx-valid-password="" rbx-form-interaction="" rbx-form-validation="" rbx-form-validation-redact-input="" placeholder="Password (minimum length 8)" ng-model="signup.password">
                <p id="signup-passwordInputValidation" class="form-control-label input-validation text-error ng-binding" ng-bind="(badSubmit || signupForm.password.$dirty) ? signupForm.password.$validationMessage : ''"></p>
            </div>
            <div class="form-group" ng-class="{'has-error' : (badSubmit || signupForm.passwordConfirm.$dirty) &amp;&amp; signupForm.passwordConfirm.$invalid, 'has-success': (signupForm.passwordConfirm.$dirty &amp;&amp; signupForm.passwordConfirm.$valid) }">
                <input id="signup-password-confirm" ng-trim="false" name="passwordConfirm" class="form-control input-field ng-isolate-scope ng-pristine ng-invalid ng-invalid-match" match="signup.password" rbx-valid-password-confirm="" rbx-form-interaction="" rbx-form-validation="" rbx-form-validation-redact-input="" type="password" tabindex="3" placeholder="Confirm Password" ng-model="signup.passwordConfirm">
                <p id="signup-passwordConfirmInputValidation" class="form-control-label input-validation text-error ng-binding" ng-bind="(badSubmit || signupForm.passwordConfirm.$dirty) ? signupForm.passwordConfirm.$validationMessage : ''"></p>
            </div>
            
            
</div>

            <div class="legal-text-container">
                By signing up you agree to our <a href="https://web.archive.org/web/20160819121539/https://www.roblox.com/info/terms-of-service" target="_blank">Terms</a> and <a href="https://web.archive.org/web/20160819121539/https://www.roblox.com/Info/Privacy.aspx" target="_blank">Privacy Policy</a> 
            </div>
            <button type="submit" class="btn-lg">Sign Up</button>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <noscript>
                <div class="text-danger">
                    <strong>JavaScript is required to submit this form.</strong>
                </div>
            </noscript>
<fieldset title="reCAPTCHA">
              
              <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
            </fieldset>
            <div id="GeneralErrorText" class="input-validation-large alert-warning font-bold ng-binding ng-hide" ng-show="signupForm.$generalError" ng-bind="signupForm.$generalErrorText" ng-click="signupForm.$generalError=false"></div>
        </div><br><br> Or you can <a href="login.php">Login</a>
    </div></form></div></center></center>

