<?php
require_once("nav.php");

if($loggedin == "yes"){
header("Location: home.php");
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty(trim($_POST["username"]))) {
        die("Please enter username.");
    }

    if (empty(trim($_POST["password"]))) {
	die("Please enter your password.");
    }
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$passwordd = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$a = $db->prepare("SELECT id, username, password FROM users WHERE username=?");
	$a->execute([$username]);
	$arows = $a->rowCount();

	if($arows > 0){
		$row = $a->fetch(PDO::FETCH_ASSOC);
		$hashed_password = $row['password'];
		if (password_verify($passwordd, $hashed_password)) {
			session_start();
			$_SESSION['id'] = $row['id'];
			header("location: /home.php");
			exit;
		}else{
			die("Wrong password.");
		}
	} else {
		die("User not found.");
	}
	
	
} else {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<title><?=$sitename?> | Login</title>
<br><br><br><br>
<center>
<div class="card text-white bg-dark mb-3" style="max-width: 60rem;">
<center>
<br>
<br>
                <div class="clearfix visible-sm"></div>
                <div class="col-xs-12 col-md-6">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post"><div id="SignUpFormContainer" data-return-url="">
                         
    <div class="" data-parent-url="" data-is-from-studio="false" data-is-facebook-button-shown="false">
        <div class="rbx-login-partial-legacy">
                <h3 class="text-center login-header">
                    Log in
                </h3><br><br>


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
                <input id="signup-username" ng-trim="false" ng-change="onChange()" name="username" class="form-control input-field ng-pristine ng-invalid ng-invalid-validusername" type="text" tabindex="1" rbx-valid-username="" rbx-form-interaction="" rbx-form-validation="" placeholder="Username" value="" ng-model="signup.username">
                <p id="signup-usernameInputValidation" class="form-control-label input-validation text-error ng-binding" ng-bind="(badSubmit || signupForm.username.$dirty) ? signupForm.username.$validationMessage : ''"></p>
            </div>
            <div class="form-group" ng-class="{'has-error' : (badSubmit || signupForm.password.$dirty) &amp;&amp; signupForm.password.$invalid, 'has-success': (signupForm.password.$dirty &amp;&amp; signupForm.password.$valid) }">
                <input id="signup-password" ng-trim="false" name="password" class="form-control input-field ng-pristine ng-invalid ng-invalid-password" type="password" tabindex="2" rbx-valid-password="" rbx-form-interaction="" rbx-form-validation="" rbx-form-validation-redact-input="" placeholder="Password" ng-model="signup.password">
                <p id="signup-passwordInputValidation" class="form-control-label input-validation text-error ng-binding" ng-bind="(badSubmit || signupForm.password.$dirty) ? signupForm.password.$validationMessage : ''"></p>
            </div>
            
            
</div>

            <button type="submit" class="btn btn-primary">Log In</button>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <noscript>
                <div class="text-danger">
                    <strong>JavaScript is required to submit this form.</strong>
                </div>
            </noscript>
            <div id="GeneralErrorText" class="input-validation-large alert-warning font-bold ng-binding ng-hide" ng-show="signupForm.$generalError" ng-bind="signupForm.$generalErrorText" ng-click="signupForm.$generalError=false"></div>
        </div><br><br> You don't own a account? Then you can <a href="index.php">register</a>
    </div></form></div></center></center>

