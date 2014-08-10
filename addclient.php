<?php
$mongo = new MongoClient();
$db = $mongo -> selectDB("weichatuserinfo");
$conllection = $db -> userinfo;

$userid = trim($_GET['userid']);

// $userip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];  
// $userip = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];  


$userip = $_SERVER["REMOTE_ADDR"];
echo $userip;

$conllection -> update(array("user_id" => (int)$userid), array('$set' => array("user_ip" => $userip)));