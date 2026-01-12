<?php

print_r($_POST);
if ( !array_key_exists("day_info",$_POST) || !array_key_exists("NoteDay",$_POST) || !array_key_exists("NoteMonth",$_POST) || !array_key_exists("NoteYear",$_POST) ){
	echo "Nieprawidłowo wprowadzone dane <br>";
	echo "<a href='index.php'> Powrót </a> ";
	exit();
}

include ('connect.php');
session_start();
$login = $_SESSION["login_username"];
$day_info = $conn -> real_escape_string($_POST["day_info"]);
$NoteDay = $_POST["NoteDay"];
$NoteMonth = $_POST["NoteMonth"];
$NoteYear = $_POST["NoteYear"];


if($login === ""){
	$_SESSION["no_login_daypost"] = true;	
	header('Location: index.php');
	exit();
}


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

$row = $res->fetch_assoc();
$id = $row["ID"];

if($day_info===""){
	$sql = "DELETE FROM Notes WHERE IDOwner='$id' AND NoteDay='$NoteDay' AND NoteMonth='$NoteMonth' AND NoteYear='$NoteYear' ";
	try{
		$res = $conn -> query($sql);
	}
	catch(mysqli_sql_exception $e){
		echo "Błąd połączenia z bazą danych. <br>";
		echo "<a href='index.php'> Powrót </a> ";
		$conn->close();	
		exit();	
	}
	$conn->close();
	header('Location: index.php');
}
else{
	
	$sql = "SELECT * FROM Notes WHERE IDOwner='$id' AND NoteDay='$NoteDay' AND NoteMonth='$NoteMonth' AND NoteYear='$NoteYear' ";
	try{
		$res = $conn -> query($sql);
	}
	catch(mysqli_sql_exception $e){
		echo "Błąd połączenia z bazą danych. <br>";
		echo "<a href='index.php'> Powrót </a> ";
		$conn->close();	
		exit();	
	}
	if($res->num_rows>0){
		$sql = "UPDATE notes SET NoteText ='$day_info' WHERE IDOwner='$id' AND NoteDay='$NoteDay' AND NoteMonth='$NoteMonth' AND NoteYear='$NoteYear'";
		try{
			$res = $conn -> query($sql);
		}
		catch(mysqli_sql_exception $e){
			echo "Błąd połączenia z bazą danych. <br>";
			echo "<a href='index.php'> Powrót </a> ";
			$conn->close();	
			exit();	
		}
	}
	else{
		
		$sql = "INSERT INTO Notes (NoteDay,NoteMonth,NoteYear,NoteText,IDOwner) VALUES ('$NoteDay','$NoteMonth','$NoteYear','$day_info', '$id')";
		try{
			$res = $conn -> query($sql);
		}
		catch(mysqli_sql_exception $e){
			echo "Błąd połączenia z bazą danych. <br>";
			echo "<a href='index.php'> Powrót </a> ";
			$conn->close();	
			exit();	
		}
	}
	
	$conn->close();
	header('Location: index.php');
		
}

?>