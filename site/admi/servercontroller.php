<?php require_once('include.php'); ?>
<center>
    <img id="serverPreview" src="/img/servercontroller/screenshot.png?rand=<?php echo random_int(1, getrandmax()); ?>" style="width: 100%;">
    <button onclick='screenshot();'>Screenshot</button><br>
    <input id="moveMouseX" type="number" placeholder="x"><input id="moveMouseY" type="number" placeholder="Y"><button onclick='moveMouse(document.querySelector("#moveMouseX").value, document.querySelector("#moveMouseY").value);'>Move Mouse</button><br>
    <button onclick='mouseClick();'>Mouse Click</button><br>
    <input id="keyTap" type="text" placeholder="Key"><button onclick='keyTap(document.querySelector("#keyTap").value);'>Tap Key</button><br>
    <input id="typeString" type="text" placeholder="String"><button onclick='typeString(document.querySelector("#typeString").value);'>Type String</button>
</center>
<script>
setInterval(() => {
    document.querySelector("#serverPreview").src = "/img/servercontroller/screenshot.png?rand=" + Math.floor(Math.random() * (9999999999999)) + 1;
}, 700);
let mousePos = {x: 0, y: 0}
document.getElementById('serverPreview').addEventListener('mousemove', (event) => {
    var img = event.target;
    var rect = img.getBoundingClientRect();
    var scaleX = img.naturalWidth / img.width;
    var scaleY = img.naturalHeight / img.height;
    
    mousePos.x = (event.clientX - rect.left) * scaleX;
    mousePos.y = (event.clientY - rect.top) * scaleY;
});
document.getElementById('serverPreview').addEventListener('click', (event) => {
    moveAndClickMouse(mousePos.x, mousePos.y);
});
async function screenshot() {
    await fetch("addservercontrolleraction.aspx?action=screenshot");
}
async function moveMouse(x, y) {
    await fetch("addservercontrolleraction.aspx?action=moveMouse&value1=" + x + "&value2=" + y);
}
async function mouseClick() {
    await fetch("addservercontrolleraction.aspx?action=mouseClick");
}
async function moveAndClickMouse(x, y) {
    await fetch("addservercontrolleraction.aspx?action=moveAndClickMouse&value1=" + x + "&value2=" + y);
}
async function keyTap(key) {
    await fetch("addservercontrolleraction.aspx?action=keyTap&value1=" + key);
}
async function typeString(string) {
    await fetch("addservercontrolleraction.aspx?action=typeString&value1=" + string);
}
</script>