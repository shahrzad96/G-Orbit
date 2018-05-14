<?php
	
	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	session_start();
	
	$usernName= " to G-Orbit ";
	
	if (isset($_SESSION['userName'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
	}

	session_write_close();



?>




<html>

<link rel="stylesheet" type="text/css" href="cs353index.css">
<title>Account</title>

	<body class="body" bgcolor="#000000">	
	
	
		<div class="topPart">
			<div class="koka"> Welcome <?php echo($usernName) ?> </div>
			<?php include("include/notification.html")?>
		
			<?php include("include/loginRightTop.html")?>
			<br><br><br>
		</div>
		
		<?php include("include/mainBar.html")?>
			
		
		<hr class="spaceLine" style=" margin: 50px;">
		
		<br>
	
		<div class="wrappOA" >

				<div class="optionss" >
					<div class="AC" >
						<h1> Account Settings: </h1>
					</div>
						<h2 class="choice" onclick="changeName()"> Change Display Name   </h2>
						<h2 class="choice" onclick="changePasswordd()"> Change Password   </h2>
						<h2 class="choice" onclick="getStatus()"> Account Status   </h2>
						<h2 class="choice" onclick="changeEmail()"> Email and Communication   </h2>
						<h2 class="choice" onclick="messages()"> Messages   </h2>
				</div>

				<div class ="answers" id="answers">
				
					
				
				
				</div>
		</div>	
		
		
		<hr class="spaceLine" >
		
		<div class="topPart">
			<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		</div>
		
		<br><br><br><br><br><br><br><br><br>
	
	
	
	
	<script  src="jumping.js"> </script>
	<script  src="accountActions.js"> </script>
	
	<script>
		
	
	</script>
	
	</body>
</html>