<?php
session_start();
session_destroy();
header("location:login.php");

//unset($_SESSION["id"]);