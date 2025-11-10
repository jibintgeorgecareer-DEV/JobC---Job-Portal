<?php  
include("../Assets/connection/Connection.php");
session_start();
if(!isset($_SESSION['uid']))
{
    header('location../Guest/Login.php');
}
?>