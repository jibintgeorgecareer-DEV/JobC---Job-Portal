<?php  
include("../Assets/connection/Connection.php");
session_start();
if(!isset($_SESSION['cid']))
{
    header('location../Guest/Login.php');
}
?>