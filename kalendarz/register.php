<?php

print_r($_POST);


if ( !array_key_exists("login",$_POST) || !array_key_exists("pass",$_POST) || !array_key_exists("pass-repeat",$_POST) || 
	 !array_key_exists("email",$_POST) ){
	echo "Nieprawidłowo wprowadzone dane <br>";
	echo "<a href='index.php'> Powrót </a> ";
	exit();
}

include ('connect.php');
$login = $conn -> real_escape_string($_POST['login']);
$pass = $conn -> real_escape_string($_POST['pass']);
$pass_repeat = $conn -> real_escape_string($_POST['pass-repeat']);
$email = $conn -> real_escape_string($_POST['email']);

$sql = "SELECT * FROM loginy WHERE login='$login'";
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
$_SESSION["register_attempt"] = true;


if($res->num_rows>0){
	$_SESSION["double_logins"] = true;
	header('Location: index.php');
	exit();
}

if($pass!== $pass_repeat){
	$_SESSION["wrong_pass_repeat"] = true;	
	header('Location: index.php');
	exit();
}

// dodać sprawdzenie poprawności emaila
// dodać sprawdzenie odpowiedneij długości hasłas

$sql = "INSERT INTO loginy (login,password,email) VALUES ('$login','$pass','$email')";
try{
	$res = $conn -> query($sql);
}
catch(mysqli_sql_exception $e){
	echo "Błąd połączenia z bazą danych. <br>";
	echo "<a href='index.php'> Powrót </a> ";
	$conn->close();	
	exit();	
}

$_SESSION["register_success"] = true;
header('Location: index.php');


?>