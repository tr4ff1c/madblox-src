<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php"); ?>


  
  <div id="FrameLogin" style="margin: 50px auto 150px auto; width: 500px; border: black thin solid; padding: 40px; z-index: 28; background-color: white;">
  <div id="FrameMaintenance" style="text-align: center;">
    <h1>MLGBLOX down for weekly regular security maintenance</h1>
    <p>We are checking security of the site, check us later!</p>
    <br></br>
    <?php
    if(isset($_POST['accessCode'])) {
      $accessCode = $_POST['accessCode'];
      if($accessCode === '123') {
        setcookie('securitypassmlg', 'true', time() + (86400 * 30), '/', '', false, true);
        header('Location: /default.aspx');
        exit;
      } else {
        echo "<p style='color: red;'>Incorrect access code. Please try again.</p>";
      }
    }
    ?>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
      <label for="accessCode">Access Code:</label>
      <input type="password" id="accessCode" name="accessCode" required>&nbsp;
      <input type="submit" value="Submit">
    </form>
  </div>
      </div>
    </div>
  </div>

  <?php require_once($_SERVER['DOCUMENT_ROOT']."/core/footer.php"); ?>