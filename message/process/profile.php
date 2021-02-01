<?php 

require_once("check.php");

if (!isset($_GET["id"])) die(header("HTTP/1.0 401 param id not found."));

$id = addslashes(strip_tags($_GET["id"]));
$json = new stdClass();
if ($id == 0) {
    $json->profileRegister = true;
    $id = $user_id;
    
    $json->user_picture = $user_picture;
} else {
    $json->prfileRegister = false;
    $stmt = $con->prepare("SELECT id, Username, Picture, Online, Creation FROM User WHERE (id = ? AND Token = ? AND Secure = ?) LIMIT 1;");
    $stmt->bind_param("isi", $id, $token, $secure);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if (empty($user)) die(header("HTTP/1.0 401 error at load profile of ueser."));

    $username = $user['Username'];
    $user_picture = $user['Picture'];
    $user_online = strtotime($user['Online']);
    $user_creation = date('d/m/Y', strtotime($user['Creation']));

    $json->user_picture = $user_picture;
}

$user_online = timing($user_online);

$json->username = $username;
$json->user_online = $user_online;
$json->user_creation = $user_creation;

$json = json_encode($json);

die($json);