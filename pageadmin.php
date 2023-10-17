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
	<li><a href="adminregistration.php">ADD USER</a></li>
	<li><a href="manageaccount.php">MANAGE ACCOUNT</a></li>
	<li><a href="empreg.php">ADD EMPLOYEE</a></li>
	<li><a href="addjob.php">ADD JOB</a></li>
	<li><a href="approveleave.php">APPROVE LEAVE</a></li>
	
	<li><a href="viewapplicant.php">VIEW APPLICANT</a></li>
	<li><a href="logout.php" class="col-md-offset-2">LOGOUT</a></li>
</ul>

<div style="padding:20px;margin-top:30px;background-color: #CCC;height:1500px;">


</body>
</html>
<style>
a {
  color: hotpink;
}

/* unvisited link */
a:link {
  color: red;
}

/* visited link */
a:visited {
  color: green;
}

/* mouse over link */
a:hover {
  color: hotpink;
}

/* selected link */
a:active {
  color: blue;
}
</style>
