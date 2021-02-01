<?php 

require_once("connections/connect.php");

function timing ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1) ? 1 : $time;
    $tokens = array (
        31536000 => 'ano',
        2592000 => 'mês',
        604800 => 'semana',
        86400 => 'dia',
        3600 => 'hora',
        60 => 'minuto',
        1 => 'segundo'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        if ($text == "segundo") {
            return "agora mesmo";
        }
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

if(!isset($_COOKIE["ID"]) || !isset($_COOKIE["TOKEN"]) || !isset($_COOKIE["SECURE"])) die(header('location: http://localhost:8080/auth.html'));

$id = $_COOKIE["ID"];
$token = $_COOKIE["TOKEN"];
$secure = $_COOKIE["SECURE"];

// $sql = "SELECT id, Username, Picture, Online, Creation FROM User WHERE (id = ? AND Token LIKE ? AND Secure = ?) LIMIT 1";
$stmt = $con->prepare("SELECT id, Username, Picture, Online, Creation FROM User WHERE (id = ? AND Token = ? AND Secure = ?) LIMIT 1;");
$stmt->bind_param("isi", $id, $token, $secure);
$stmt->execute();
$me = $stmt->get_result()->fetch_assoc();
if (empty($me)) die(header('location: http://localhost:8080/auth.html'));

$user_id = $me['id'];
$username = $me['Username'];
$user_picture = $me['Picture'];
$user_online = strtotime($me['Online']);
$user_creation = date('d/m/Y', strtotime($me['Creation']));

$sql = "UPDATE User SET `Online` = now() WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
