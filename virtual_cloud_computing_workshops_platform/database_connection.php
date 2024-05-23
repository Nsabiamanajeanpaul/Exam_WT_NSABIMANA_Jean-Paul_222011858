<?php
$host= "localhost";
$user= "nsabimana";
$pass= "222011858";
$database= "computing_workshop_platform";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error)  {
	die("Connection failed: " . connection->connect_error);
}