
<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: adminloginpage.php");
exit(); }
?>
