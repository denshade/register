<?php
$login = $_POST["login"];
$password = $_POST["password"];
session_start();
$_SESSION["login"] = $login;
$_SESSION["password"] = $password;

