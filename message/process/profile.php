<?php 

require_once("check.php");

if (empty($_GET["id"])) die(header("HTTP/1.0 401 id not found."));

$id = addslashes(strip_tags($_GET["id"]));

if ($id == 0) {
    $id = $user_id;
}