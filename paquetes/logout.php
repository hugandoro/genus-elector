<?php
session_start();
session_destroy();

//$currentPage = $_SERVER["PHP_SELF"];
//session_start();
//$_SESSION["nivel"] = "0";

header("location:index.php");
?>