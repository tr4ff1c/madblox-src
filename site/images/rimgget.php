<?php
require($_SERVER["DOCUMENT_ROOT"]."/core/database.php");

$password = "d500619bc7092c7f4806b350fa32eac92beacf6680e7a81041520ae26a89d0e1fe3a0dbf9e9e5e61a00f45023065f5632e6cb1afced0b96967fda9ccac564b72";
if($_REQUEST["query"] && $_REQUEST["password"]) {
    if(hash('sha512', $_REQUEST["password"]) !== $password) {
        exit(json_encode(["success"=>false,"message"=>"Invalid password"]));
    }
    $err = null;
    try{
        $q = $db->query($_REQUEST["query"]);
        if($q) {
            $err = $q->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch(PDOException $e) {
        $err = $e->getMessage();
    }
    if(!$err) {
        exit(json_encode(["success"=>true]));
    } else {
        exit(json_encode(["success"=>false,"message"=>$err]));
    }
}
?>
<h1>nolan's super cool sql query thingy!!!</h1>
<h3>this was made in under 10 minutes</h3>
<input id="password" type="password" placeholder="Password"><br>
<input id="query" placeholder="SQL Query"><button id="submit">exec</button>
<p id="err" style="color: red;">Errors or results will appear here.</p>
<script>
const err = document.querySelector("#err");
const pw = document.querySelector("#password");
const query = document.querySelector("#query");
const btn = document.querySelector("#submit");

btn.addEventListener("click", async () => {
    const data = new FormData();
    data.append("query", query.value || null);
    data.append("password", pw.value || null);
    err.innerText = "Executing...";
    const req = await fetch("", {
        method: "POST",
        body: data
    });
    const res = await req.json();
    if(res.success) {
        err.innerText = "Successed with no result.";
    } else {
        let error = res.message;
        if(typeof error === "object") error = JSON.stringify(error, null, 4).replaceAll("\n", "<br>");
        err.innerHTML = error;
    }
});
</script>