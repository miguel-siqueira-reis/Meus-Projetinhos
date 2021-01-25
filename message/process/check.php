<?php 

require_once("connections/connect.php");

$json = "location.href = './auth.html';";

$json = json_encode($json);

if(!isset($_COOKIE["ID"]) || !isset($_COOKIE["TOKEN"]) || !isset($_COOKIE["SECURE"])) die($json);

$id = $_COOKIE["ID"];
$token = $_COOKIE["TOKEN"];
$secure = $_COOKIE["SECURE"];

// $sql = "SELECT id, Username, Picture, Online, Creation FROM User WHERE (id = ? AND Token LIKE ? AND Secure = ?) LIMIT 1";
$stmt = $con->prepare("SELECT id, Username, Picture, Online, Creation FROM User WHERE (id = ? AND Token = ? AND Secure = ?) LIMIT 1;");
$stmt->bind_param("isi", $id, $token, $secure);
$stmt->execute();
$me = $stmt->get_result()->fetch_assoc();
if (empty($me)) die($json);

$user_id = $me['id'];
$username = $me['Username'];
$user_picture = $me['Picture'];
$user_online = strtotime($me['Online']);
$user_creation = date('d/m/Y', strtotime($me['Creation']));

$sql = "UPDATE User SET `Online` = now() WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
