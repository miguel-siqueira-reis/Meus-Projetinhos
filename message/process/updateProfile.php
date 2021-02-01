<?php

require_once("check.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') die(header('HTTP/1.0 401 param not found'));
$image_name = $username."__".rand(999, 999999).$_FILES['imgInp']['name'];
$image_temp = $_FILES['imgInp']['tmp_name'];
$image_path = '../profilePics/';

if($user_picture != 'user.png') {
    unlink($image_path.$user_picture);
}

if (!is_uploaded_file($image_temp)) die(header('HTTP/1.0 401 Error in upload file'));
if (!move_uploaded_file($image_temp, $image_path.$image_name)) die(header('HTTP/1.0 401 Error in save uploaded.'));
$stmt = $con->prepare("UPDATE User SET Picture = ? WHERE id = ?");
$stmt->bind_param('si', $image_name, $user_id);
$stmt->execute();
if (!$stmt) die(header('HTTP/1.0 401 Error not save image in database.'));
echo 'oi';