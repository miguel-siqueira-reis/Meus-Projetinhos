<?php 
require_once('connections/connect.php');

[
    'username' => $username,
    'email' => $email,
    'password' => $password,
    'repPassword' => $repPassword
] = $_POST;

if (empty($username) || empty($email) || empty($password) || empty($repPassword)) die(header("HTTP/1.0 401 invalid authentication form."));


function alreadyExists($con, $value, $colunm) {
    $sql = "SELECT id FROM User WHERE $colunm = ? LIMIT 1";
    $check = $con->prepare($sql);
    $check->bind_param("s", $value);
    $check->execute();
    $result = $check->get_result()->num_rows;
    if ($result > 0) die(header("HTTP/1.0 401 this $colunm already exists."));
}

alreadyExists($con ,$username, 'Username');
alreadyExists($con, $email, 'Email');

if ($password != $repPassword) die(header("HTTP/1.0 401 passwords different."));

$password = password_hash($password, PASSWORD_DEFAULT);

$token = bin2hex(openssl_random_pseudo_bytes(20));
$secure = rand(1000000, 99999999999);

$sql = "INSERT INTO User (Username, Email, Password, Online, Token, Secure, Creation) VALUES (?, ?, ?, now(), ?, ?, now())";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssi", $username, $email, $password, $token, $secure);
$stmt->execute();

$sql = "SELECT id, Token, Secure FROM User WHERE Email = ?";
$getUser = $con->prepare($sql);
$getUser->bind_param("s", $email);
$getUser->execute();
$user = $getUser->get_result()->fetch_assoc();

if ($stmt && $user) {
    setcookie("ID", $user['id'], time() + (10 * 365 * 24 * 60 * 60), '/');
    setcookie("TOKEN", $user['Token'], time() + (10 * 365 * 24 * 60 * 60), "/");
    setcookie("SECURE", $user['Secure'], time() + (10 * 365 * 24 * 60 * 60), "/");
    return true;
}

die(header("HTTP/1.0 401 error in database"));

