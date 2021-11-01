<?php 

//Bắt đầu phiên làm việc
session_start();

$server_host = "localhost";
$server_user = "root";
$server_pass = "";
$server_db   = "web";

//Thiet lap ket noi den database
$conn = mysqli_connect($server_host, $server_user, $server_pass, $server_db);
//Thiet tap truy van la UTF8 trong truong hop tieng viet co dau
mysqli_query($conn, "SET NAMES 'UTF8'");

?>