<?php
$sname="localhost";
$uname="root";
$pass="";
$db="db_jobc";
$con=mysqli_connect($sname,$uname,$pass,$db);
			
			if(!$con)
			{
				echo "Connection Failed";
			}
?>