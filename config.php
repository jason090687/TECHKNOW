<?php
$server_name = "localhost";
$username = "root";
$pwd = "";
$dbname = "r10_ecommerce";

$connect = mysqli_connect($server_name, $username, $pwd, $dbname);

if(!$connect){
	die("Connection Failed");
}
?>