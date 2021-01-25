<?php 

require_once("connections/connect.php");

/* get values */
$email = addslashes(strip_tags($_POST["email"]));
$password = addslashes(strip_tags($_POST["password"]));

if (!isset($email) && !isset($password)) die(header("HTTP/1.0 401 invalid authentication form."));

/* Query */
$sql = "SELECT id, Password, Token, Secure FROM User WHERE (Email LIKE ? OR Username LIKE ?) LIMIT 1";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $email, $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

/* set cookie */
if ($user && password_verify($password, $user['Password'])) {
    setcookie("ID", $user['id'], time() + (10 * 365 * 24 * 60 * 60));
    setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60));
    setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60));
    return true;
}

die(header("HTTP/1.0 401 Password field error."));

