<?php
if (isset($_GET['id']))
{
  $id =   (int)$_GET['id'];
  session_start();
  $_SESSION["products"][] = $id;
}
header('location:cart.php');

