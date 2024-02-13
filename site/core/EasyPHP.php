<?php

class EasyPHP {
/*
  Used to automatically connect to database
  easier and faster.
*/
private $db;

function ConnectDatabase($hostt, $dbb, $usr, $passs){
$host = $hostt;
$dbname = $dbb;
$username = $usr;
$password = $passs;

try {
    $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "[EasyPHP Logs]: " . $e->getMessage();
}

}

/*
  Execute a query, Please don't
  mess this up or else it wont work
  correctly.
*/

function SqlQuery($sql, $fetchOrNot, $fetchAllOrNot, $exArgs) {
    if($fetchOrNot !== true && $fetchOrNot !== false){
	die("[EasyPHP Logs]: Invalid value for 2nd argument, please input true or false.");
    }
    if($fetchAllOrNot !== true && $fetchAllOrNot !== false){
	die("[EasyPHP Logs]: Invalid value for 3rd argument, please input true or false.");
    }
    $stmt = $this->db->prepare($sql);
    $stmt->execute($exArgs);
    if($fetchOrNot == true && $fetchAllOrNot !== true){
	$stmt->fetch(PDO::FETCH_ASSOC);
    }
    if($fetchAllOrNot == true && $fetchOrNot !== true){
	$stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

}


?>