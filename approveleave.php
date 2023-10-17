<!DOCTYPE html>

<?php
//include("aauth.php"); //include auth.php file on all secure pages ?>


<!DOCTYPE html>
<html>
<div id="result"></div>
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
	if($action == 'approve'){
        
		$id = stripslashes($_POST['id']); 
		$id = mysqli_real_escape_string($con,$id);
		
		$qty = stripslashes($_POST['name1']); 
		$qty = mysqli_real_escape_string($con,$qty);
		
		$empl = stripslashes($_POST['empl']); 
		$empl = mysqli_real_escape_string($con,$empl);
		
		$sql='SELECT * FROM `leave` WHERE  `lid`="'.$id.'"';
		$sqlres=mysqli_query($con,$sql);
		$available="";
		foreach($sqlres as $dada){
			$available= $dada['leavedaysavailable'] - $qty;
		}
		var_dump($available);
		$query='UPDATE `leave` SET `leavedaysavailable` ="'.$available.'" WHERE `lid` ="'.$id.'"';
		echo $query;
		$resultx = mysqli_query($con,$query);
		if($resultx){
		$query1='UPDATE `leave_request` SET `status` =1 WHERE `lrid` ="'.$empl.'" ';
		$resultx1 = mysqli_query($con,$query1);
		if($resultx1){
			   $_SESSION['R'] = "Y";
                            header("Location: approveleave.php");
                        } else {
                            $_SESSION['R'] = "N";
                            header("Location: approveleave.php");
                        }
		}
		}
	}	
    else{
	}
?>
<div class="form" id="result">
<h3 style="text-align:center">APPROVE LEAVE FORM</h3>

 <div class="col-md-6 col-md-offset-3">
  <br>
  <?php
                require('db.php');
                $query = 'SELECT * FROM `employees` e join `leave_request` l on
				l.employee_id=e.id join `leave` le on l.leave_id=le.lid where l.status =0';
				//echo $query;
                $users = mysqli_query($con, $query);
                $no = 0;
                $table = '<table class="table table-bordered table-striped">
                        <thead>
                        <td>No</td>
                        <td>Employee Name</td>
						<td>Leave Type</td>
						<td>Request Amount</td>
                        <td></td>        
                        </thead>';
						 $i=1;
                foreach ($users as $value) {
                     //var_dump($value);
					
                    $no++;
                    $table .= '<tr>'
                            . '<td>' . $no . '</td>'
							. '<td>'.$value['fname'].' '.$value['mname'].' '.$value['lname'].'</td>'
							. '<td>'.$value['leave_type'].'</td>'
							. '<td>'.$value['working_day'].'</td>'
							. '<td>'.'<button data-emp="'.$value['lrid'].'" data-amount="'.$value['working_day'].'" data-id="'.$value['lid'].'" id="approve">Approve</button>'.'</td>'
							. '</tr>';
							$i++;
							echo '<input type="hidden" name=""/>';
							
                }
                echo $table . '</table>';
                ?>
</div></div>




</body>

</html>
<script>  
 $(document).on('click', '#approve', function () {
    var id=$(this).data('id');
	var name=$(this).data('amount');
	var emp=$(this).data('emp');
		//alert(name);
		 $.ajax({
        url: "approveleave.php",
        type: "post",
        data: {
                ajax: true,
				action:"approve",
                id: id,
				name1: name,
				empl: emp,
                },
        success: function (data) {  
		//$('#result').html(data);
        },

    });
		
        });
</script>

