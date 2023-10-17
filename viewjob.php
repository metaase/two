<?php 
include('adminlogin.php');
if (isset($_SESSION['username'])) {
    header("location: pageadmin.php");
}
?>
<?php
  if (isset($_SESSION['R']) && $_SESSION['R'] == "Y") {
                        echo '<script language="javascript">';
                        echo 'alert("Jop Apply success")';
                        echo '</script>';
                    }

                    if (isset($_SESSION['R']) && $_SESSION['R'] == "N") {
                        echo '<script language="javascript">';
                        echo 'alert("Jop Apply fail")';
                        echo '</script>';
                    }
 $_SESSION['R'] = "";
                    if (isset($_POST['apply'])) {

                        $job = stripslashes($_REQUEST['job_id']);
                        $job = mysqli_real_escape_string($con,$job);
						
                        $fullname = stripslashes($_REQUEST['fullname']);
                        $fullname = mysqli_real_escape_string($con, $fullname);

                        $gender = stripslashes($_REQUEST['gender']);
                        $gender = mysqli_real_escape_string($con, $gender);

                        $today = new DateTime('today');
                        $today = $today->format("Y-m-d");
                        $date = mysqli_real_escape_string($con, $today);

                        $bdate = stripslashes($_REQUEST['bdate']);
                        $bdate = mysqli_real_escape_string($con, $bdate);
						
						$fstudy = stripslashes($_REQUEST['fstudy']);
                        $fstudy = mysqli_real_escape_string($con, $fstudy);
						
						$qualification = stripslashes($_REQUEST['qualification']);
                        $qualification = mysqli_real_escape_string($con, $qualification);

						$exp = stripslashes($_REQUEST['exp']);
                        $exp = mysqli_real_escape_string($con, $exp);
						
						$phone = stripslashes($_REQUEST['phone']);
                        $phone = mysqli_real_escape_string($con, $phone);
						
                        $query = "INSERT INTO `applicant`(`fullname`,`gender`, `birthdate`,
						`field_of_study`,`qualification`, 
						`aexperience`,`Phone`, `dateapplied`,`job_id`) 
						VALUES ('$fullname','$gender','$bdate','$fstudy','$qualification','$exp','$phone','$date','$job')";
                       
						$result = mysqli_query($con, $query);
                        if ($result) {
                            $_SESSION['R'] = "Y";
                            header("Location: index.php");
                        } else {
                            $_SESSION['R'] = "N";
                            header("Location: index.php");
                        }
                        
                    }
?>


<!DOCTYPE html>
<html>
<head>
<title>RDMC</title>
        <link rel="stylesheet" href="css/style1.css" />
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/all.css" />
		
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
<marquee behavior="alternate" direction="right"><h4>HUMAN RESOURCE INFORMATION SYSTEM FOR RESEARCH AND DEVELOPMENT CENTER OF SUGAR CORPORATION AT WONJI</h4></marquee>
<div style="padding:20px;margin-top:30px;background-color: #CCC;height:1500px;">
<a href="index.php" style="color:red">Home</a><br><br><br>
<table class="table table-bordered table-striped">
<thead>
<td>No</td>
<td>Title</td>
<td>Experience</td>
<td>Number</td>
<td>Salary</td>
<td></td>
</thead>
<?php
require('db.php');
    $query = 'SELECT * FROM `job`';
			//echo $query;
            $job = mysqli_query($con, $query);
			$no = 0;
			 foreach ($job as $value) {
				// var_dump($value);
				 $no++;
?>
<tr>
<td><?php echo $no; ?></td>
<td><?php echo $value['jobtitle']; ?></td>
<td><?php echo $value['experience']; ?></td>
<td><?php echo $value['qty']; ?></td>
<td><?php echo $value['salary']; ?></td>
<?php echo '<td><button class="btn btn-xs" id="apply" data-id="'.$value['id'].'">Apply</button></td>' ;?>
</tr>
			 <?php } ?>
</table>

</div>

	<div id="viewexpModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center; color: blueviolet">Job Application Form</h4>
            </div>
            <div class="modal-body">
                <form name="registration" action="" method="post" enctype="multipart/form-data">
				<div class="prl">
				<input type="hidden" id="jobid" name="job_id"/>
                                        <span>Full Name</span>
                                        <input type="text" name="fullname" /><br><br>
										<span>Gender</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <select name="gender">
                                            <option selected>--Select Gender--</option>
                                            <option value="Male">Male</option>
											 <option value="Female">Female</option>
                                        </select><br>
										 <span>Date of Birth</span>
                                        <input type="date" name="bdate" /><br>
										<span>Field Of Study</span>
                                        <input type="text" name="fstudy" /><br>
										<span>Qualification</span>
                                        <input type="text" name="qualification" /><br>
										 <span>Experience</span>
                                        <input type="text" name="exp" /><br>
										<span>Phone</span>
                                        <input type="text" name="phone" /><br><br><br>
										  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <!--<button type="button" class="btn btn-primary" id="save" name="transfer" type="submit">Save</button>-->
                            <input class="btn btn-primary" type="submit" name="apply" value="Apply" /> &nbsp;
                        
										</div>
                </form>
            </div>
 <div class="modal-footer">
                          </div>
        </div>

    </div>
</div>
</body>
</html>
<script type='text/javascript'>
   
 $(document).on('click', '#apply', function () {
        $('#viewexpModal').modal('show');
		var id = $(this).data('id');
		$('#jobid').val(id);
        });
      


</script>



