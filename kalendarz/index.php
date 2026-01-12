<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Testowy kalendarz w Javadcript.">
	<title>Kalendarz</title>
	
	<link rel="stylesheet" href="styles.css">
	
</head>
<body>

<?php

session_start();
$var_login = (isset($_SESSION['login_username']))? $_SESSION['login_username'] : "";
$var_login_attempt = (isset($_SESSION['login_attempt']))? $_SESSION['login_attempt'] : false;

$var_register_attempt = (isset($_SESSION['register_attempt']))? $_SESSION['register_attempt'] : false;
$var_double_logins = (isset($_SESSION['double_logins']))? $_SESSION['double_logins'] : false;
$var_wrong_pass_repeat = (isset($_SESSION['wrong_pass_repeat']))? $_SESSION['wrong_pass_repeat'] : false;
$var_register_success = (isset($_SESSION['register_success']))? $_SESSION['register_success'] : false;

$var_no_login_daypost = (isset($_SESSION['no_login_daypost']))? $_SESSION['no_login_daypost'] : false;


if($var_login!==""){
	
	include('connect.php');
	$sql = "SELECT * FROM loginy WHERE login='$var_login'";
	try{
		$res = $conn -> query($sql);
	}
	catch(mysqli_sql_exception $e){
		$conn->close();	
		exit();	
	}
	
	$row = $res->fetch_assoc();
	$id = $row["ID"];
	
	$sql = "SELECT * FROM Notes WHERE IDOwner='$id'";
	
	try{
		$res = $conn -> query($sql);
	}
	catch(mysqli_sql_exception $e){
		$conn->close();	
		exit();	
	}
	
	while( ($row = $res->fetch_assoc())!=NULL){
		
			$noteDay = $row['NoteDay'];
			$noteMonth = $row['NoteMonth'];
			$noteYear = $row['NoteYear'];
			$noteText = htmlspecialchars($row['NoteText']);
			echo "<div style='display:none' data-noteday='$noteDay' data-notemonth='$noteMonth' data-noteyear='$noteYear' data-notetext='$noteText' class='calendarNoteInfo'> </div>";
	}
	
	
}
?>


<div class="topnav">
	<div class="topnav-text"> 
	<?php
		echo "Zalogowano jako ";
		if( $var_login == ""){
			echo "Anonimowy użytkownik";
		}
		else{
			echo $var_login;
		}
	?>
	</div>
	<div class="topnav-login">  </div>
	<div class="topnav-settings">  </div>
	
</div>

<div class="calendar">

	<div class="calendar-header">
		<div class="btn-prev"> </div>
		<div class="date-text"></div>
		<div class="btn-next"> </div>
	</div>
	<div class="calendar-table-container">
	</div>
</div>


<?php 
	if($var_login_attempt){
		echo '<div class="lightbox login" style="opacity:1;z-index:100;">';
	}
	else{
		echo '<div class="lightbox login">';
	}
?>

	<?php if ($var_login===""): ?>
	
	
	<div class="lightbox-login-container">
	
	<?php
		if($var_login_attempt){
			echo '<span style="margin-top:20px;color:red;" class="phpAddition">Nieprawidłowe dane logowania.</span>';
		}
	?>
	
	<div class="lightbox-login-container-form">
		<form action="login.php" method="post">
		<label for="login"><b>Login</b></label>
		<input type="text" placeholder="Podaj login" id="login-login" name="login" required>
		
		<label for="pass"><b>Hasło</b></label>
		<input type="password" placeholder="Podaj hasło" id="login-pass" name="pass" required>
    
		<button type="submit">Zaloguj</button>
		</form>
	</div>
	
	<div class="lightbox-login-container-footer">
		<span> Nie masz konta? <a href="#" id="loginRegisterLink">Zarejestruj się.</a> </span>
	</div>
	
	</div>
		
	<?php else: ?>

	<div class="lightbox-logout-container">
		
		<?php
			if($var_login_attempt){
				echo '<div class="lightbox-logout-loging-success phpAddition" >';
				echo '<span> Logowanie powiodło się. </span>';
				echo '</div>';
			}
		?>
		<div>
		<?php
			echo '<span> Jesteś zalogowany jako użytkownik ' . $var_login . ' </span>' ;
		?>
		<form action="logout.php" method="post">
		<button type="submit"> Wyloguj </button>
		</form>
		</div>
	</div>
	
	<?php endif; ?>

