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
        <script src="js/bootstrap-datepicker.js"></script>
</head>
<body>
<div style="clear:both; width:100%; background-color:purple; padding-top:-1%;">
<img src="recource/logo.jpg"  height="100px" align="center"  alt=""/>
</div>

        <div style="clear:both; width:100%; background-color: #30292F; padding-top:-1%;">
            
        </div>
<ul id="nav">
	<li><a href="employeepage.php">Employee Home</a></li>

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
    if (isset($_POST['request'])){
	
		
	    $employee = stripslashes($_REQUEST['employee']); 
		$employee = mysqli_real_escape_string($con,$employee);
		
		$leaveid = stripslashes($_REQUEST['leaveid']); 
		$leaveid = mysqli_real_escape_string($con,$leaveid);
		
		$amount = stripslashes($_REQUEST['amount']); 
		$amount = mysqli_real_escape_string($con,$amount);
		
		$sdate = stripslashes($_REQUEST['sdate']); 
		$sdate = mysqli_real_escape_string($con,$sdate);
		
		$edate = stripslashes($_REQUEST['edate']); 
		$edate = mysqli_real_escape_string($con,$edate);
		
		$wdate = stripslashes($_REQUEST['wdate']); 
		$wdate = mysqli_real_escape_string($con,$wdate);
	
	    $ltype = stripslashes($_REQUEST['ltype']); 
		$ltype = mysqli_real_escape_string($con,$ltype);
		
		$rdate = stripslashes($_REQUEST['rdate']); 
		$rdate = mysqli_real_escape_string($con,$rdate);
		
		$today = new DateTime('today');
        $today = $today->format("Y-m-d");
        $date = mysqli_real_escape_string($con, $today);
		
		$year=explode('-',$date);
		$query = "INSERT INTO `leave_request`(`employee_id`,`start_date`, `end_date`,
						`working_day`,`leave_type`, 
						`date_applied`,`budget Year:`, `leave_id`,`date_return_to_work`) 
						VALUES ('$employee','$sdate','$edate','$wdate','$ltype',
						'$date','$year[0]','$leaveid','$rdate')";
                       
						$result = mysqli_query($con, $query);
						 if ($result) {
                            $_SESSION['R'] = "Y";
                            header("Location: leave.php");
                        } else {
                            $_SESSION['R'] = "N";
                            header("Location: leave.php");
                        }
		
    }else{
	}
?>

<h3 style="text-align:center">LEAVE REQUEST FORM</h3>
	
<form name="registration" action="" method="post" enctype="multipart/form-data">
<input class="col-md-offset-10" type="submit" name="request" value="Request"/>
 <div class="col-md-10">
  <br>
  <?php
                require('db.php');
                $query = 'SELECT * FROM `employees` e join `leave` l on
				l.employee_id=e.id where l.employee_id="'.$_SESSION['person_id'].'"';
				//echo $query;
                $users = mysqli_query($con, $query);
                $no = 0;
                $table = '<table class="table table-bordered table-striped">
                        <thead>
                        <td>No</td>
                        <td>Remaning Leave</td>
						<td>Requested Amount</td>
						<td>Start Date</td>
						<td>End Date</td>
						<td>Working Day</td>
						<td>Leave Type</td>
						<td>Return Date</td>
                                    
                        </thead>';
						 $i=1;
                foreach ($users as $value) {
                    // var_dump($value);
					
                    $no++;
                    $table .= '<tr>'
                            . '<td>' . $no . '</td>'
							. '<td>'.$value['leavedaysavailable'].'</td>'
							. '<td>'.'<input type="number" name="amount"/>'.'</td>'
							. '<td>'.'<input class="form-control" type="date" name="sdate" require/>'.'</td>'
							. '<td>'.'<input class="form-control" type="date" name="edate" require/>'.'</td>'
							. '<td>'.'<input type="number" name="wdate"/>'.'</td>'
							. '<td>'.' <select name="ltype">
										<option selected="" value="Default">--Leave Type--</option>
                                        <option value="Annual Leave">Annual Leave</option>
                                        <option value="Maternity Leave">Maternity Leave/pre</option>
                                        <option value="Maternity Leave">Maternity Leave/post</option>
                                        <option value="Mouring Leave">Mouring Leave</option>
                                        <option value="Leave With Pay">Leave with Pay</option>
                                        <option value="Leave Without Pay">Leave with out pay</option>
                                        <option value="Other">Other</option>
										</select>'.'</td>'
							. '<td>'.'<input class="form-control" type="date" name="rdate" require/>'.'</td>'.'</tr>';
							$i++;
							echo '<input type="hidden" name="leaveid" value="'.$value['lid'].'" require/>';
							echo '<input type="hidden" name="employee" value="'.$value['id'].'" require/>';
                }
                echo $table . '</table>';
                ?>
</div>
</form>
<div id="result"></div>
</body>

</html>
<script>  
 $(document).on('click', '#request', function () {
       var id= $('#leave-form').serialize();
		 //alert(id);
		 	$.ajax({
        url: "viewgrade.php",
        type: "post",
        data: {
                ajax: true,
				action:"dol",
                name: id,
                },
        success: function (data) {  
		console.log(data);
		$('#result').html(data);
        },

    });
        });
</script>

