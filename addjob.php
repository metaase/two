<!DOCTYPE html>

<?php
//include("aauth.php"); //include auth.php file on all secure pages ?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/bootstrap.css" />




     <script src="js/respond.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/alertify.min.js"></script>
        <script src="js/verify.notify.min.js"></script>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script src="js/respond.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
</head>
<body>
<div style="clear:both; width:100%; background-color:purple; padding-top:-1%;">
<img src="recource/logo.jpg"  height="100px" align="center"  alt=""/>
</div>
<ul id="nav">
	<li><a href="pageadmin.php">Admin Home</a></li>

</ul>

<?php 
	session_start();
?>

<?php
	require('db.php');
    // If form submitted, insert values into the database.
	if (isset($_SESSION['R'])&& $_SESSION['R']=="Y")
	{
			echo '<script language="javascript">';
			echo 'alert("Job Post succesfuly")';
			echo '</script>';
		
	}
	if (isset($_SESSION['R'])&& $_SESSION['R']=="N")
	{
			echo '<script language="javascript">';
			echo 'alert("Job Post Fail")';
			echo '</script>';
		
	}
	$_SESSION['R']="";
    if (isset($_POST['save'])){
	
	
        $jtitle = stripslashes($_REQUEST['jtitle']); 
		$jtitle = mysqli_real_escape_string($con,$jtitle);
		
		$jgrade = stripslashes($_REQUEST['jgrade']); 
		$jgrade = mysqli_real_escape_string($con,$jgrade);
		
		$experience = stripslashes($_REQUEST['experience']); 
		$experience = mysqli_real_escape_string($con,$experience);
		
		$salary = stripslashes($_REQUEST['salary']); 
		$salary = mysqli_real_escape_string($con,$salary);
		
		$qty = stripslashes($_REQUEST['qty']); 
		$qty = mysqli_real_escape_string($con,$qty);
		
		$pdate = stripslashes($_REQUEST['pdate']); 
		$pdate = mysqli_real_escape_string($con,$pdate);
		
		$edate = stripslashes($_REQUEST['edate']); 
		$edate = mysqli_real_escape_string($con,$edate);
		
		$sql="INSERT INTO `job`(`jobtitle`,`jobgrade`,`experience`,`salary`,`qty`,`post_date`,`end_date`) VALUES ('$jtitle','$jgrade','$experience','$salary','$qty','$pdate','$edate')";
		$sqlres=mysqli_query($con,$sql);
		 if($sqlres){
			$_SESSION['R']="Y";
			header("Location: addjob.php");
        }
		else
		{
			$_SESSION['R']="N";
			header("Location: addjob.php");
		}
	   
		
		
						
		
    }else{
	}
?>

<h3 style="text-align:center">ADD JOB FORM</h3>
	
<form  name="registration" action="" method="post" enctype="multipart/form-data">
<div ></div>
 <div class="col-md-6 col-md-offset-3">
  

 <input type="text" name="jtitle" placeholder="Job Title"><br>

 <input type="text" name="jgrade" placeholder="Job Grade"><br>

 <input type="text" name="experience" placeholder="Experience"><br>

 <input type="text" name="salary" placeholder="Salary"><br>

 <input type="number" name="qty" placeholder="Quantity"><br>
 
 <input type="date" name="pdate"><br>

 <input type="date" name="edate"><br><br>
 
 <input type="submit" value="Post" name="save">
</div>

</form>


</body>

</html>
<script>  
 $(document).on('click', '#update', function () {
    var id=$(this).data('id');
	var name=$('#newleave').val();
		alert(name);
		 $.ajax({
        url: "addleave.php",
        type: "post",
        data: {
                ajax: true,
				action:"add",
                id: id,
				name1: name,
                },
        success: function (data) {  
		$('#result').html(data);
        },

    });
		
        });
</script>

