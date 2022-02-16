<?php
session_start();
unset($_SESSION["cygnus_login"]);
header("location: login.php");
