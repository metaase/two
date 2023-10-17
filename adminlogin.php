
<?php
	require('db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `user` WHERE username='$username' and password='".md5($password)."'";
		$type = mysqli_query($con, $query);
        $usertype = '';
        $user_id = "";
		$status = "";
        foreach ($type as $data) {
        $usertype = $data['role'];	
        $user_id = $data['employee_id'];
        }
		$result = mysqli_query($con,$query) or die(mysql_error());
		
		$rows = mysqli_num_rows($result);
        if($rows==1){
		 if ($usertype == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['person_id'] = $user_id;
            header("Location: pageadmin.php");// Redirect user to index.php
        } else if ($usertype == 'employee') {
             $_SESSION['person_id'] = $user_id;
            header("Location: employeepage.php");
        }
		else if ($usertype == 'teacher') {
			$_SESSION['person_id'] = $user_id;
			header("Location: teacherpage.php");
        }
	
			//$_SESSION['username'] = $username;
			//header("Location: pageadmin.php"); // Redirect user to index.php
            }else{
				echo '<script language="javascript">';
			echo 'alert("Invalid Username or Password")';
			echo '</script>';
				}
    }else{
?>

<?php } ?>
