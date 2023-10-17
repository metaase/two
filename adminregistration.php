<!DOCTYPE html>

<?php
//include("aauth.php"); //include auth.php file on all secure pages ?>


<!DOCTYPE html>
<html>
<head>
<title>User Register</title>
<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
<div style="clear:both; width:100%; background-color:purple; padding-top:-1%;">
<img src="recource/logo.jpg"  height="100px" align="center"  alt=""/>
</div>
<ul id="nav">
	<li><a href="pageadmin.php">Admin Home</a></li>

</ul>

<div style="padding:20px;margin-top:30px;background-color: #CCC;height:1500px;">



<?php 
	session_start();
?>

<?php
	require('db.php');
	
	if (isset($_SESSION['R'])&& $_SESSION['R']=="Y")
	{
			echo '<script language="javascript">';
			echo 'alert("Registerd succesfuly")';
			echo '</script>';
		
	}
	if (isset($_SESSION['R'])&& $_SESSION['R']=="N")
	{
			echo '<script language="javascript">';
			echo 'alert("Registeration fail")';
			echo '</script>';
		
	}
	$_SESSION['R']="";
	$R="";
	
    // If form submitted, insert values into the database.
    if (isset($_POST['register'])){
		 $role = stripslashes($_REQUEST['role']); 
		$role = mysqli_real_escape_string($con,$role);
		
        $per = stripslashes($_REQUEST['pid']); 
		$per = mysqli_real_escape_string($con,$per);
	
		$uname = stripslashes($_REQUEST['uname']); 
		$uname = mysqli_real_escape_string($con,$uname);
		
		$pass = stripslashes($_REQUEST['pass']); 
		$pass = mysqli_real_escape_string($con,$pass);
		
		
	
        $query = "INSERT INTO `user`(`username`, `password`,`employee_id` ,`role`) VALUES ('$uname','".md5($pass)."','$per','$role')";
        $result = mysqli_query($con,$query);
        if($result){
			$_SESSION['R']="Y";
			header("Location: adminregistration.php");
        }
		else
		{
			$_SESSION['R']="N";
			header("Location: adminregistration.php");
		}
    }else{
		 $sql = 'SELECT * FROM `employees`';
                $emp = mysqli_query($con, $sql);
                $tlist = '';
                foreach ($emp as $data) {
                    $tlist .= '<option value="' . $data['id'] . '">' . $data['fname'] .' '.' '. $data['mname'] .'</option>';
                }
				
				
?>
<div class="form">
<h3 style="text-align:center;">USER REGISTRATION FORM</h3>
	
<div class="r">

<div class="pb">
 

<form name="registration" action="" method="post" enctype="multipart/form-data">
  <br><br>
  <select name="pid">
  <option value="0">--Select Employee--</option>
   <?php
     echo $tlist;
     ?>
  </select>

  <br>
  <input type="text" name="uname" placeholder="Username" required /> <br>
 
  <input type="text" name="pass" placeholder="Password" required />
 <br>
  <input type="text" name="role" placeholder="Role" required />
  

</div>

<div class="botomform">
  <input type="submit" name="register" value="Register" />
</div>

</form>
<br /><br />
</div>
</div>
<?php } ?>
</body>
</html>
