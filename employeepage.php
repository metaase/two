<!DOCTYPE html>

<?php
//include('adminlogin.php');
//include('adminlogin.php');
if(isset($_SESSION['username']))
{
	header("location: pageadmin.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style1.css" />
</head>
<body>
<div style="clear:both; width:100%; background-color:purple; padding-top:-1%;">
<img src="recource/logo.jpg"  height="100px" align="center"  alt=""/>
</div>
<ul id="nav">
	
	<li><a href="leave.php">LEAVE REQUEST</a></li>
	<li><a href="logout.php">LOGOUT</a></li>
</ul>

<div style="padding:20px;margin-top:30px;background-color: #CCC;height:1500px;">


</body>
</html>
