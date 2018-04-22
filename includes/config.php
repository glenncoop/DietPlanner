<?php
ob_start();
session_start();

//db properties
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','dietplanner');

//establish db conenction
$conn = new mysqli(DBHOST,DBUSER, DBPASS, DBNAME);


//check connection
if($conn->connect_error){
	die("Connection Failed: ". $conn->connection_error);
}

// define site title for the top of browser
define('SITETITLE','Diet Planner');

//define include cheecker
define('included', 1);

include('functions.php');

?>