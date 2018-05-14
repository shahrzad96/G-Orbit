<?php
		ob_start();
		include('index.php');
		ob_end_clean();
		
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
		

		$loginUserName = $_POST['userName'];
		$password = $_POST['passWord'];
		$nationality = $_POST['nationality'];
		$email = $_POST['email'];
		
		$finalResult= "";
		
		$sql = "select user_name from player where user_name='$loginUserName' ";
		$res = $conn->query($sql);
		$userCheck = $res->fetch_assoc();
		
		$sql = "select email from player where email='$email' ";
		$res = $conn->query($sql);
		$emailCheck = $res->fetch_assoc();
		
		if(	 $userCheck != null	){
			$finalResult .= "The account already exists\n";
		}
		if( $emailCheck != null) {
			$finalResult .= "The email is already in use\n";
		}
		else{		
			$sql = "insert into player (user_name, password, nationality, no_hours_played, status, email, bonus) 
								values ('$loginUserName', '$password', '$nationality','0.0' , 'offline' , '$email', '0.0' )  "; 
			
			if ($conn->query($sql) === TRUE) {
				$finalResult .= "The account was successfully created";
			} else {
				$finalResult .= "\nERROR while creating account";
			}
		}

		$conn->close();
		
		
		session_start();
			
			
		
		session_write_close();
		
		

?>

<html>
<link rel="stylesheet" type="text/css" href="cs353index.css">
	<body>
	
	
		<div class="koka" > <?php echo $finalResult	?></div>
	
		<progress value="0" max="1" id="progressBar"></progress>


	
	<script>
	
	var timeleft = 2;
		var downloadTimer = setInterval(function(){
				document.getElementById("progressBar").value = 2 - --timeleft;
			if(timeleft <= 0){
				clearInterval(downloadTimer);
				window.location.href = 'index.php';
			}
			},1000);
	
	</script>
	</body>

</html>





