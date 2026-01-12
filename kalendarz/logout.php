<?php

session_start();
$_SESSION["login_username"] = "";
header('Location: index.php');

?>