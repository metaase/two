<!DOCTYPE html>

<?php
//include("aauth.php"); //include auth.php file on all secure pages ?>


<!DOCTYPE html>
<html>
<head>
<title>User Register</title>
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

<div style="padding:20px;margin-top:30px;background-color: #CCC;height:1500px;">



<?php 
	session_start();
?>

<?php
	require('db.php');
	
	if (isset($_SESSION['R'])&& $_SESSION['R']=="Y")
	{
			echo '<script language="javascript">';
			echo 'alert("Update succesfuly")';
			echo '</script>';
		
	}
	if (isset($_SESSION['R'])&& $_SESSION['R']=="N")
	{
			echo '<script language="javascript">';
			echo 'alert("Update fail")';
			echo '</script>';
		
	}
	$_SESSION['R']="";
	$R="";
	
    // If form submitted, insert values into the database.
    if (isset($_POST['ajax'])){
		$action=$_POST['action'];
		if($action == 'update'){
		$user = stripslashes($_REQUEST['userid']); 
		$user = mysqli_real_escape_string($con,$user);
		$stat = stripslashes($_REQUEST['status']); 
		$stat = mysqli_real_escape_string($con,$stat);
        $query1 = 'UPDATE user SET status="'.$stat.'" where uid="'.$user.'"';
		$result1 = mysqli_query($con,$query1);
		if($result1){
			$_SESSION['R'] = "Y";
                            header("Location: manageaccount.php");
                        } else {
                            $_SESSION['R'] = "N";
                            header("Location: manageaccount.php");
                        }
		}
		
		else if($action == 'update1'){
		$user = stripslashes($_REQUEST['userid']); 
		$user = mysqli_real_escape_string($con,$user);
		$stat = stripslashes($_REQUEST['status']); 
		$stat = mysqli_real_escape_string($con,$stat);
        $query2 = 'UPDATE user SET status="'.$stat.'" where uid="'.$user.'"';
		$result2 = mysqli_query($con,$query2);
		if($result2){
			$_SESSION['R'] = "Y";
                            header("Location: manageaccount.php");
                        } else {
                            $_SESSION['R'] = "N";
                            header("Location: manageaccount.php");
                        }
		}
   
      
    }
	else{
		 
				
				
?>
<div class="form" id="result22">
<h3 style="text-align:center;">MANAGE ACCOUNT FORM</h3>


  <br><br>
  <?php 
  require('db.php');
  $query = "SELECT * FROM `user` u join employees e on u.employee_id=e.id ";
                $users = mysqli_query($con, $query);
                $no = 0;
                $table ='<table class="table table-bordered table-striped">
                        <thead>
                        <td>No</td>
                        <td>Employee Name</td>
                        <td>User Name</td>
                        <td>Role</td>
						<td>Status</td>
                        </thead>';

                foreach ($users as $value) {
                     //var_dump($value);
					$stat='';
					if($value['status'] == 1){
						$stat='Account Activated To Deactive Click => <button class="btn btn-danger" id="update" data-id="'.$value['uid'].'" value="0">Deactive</button>';
					}elseif($value['status'] == 0){
						$stat='Account Deactivated To Activate Click => <button class="btn btn-success"  id="update1" data-id="'.$value['uid'].'" value="1">Activate</button>';
					}
                    $no++;
                    $table .= '<tr style="font-size: 16px">'
					        . '<td>' . $no . '</td>'
                            . '<td>' . $value['fname'] . ' ' . $value['mname'] . '</td>'
                            . '<td>' . $value['username'] . '</td> '
                            . '<td>' . $value['role'] . '</td>'
                            . '<td>'.$stat.'</td>'
                            . '</tr>';
                }
                echo $table . '</table>';

  


 ?>
 

</div>
<div ></div>
<?php } ?>
</body>
</html>

<script type='text/javascript'>
    $(document).on('click', '#update', function () {
		var id=$(this).data('id');
	$.ajax({
        url: "manageaccount.php",
        type: "post",
        data: {
                ajax: true,
				action:"update",
                userid: id,
				 status: 0,
                },
        success: function (data) { 
		//$('#result22').html(data);
        },

    });
		
    });  
	$(document).on('click', '#update1', function () {
		var id=$(this).data('id');
	$.ajax({
        url: "manageaccount.php",
        type: "post",
        data: {
                ajax: true,
				action:"update1",
                userid: id,
				 status: 1,
                },
        success: function (data) { 
		//$('#result22').html(data);
        },

    });
		
    });
</script>
