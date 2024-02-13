<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php");

if ($loggedin === "yes") {
    header("location: /");
    exit;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($password)) {
        die("Please enter both username and password.");
    } else {
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $sessKey = generateSessionCookie();
            $id = $user["id"];
            $time = time();
            $q = $db->prepare("INSERT INTO `sessions` (`id`, `sessKey`, `userId`, `created`) VALUES (NULL, :session, :id, :time)");
            $q->bindParam(':session', $sessKey, PDO::PARAM_STR);
            $q->bindParam(':id', $id, PDO::PARAM_INT);
            $q->bindParam(':time', $time, PDO::PARAM_INT);
            $q->execute();
            setSessionCookie($sessKey);
            header("location: /");
            exit;
        } else {
            die("Invalid username or password.");
        }
    }
}
?>
<div id="Body">
<div id="FrameLogin" style="margin: 50px auto 150px auto; width: 500px; border: black thin solid; padding: 21px; z-index: 8; background-color: white;">
    <div id="PaneNewUser">
      <h3>New User?</h3>
      <p>You need an account to play <?=$sitename?>.</p>
      <p>If you aren't a <?=$sitename?> member then <a id="ctl00_cphRoblox_HyperLink1" href="/Login/NewAge.aspx">register</a>. It's easy and we do <em>not</em> share your personal information with anybody.</p>
    </div>
    <div id="PaneLogin">
      <h3>Log In</h3>
      
<div class="AspNet-Login"><div style="color:red; text-align:center;"></div><form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
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
  </form>
</div>
    </div>
  </div>
                               
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/footer.php");
?>
</div>