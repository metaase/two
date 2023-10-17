<!DOCTYPE html>

<?php
//include("aauth.php"); //include auth.php file on all secure pages ?>


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
			echo 'alert("Employee Registration success")';
			echo '</script>';
		
	}
	if (isset($_SESSION['R'])&& $_SESSION['R']=="N")
	{
			echo '<script language="javascript">';
			echo 'alert("Registeration failed, Complete Information please")';
			echo '</script>';
		
	}
	$_SESSION['R']="";
		if(isset($_POST['register']))
		{
				
		$sfname = stripslashes($_REQUEST['sfname']); 
		$sfname = mysqli_real_escape_string($con,$sfname);
		
		$smname = stripslashes($_REQUEST['smname']); 
		$smname = mysqli_real_escape_string($con,$smname);
		
		$slname = stripslashes($_REQUEST['slname']); 
		$slname = mysqli_real_escape_string($con,$slname);
		
		$sbdate = stripslashes($_REQUEST['sbdate']); 
		$sbdate = mysqli_real_escape_string($con,$sbdate);
	
		
		$ssex = stripslashes($_REQUEST['ssex']); 
		$ssex = mysqli_real_escape_string($con,$ssex);
		
		$jtitle = stripslashes($_REQUEST['jtitle']); 
		$jtitle = mysqli_real_escape_string($con,$jtitle);
		
		$jgrade = stripslashes($_REQUEST['jgrade']); 
		$jgrade = mysqli_real_escape_string($con,$jgrade);
		
		$salary = stripslashes($_REQUEST['salary']); 
		$salary = mysqli_real_escape_string($con,$salary);
		
		$fstudy = stripslashes($_REQUEST['fstudy']); 
		$fstudy = mysqli_real_escape_string($con,$fstudy);
		
		$sphone = stripslashes($_REQUEST['sphone']); 
		$sphone = mysqli_real_escape_string($con,$sphone);
		
		$plwork = stripslashes($_REQUEST['plwork']); 
		$plwork = mysqli_real_escape_string($con,$plwork);
		
		$email = stripslashes($_REQUEST['email']); 
		$email = mysqli_real_escape_string($con,$email);
		
		$qual = stripslashes($_REQUEST['qual']); 
		$qual = mysqli_real_escape_string($con,$qual);
		
		$queryt = "INSERT INTO `employees` (`fname`, `mname`, `lname`, `gender`, `birthdate`, `jobtitle`, `jobgrade`, `salary`, `field_of_study`, `qualification`, `place_of_work`, `email`,`Phone`) VALUES ('$sfname','$smname','$slname','$ssex','$sbdate','$jtitle','$jgrade','$salary','$fstudy','$qual','$plwork','$email','$sphone')";
        $resultx = mysqli_query($con,$queryt);
        	
		if($resultx){
				$_SESSION['R']="Y";
				header("Location: empreg.php");
        		}else{
				$_SESSION['R']="N";
				header("Location: empreg.php");
				}

				
		}else{
			
				
				
?>
<div class="form">
<h3 style="text-align:center;">EMPLOYEE REGISTRATION FORM</h3>
	<div class="l">

           
	</div>

<div class="r">

<div class="pb">
 

<form name="registration" action="" method="post" enctype="multipart/form-data">
<p>

<input type="text" name="sfname" placeholder=" First name"  required /> 
<input type="text" name="smname" placeholder="Middile name"  required /> 
<input type="text" name="slname" placeholder="Last name"  required />
<br>
<input type="date" name="sbdate" placeholder="Birth Date" />
<input type="text" name="ssex" placeholder="gender"  required />
<br>
</div>

<div class="prl">
<input type="text" name="jtitle" placeholder="Job Title"  required />

<input type="text" name="jgrade" placeholder="Job Grade" required />

<input type="text" name="salary" placeholder="Salary"  required />

<input type="text" name="fstudy" placeholder="Field Study"  required />

<input type="text" name="email" placeholder="E-mail"  required />

<input type="text" name="plwork" placeholder="Place Of Work"  required />

<input type="text" name="sphone" placeholder="Phone: 912345678"  required />
<br><br>
 <select name="qual">
<option value="0">--Select Qualification--</option>
<option value="Ph.d">PH.D</option>
<option value="Msc/MA">M.Sc(M.A)</option>
<option value="Bsc">B.SC (B.A)</option>
<option value="Diploma">Diploma (Level IV)</option>
<option value="Level III">Level III</option>
<option value="Level II">Level II</option>
<option value="Level I">Level I</option>
<option value="High School Complete">High School Complete</option>
<option value="Other">Other</option>
  </select><br><br>

<br><br>

</div>



</div>

<div class="botomform">

  <input type="submit" name="register" value="Register" /> &nbsp;

</form>

</div>
</div>
<?php } ?>
</body>
</html>
