<?php
$con = mysqli_connect('localhost', "root", "momo", "quicktalk");
mysqli_query($con, "SET time_zone='+00:00'");

date_default_timezone_set("UTC");

if(mysqli_connect_errno()) {
    echo "failed connect to MySQL: ".mysqli_error();
    exit();
}