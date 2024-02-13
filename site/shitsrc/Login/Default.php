<?php
require($_SERVER["DOCUMENT_ROOT"]."/main/nav.php");

if ($loggedin) {
    header("location: /");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
	$username = filter_var($_POST['UserName'], FILTER_SANITIZE_STRING);
	$stmt = $db->prepare("SELECT id, username, password FROM users WHERE username=?");
	$stmt->execute([$username]);
	if($stmt->rowCount() > 0){
		$a = $stmt->fetch(PDO::FETCH_ASSOC);
		$password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
		$hashedPassword = $a['password'];
		if(password_verify($password, $hashedPassword)){
			$_SESSION['id'] = $a['id'];
			$_SESSION['loggedin'] = true;
			header("location: /Api/RenderAvatar.aspx");
			exit;
		}else{
			die("Invalid username or password.");
		}
	}else{
		die("Invalid username or password.");
	}
}
?>
<div id="Body">
					
	<script type="text/javascript">
		function signUp()
		{
			window.location = "/Login/New.aspx";
		}
	</script>
	<div id="FrameLogin" style="margin: 50px auto 150px auto; width: 500px; border: black thin solid; padding: 21px; z-index: 8; background-color: white;">
		<div id="PaneNewUser">
			<h3>New User?</h3>
			<p>You need an account to play <?=$sitename?>.</p>
			<p>If you aren't a <?=$sitename?> member then <a id="ctl00_cphRoblox_HyperLink1" href="NewAge.aspx">register</a>. It's easy and we do <em>not</em> share your personal information with anybody.</p>
		</div>
		<div id="PaneLogin">
			<h3>Log In</h3>
			
<div class="AspNet-Login"><form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
	<div class="AspNet-Login-UserPanel">
		<label for="ctl00_cphRoblox_lRobloxLogin_UserName" class="TextboxLabel"><em>U</em>ser Name:</label>
		<input type="text" id="ctl00_cphRoblox_lRobloxLogin_UserName" name="UserName" value="" accesskey="u">&nbsp;
	</div>
	<div class="AspNet-Login-PasswordPanel">
		<label for="ctl00_cphRoblox_lRobloxLogin_Password" class="TextboxLabel"><em>P</em>assword:</label>
		<input type="password" id="ctl00_cphRoblox_lRobloxLogin_Password" name="Password" value="" accesskey="p">&nbsp;
	</div>
	<div class="AspNet-Login-SubmitPanel">
		<input type="submit" value="Log In" id="ctl00_cphRoblox_lRobloxLogin_LoginButton" name="ctl00$cphRoblox$lRobloxLogin$LoginButton" onclick="WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$lRobloxLogin$LoginButton&quot;, &quot;&quot;, true, &quot;ctl00$cphRoblox$lRobloxLogin&quot;, &quot;&quot;, false, false))">
	</div>
	<div class="AspNet-Login-PasswordRecoveryPanel">
		<a href="ResetPasswordRequest.aspx" title="Password recovery">Forgot your password?</a>
	</div>
</div></form>
		</div>
	</div>

				</div>
				<?php
require($_SERVER["DOCUMENT_ROOT"]."/main/footer.php");
?>