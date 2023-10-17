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
			echo 'alert("Request Leave succesfuly")';
			echo '</script>';
		
	}
	if (isset($_SESSION['R'])&& $_SESSION['R']=="N")
	{
			echo '<script language="javascript">';
			echo 'alert("Request Leave Fail")';
			echo '</script>';
		
	}
	$_SESSION['R']="";
    if (isset($_POST['ajax'])){
	$action=$_POST['action'];
	if($action == 'add'){
        $id = stripslashes($_REQUEST['id']); 
		$id = mysqli_real_escape_string($con,$id);
		
		$qty = stripslashes($_REQUEST['name1']); 
		$qty = mysqli_real_escape_string($con,$qty);
		$sql='SELECT `leavedaysavailable` FROM `leave` WHERE  `lid`="'.$id.'"';
		$sqlres=mysqli_query($con,$query);
		$available="";
		foreach($sqlres as $dada){
			$available= $dada['leavedaysavailable'] + $qty;
		}
		$query='UPDATE `leave` SET `leavedaysavailable` ="'.$available.'" WHERE `lid` ="'.$id.'"';
	   // echo $query;
		$resultx = mysqli_query($con,$query);
	}
	   
		
		
						
		
    }else{
		//$query = 'SELECT * FROM `job`';
        //$job = mysqli_query($con, $query);
	}
?>

<h3 style="text-align:center">VIEW APPLICANT</h3>

<form id="result">
<div ></div>
 <div class="col-md-10 col-md-offset-1">
  <br>
  <?php
                require('db.php');
                $query = 'SELECT * FROM `applicant` a join `job` j on
				j.id=a.job_id where 1';
				//echo $query;
                $users = mysqli_query($con, $query);
                $no = 0;
                $table = '<table class="table table-bordered table-striped">
                        <thead>
                        <td>No</td>
                        <td>Job</td>
						<td>Applicant Name</td>
						<td>Gender</td>
                        <td>Field Of Study</td> 
                        <td>Qualification</td> 
						<td>Experience</td> 
                        <td>Phone</td> 						
                        </thead>';
						 $i=1;
                foreach ($users as $value) {
                    // var_dump($value);
					
                    $no++;
                    $table .= '<tr>'
                            . '<td>' . $no . '</td>'
							. '<td>'.$value['jobtitle'].'</td>'
							. '<td>'.$value['fullname'].'</td>'
							. '<td>'.$value['gender'].'</td>'
							. '<td>'.$value['field_of_study'].'</td>'
							. '<td>'.$value['qualification'].'</td>'
							. '<td>'.$value['aexperience'].'</td>'
							. '<td>'.$value['Phone'].'</td>'
							. '</tr>';
							$i++;
							echo '<input type="hidden" name=""/>';
							
                }
                echo $table . '</table>';
                ?>
</div>

</form>


</body>

</html>
<script>  
 $(document).on('click', '#update', function () {
    var id=$(this).data('id');
	var name=$('#newleave').val();
		alert(id);
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

