<?php
if (isset($_GET["id"]))
{
    session_start();
    $_SESSION["products"][] = (int)$_GET["id"];//adding ids
}
header("location:sell.php");
