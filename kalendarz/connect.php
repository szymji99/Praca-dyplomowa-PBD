<?php

include('../config.php');


$conn = @new mysqli("localhost",DBUSER,DBPASS,DBNAME);
// set charset!!!
if ($conn->connect_errno) {
    echo 'Wystąpił błąd: ' . $conn->connect_error;
	die();
}
else{
	
	if (str_ends_with($_SERVER["SCRIPT_FILENAME"],'connect.php')){
		echo "Połączono z bazą danych " . $conn->host_info . "<br>";	
	}
}

?>

