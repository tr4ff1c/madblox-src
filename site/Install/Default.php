<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php"); ?>

<div id="Body">
					
    
    
    <div>
        
        
        
        
        
    </div>
    
    <p id="ctl00_cphRoblox_SystemRequirements1_OS" align="center" style="color: red">Currently, <?=$sitename?> is only available on PCs running the Windows® operating system</p>

    <div style="margin-top: 12px; margin-bottom: 12px">
        <div id="AlreadyInstalled" style="display: none">
            <p><?=$sitename?> is already installed on this computer. If you want to try installing it again then follow the instructions below. Otherwise, you can just <a href="javascript:goBack()">continue</a>.</p>
        </div>
        <img id="ctl00_cphRoblox_Image3" class="Bullet" src="/images/BuildIcon.png" border="0">
        <div id="InstallStep1" style="padding-left: 60px">
            <h2>Download <?=$sitename?></h2>
            <form action="/Install/client.zip"><p><input type="submit" name="ctl00$cphRoblox$ButtonDownload" value="Install <?=$sitename?>" id="ctl00_cphRoblox_ButtonDownload" enabled="enabled" class="BigButton">&nbsp;(Total download about 10Mb)</p></form>
        </div>
        <img id="ctl00_cphRoblox_Image4" class="Bullet" src="/images/FriendsIcon.png" border="0">
        <div id="InstallStep2" style="padding-left: 60px">
            <h2>Run the Installer</h2>
            <p>A window will open asking what you want to do with a file called Setup.exe.</p>
            <p>Click 'Run'. You might see a confirmation message, asking if you're sure you want to run this software. Click 'Run' again.</p>
            <p><img id="ctl00_cphRoblox_Image1" src="/images/Install/DownloadPrompt.png" border="0"></p>
        </div>
        <img id="ctl00_cphRoblox_Image5" class="Bullet" src="/images/BattleIcon.png" border="0">
        <div id="InstallStep3" style="padding-left: 60px">
            <h2>Follow the Setup Wizard</h2>
            <p>When the download has finished, the <?=$sitename?> Setup Wizard will appear and guide you through the rest of the installation.</p>
            <p><img id="ctl00_cphRoblox_Image2" src="/images/Install/Wizard.png" border="0"></p>
        </div>
    </div>

				</div>