<?php

require_once("check.php");

if ($_GET['term']) {
    $term = $_GET['term'];
    $username = mysqli_real_escape_string($con, $term);

    $stmt = $con->prepare("SELECT id,  Username, Picture FROM User WHERE (Username LIKE '%$username%' AND id != $user_id)  ORDER BY Username DESC LIMIT 20");
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;
    
    $json = [];
    if ($count > 0) {
        while($user = $result->fetch_assoc()) {
            $arrayUser = [
                "id" => $user['id'],
                "picture" => $user['Picture'],
                "username" => $user['Username']
            ];
            $json[] = $arrayUser;
        }
        $json = json_encode($json);
        die($json);
    } else {
        $json = new stdClass();
        $json->notFound = true;
        $json = json_encode($json);
        die($json);
    }

};
