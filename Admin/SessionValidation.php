<?php  
include("../Assets/connection/Connection.php");
session_start();
if(!isset($_SESSION['aid']))
{
    header('location../Guest/Login.php');
}
?>