</div>

<?php 
	if($var_register_attempt){
		echo '<div class="lightbox register" style="opacity:1;z-index:100;">';
	}
	else{
		echo '<div class="lightbox register">';
	}
?>
	
	<div class="lightbox-register-container">
	
	<?php if ($var_register_success): ?>
		
		<div class="lightbox-register-success phpAddition" >
		<span> Rejestracja powiodła się. <a href="#" id="registerLoginLink2">Zaloguj się</a> by kontynuować. </span>
		</div>
		
	<?php endif; ?>
	
	<div class="lightbox-register-container-form">
		<h1>Rejestracja</h1>
		<p>Wypełnij wszystkie pola by utworzyc konto.</p>
		
		<hr>
		
		<?php
			if($var_double_logins){
				echo '<br> <span style="color:red;font-size:13px;position:absolute;top:150px;" class="phpAddition"> Login jest już zajęty </span> ';
			}
			if($var_wrong_pass_repeat){
				echo '<br> <span style="color:red;font-size:13px;position:absolute;top:150px;" class="phpAddition"> Podane hasła są różne. </span> ';
			}
		
		?>
		<form action="register.php" method="post">
		
		<label for="email"><b>Email</b></label>
		<input type="text" placeholder="Podaj email" name="email" id="register-email" required>


		<label for="login"><b>Login</b></label>
		<input type="text" placeholder="Podaj login" name="login" id="register-login" required>

		<label for="pass"><b>Hasło</b></label>
		<input type="password" placeholder="Podaj hasło" name="pass" id="register-pass" required>

		<label for="pass-repeat"><b>Powtórz hasło</b></label>
		<input type="password" placeholder="Powtórz hasło" name="pass-repeat" id="register-pass-repeat" required>
		<hr>
		<button type="submit">Zarejestruj</button>
		</form>
	</div>
	
	<div class="lightbox-register-container-footer">
		<span> Masz już konto? <a href="#" id="registerLoginLink">Zaloguj się.</a> </span>
 	</div>
	
	</div>

</div>

<?php
	if($var_no_login_daypost){
		echo '<div class="lightbox calendar-day" style="opacity:1;z-index:100;" >';
	}
	else{
		echo '<div class="lightbox calendar-day">';
	}
?>	
	<div class="lightbox-calendar-container">
	
		<form action="post_day.php" method="post">
			<?php
				if($var_no_login_daypost){
					echo '<div class="phpAddition" style="color:red">Zaloguj się by móc dodawać notatki.</div>';
				}
			?>
			<p><label for="day_info">Wprowadź notatkę na dzień <span class="day_info_date"></span></label></p>
			<textarea id="day_info" name="day_info" rows="20" cols="50"></textarea>
			<br>
			<input type="hidden" name="NoteDay" id="NoteDay">
			<input type="hidden" name="NoteMonth" id="NoteMonth">
			<input type="hidden" name="NoteYear" id="NoteYear">
			<input type="submit" value="Zatwierdź">
		
		</form>
		
	</div>
		
</div>


<?php

$_SESSION['login_attempt'] = false;
$_SESSION['register_attempt'] = false;
$_SESSION['double_logins'] = false;
$_SESSION['wrong_pass_repeat'] = false;
$_SESSION['register_success'] = false;
$_SESSION['no_login_daypost'] = false;

?>

<script src="script.js"></script>
<script src="script-lightbox.js"></script>
</body>