<?php

	ob_start();
	include('index.php');
	ob_end_clean();
	
	
	$foundRes1 = "";
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	$searchRes = "";
	
	//Does post work???!!!
	if(isset($_POST['searchBt'])){
		$searchRes = $_POST["searchBt"];
	}
		
	$usernName= " to G-Orbit ";
	$chatOutput = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}	
	
	
	//if player is logged in
	if (isset($_SESSION['loggedIn'])) {
		$sql = "select user_name from player where user_name = '$searchRes'" ;
		$sql2 = " select friend_name from friend_request where user_name = '$userName' ";
	}
	else{
		$sql = "select user_name from player " ;
		$sql2 = " select friend_name from friend_request";
	}
	
		$table  = $conn -> query($sql);
		$table1  = $conn -> query($sql2);
		
		$rowValue = "";
		$foundRes = "";
		
		$rowValue1 = "";
		$foundRes1 = "";
	
		while( $rowValue = $table->fetch_assoc() ){
			
			$name= $rowValue['user_name'];
			
			$foundRes .= "<div> <div class='friend' id ='$name' >";
			$foundRes .= $name;
			$foundRes .= "</div> <div id='$name' onclick='inviteFriend(this.id)'>    +       </div></div>";		
		}

		while( $rowValue1 = $table1->fetch_assoc() ){

			$friend_name = $rowValue1['friend_name'];			
			
			$foundRes1 .= $friend_name;	
			$foundRes1 .= "<br>";	
		}		


			
		
	$conn->close();
		
	session_write_close();
	


?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery-3.3.1.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" type="text/css" href="cs353index.css">
<title>G-Orbit</title>
</head>

	<body  class="body" bgcolor="#000000"  >

		<div class="topPart">
			<div class="koka"> Welcome <?php echo($userName) ?> </div>
			
			<?php include("include/notification.html")?>
		
			<?php include("include/loginRightTop.html")?>
			<br><br><br>
		</div>
		
		<?php include("include/mainBar.html")?>
		
		
		
		<hr class="spaceLine" >
		
		<div class="afterSearch">
			<div class="grimBackground"> 

				Pending Requests:
					<div id="requested" >
					
					<?php echo $foundRes1; ?> 
					
					
					</div>
					
			
			</div>
			
			<div class="showSearch" >
			
				Search Result: <br>
					
					<?php echo $foundRes; ?> 
			
			</div>
		</div>
		
		<hr class="spaceLine" >
		
		
		<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		
		<br><br><br><br><br><br><br><br><br>
		
		
		
		<?php include("include/sourceModal.html")?>
		<?php include("include/accountModal.html")?>
		
		
		<form id ="logOutFormHidden" method="post" action ="index.php">
				<input id="logout" type="hidden" name="logout" value="ADSASD" >	 
		</form>
		
		
		<div class="chat_box">
			<div class="chat_head" onclick="hideChatBody()"> Chatt </div>
			<div class="chat_body" id="chat_body">
				<?php echo $chatOutput; ?>
			</div>
		</div>

	
		
		
		<script  language="javascript" type="text/javascript">

			function inviteFriend(whom){
				
				fcookie = 'mycookie';
				//alert("Requesting: " + whom);
				document.cookie = fcookie + "=" + whom;
				
				var a = document.getElementById("requested");
				
				
				var string = a.innerHTML;				
				
				var adding_friend = whom;
				
				if(string.indexOf(whom) >= 0){
					alert("request already sent");
				}
				else{
					a.innerHTML = a.innerHTML + whom + "<br>";
					$.ajax({
						url:'request.php',
						method:'get',
						data:{friend: adding_friend},
					});
				}

				
			}

		</script>
		<script  src="jumping.js"> </script>

	
	</body>
	
	
	
</html>

