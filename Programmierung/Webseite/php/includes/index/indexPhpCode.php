<?php
	include("db.php");
	
	if(isset($_POST["btn_login"])){
		
		if(isset($_POST['usernameTeacher'])){
			$username=mysqli_real_escape_string($db,$_POST['usernameTeacher']);
			$password=mysqli_real_escape_string($db,$_POST['password']); 
			$password=md5($password); 
			$sql="SELECT Teacher_Name FROM Teacher WHERE Teacher_Name ='$username' and Password='$password'";
			$result=mysqli_query($db,$sql);
			$count=mysqli_num_rows($result);

			if($count==1)
			{
				$_SESSION['usernameTeacher'] = $username;
				header("location: me.php");
			}
			else 
			{
				echo "<script>alert('Your Login Name or Password is invalid')</script>";
			}
		}	
		
		if(isset($_POST['usernameAdmin'])){	
			$username=mysqli_real_escape_string($db,$_POST['usernameAdmin']);
			$password=mysqli_real_escape_string($db,$_POST['password']); 
			$password=md5($password); 
			$sql="SELECT Username FROM Admin WHERE Username ='$username' and Password='$password'";
			$result=mysqli_query($db,$sql);
			$count=mysqli_num_rows($result);
			
			if($count==1){
				$_SESSION['usernameAdmin'] = $username;
				header("location: indexAdmin.php");
			} else {
				echo "<script>alert('Your Login Name or Password is invalid')</script>";
			}	
		} 
	}

	if(isset($_POST['klassname']) && isset($_POST['klassesearch'])) {
		$klasse = $_POST['klassesearch'];
		$_SESSION['klasse'] = $klasse;
	}
?>