<?php

print_r($_POST);
if ( !array_key_exists("login",$_POST) || !array_key_exists("pass",$_POST) ){
	echo "Nieprawidłowo wprowadzone dane <br>";
	echo "<a href='index.php'> Powrót </a> ";
	exit();
}

include ('connect.php');
$login = $conn -> real_escape_string($_POST['login']);
$pass = $conn -> real_escape_string($_POST['pass']);

$sql = "SELECT * from loginy WHERE login='$login' AND password='$pass'";
try{
	$res = $conn -> query($sql);
}
catch(mysqli_sql_exception $e){
	echo "Błąd połączenia z bazą danych. <br>";
	echo "<a href='index.php'> Powrót </a> ";
	$conn->close();	
	exit();	
}

session_start();
$_SESSION["login_attempt"] = true;
if($res->num_rows>0){
	$_SESSION["login_username"] = $login;
}
else{
	$_SESSION["login_username"] = "";
}

$conn->close();
header('Location: index.php');
?>