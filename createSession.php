<?php

	//var_dump($_POST);

	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	$whatGame = "";
	$maxPlayers = 0;
	$onlineFriends = "";
	
	if(isset($_POST['whatGame'])){
		$whatGame = $_POST['whatGame'];
	}

	//var_dump($_SESSION);
	
	$userName= " to G-Orbit ";
	$chatOutput = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}	
	
	//if player is logged in
	if (isset($_SESSION['loggedIn'])) {
		$sql = "select F.friend_name from friend F, player P, buy B where F.user_name = '$userName' AND F.friend_name = P.user_name
				AND P.status = 'online' AND B.user_name = F.friend_name AND B.game_code = '$whatGame'" ;
	}
	else{
		$sql = "select user_name from player" ;
	}
	
		$table  = $conn -> query($sql);
		
		$rowValue = "";
		$onlineFriends = "";
	
		while( $rowValue = $table->fetch_assoc() ){
			
			if($rowValue['friend_name'] != Null){
				$name= $rowValue['friend_name'];				
				$onlineFriends .= "<div> <div class='friend' id ='$name' >";
				$onlineFriends .= $name;
				$onlineFriends .= "</div> <div id='$name' onclick='inviteFriend(this.id)'>    +       </div></div>";
			}
			else{
				$name = 'No Friends';
				$onlineFriends .= "<div> <div class='friend' id ='$name' >";
				$onlineFriends .= $name;
				$onlineFriends .= "</div> <div id='$name'>    +       </div></div>";
			}
			
		}
		
		$sql = "select  user_name from player" ;
		
		
			
		
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
		
		
		

		<div class="createSession" >
		
			Create Session:
				<input id="sessionName" type="text" name="sessionName" placeholder="Session Name...">
				<button class="button1" id="confirmSession" type="button" onclick="confirmSessionStart()" > Create </button>			
		
		
		</div>
		
		<div class="playInvite">
			<div class="grimBackground"> 
			
				Playing: <?php echo $whatGame; ?> <br>
				Max: <?php echo $maxPlayers; ?> <br>

				<br>Chat Room:
					<div id="joined" >
					
					
					</div>
					
			
			</div>
			

			<div class="invitePlayers" >
			
				Invite: <br>
					
					<?php echo $onlineFriends; ?> 
			
			</div>
			
			<div class="groupMessage" >
				<textarea id = "groupChatTextArea" placeholder="Send message" rows="1" >   </textarea>
			</div>
			
			

			
		</div>
		
		<div class="startGame" >
				<button  class="startGame"  onclick="playNow()"> Play NOW!  </button>
				<p id="playtimer">  </p>
				
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

	
		
		<script  src="jumping.js"> </script>
		<script  language="javascript" type="text/javascript">

			//alert("going to games");
			
			
			document.getElementById("groupChatTextArea").addEventListener("keydown", function(){
				
				
				var key = window.event.keyCode;
				
				if (key === 13) {
					var textAreaa = document.getElementById("groupChatTextArea");
					var msg = textAreaa.value;
					
					if( msg != "" && msg != "\n" ){
						document.getElementById("joined").innerHTML = document.getElementById("joined").innerHTML + '<?php echo $userName; ?>' + ": "  + msg + "<br>";
						textAreaa.value = "";
						
						$.ajax({
							url:'sendmsg.php',
							method:'get',
							data:{idd: msg},
						});
						
					}
			
			
				}

				
			}, false);
			
			
			
			

		</script>
		

	
	</body>
	
	
	
</html>