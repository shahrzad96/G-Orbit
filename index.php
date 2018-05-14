
<?php

	include("databaseCon.php");
	session_start();
	
	//var_dump($_POST);
	//var_dump($_SESSION);


	$userNameTop = " to G-Orbit";
	$loginBoolean = false;
	$loggedIn = false;
	$chatOutput = "";
	
	
	
	if (isset($_POST['logout'])){
				
		$_SESSION = array();
		if ($_COOKIE[session_name()])
		{
			setcookie(session_name(), '', time()-42000, '/');
		}
		
		session_destroy();
		header('Location: index.php');
	}
	
	
	if (isset($_SESSION['userName'])){
		
		$userNameTop = $_SESSION['userName'];
		$loggedIn = true;
		$chatOutput = $_SESSION['chatOutput'];
	}

	if ( isset($_POST['userName']) ){		//if we receive input from post we need to check authentication of user
		$userNameTop =  $_POST["userName"];
		$userPassword = $_POST["passWord"];
	
	
		$sql = "select user_name , password from player where password = '$userPassword' and user_name = '$userNameTop' "; 
		
		$login  = $conn -> query($sql);
		
		if( $login !=null ){
			
			$rowValue = $login->fetch_assoc();
			
			$userNameTop = $rowValue['user_name'];			//	getting verification from database about user 
			$userPassword = $rowValue['password'];			//	
			
			$loggedIn = true;
			
			$_SESSION['userName'] = $userNameTop;		//saving username for future usage
			$_SESSION['passWord'] = $userPassword;		//saving password for future usage
			$_SESSION['loggedIn'] = $loggedIn;			//saving loginStatus for future usage
						
			$sql = "update player set status = 'online' where user_name = '$userNameTop'";
			$res = $conn->query($sql);
			
			$loginBoolean = true;			//the user is now logged in
			$chatOutput = "";
			
			
			
			$sql = " select friend_name from friend where user_name = '$userNameTop';  ";
			
			$result = $conn->query($sql);
			if( $result != null){
				while( $rowValue = $result->fetch_assoc() ){
					
					$friend = $rowValue['friend_name'];
					$chatOutput .= '<div class="user" id="';
					$chatOutput .= $friend;
					$chatOutput .= '"  onclick="createChatBox(this.id)">';
					$chatOutput .= $friend;
					$chatOutput .= '</div>';
							
				}
			}
			$_SESSION['chatOutput'] = $chatOutput;			//saving chats for future usage

			
			//if(isset($_POST['idd'])){
				
			//}

			/*
			if($_GET['msg'] != ""){
				$text= $_GET['msg'];
				$receiver = $_GET['id'];
				
				echo "$receiver";
				echo "$text !!!!";
			}
			*/
			//$sql = " select friend_name from friend where user_name = '$userNameTop';  ";
				
		}
	
	}

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

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<title>G-Orbit</title>
</head>

	<body  class="body" bgcolor="#000000"  onload="loadAllFirst()" >
	<div>	
		
		<div class="koka"> Welcome <?php echo($userNameTop) ?> </div>
		
		<?php include("include/notification.html")?>

		<?php include("include/loginRightTop.html")?>
		
			<br><br><br>
		</div>
		
		<?php include("include/mainBar.html")?>
		
		
		<div class="showGames" >

			<div class="display_Games">
				<img id="img1" src="Game_Pictures/game2.jpg" onmouseleave="continueShow()" height="100%" width="100%"  align="center" usemap="#ImgMap0" />
			</div>
			
			<div class="gameParagraph" >
				<p id="gameParagraph">  </p>
			</div>
			
		</div>
		
		<hr class="spaceLine" >
		
		<div class="recom"> Recommended Games</div>
		
		<div class="showGames" > 
				
			<?php  				
					
					if (isset($_SESSION['loggedIn'])) {
						$query = "select * from game_images G, buy B where B.user_name = '$userNameTop' AND G.genre = B.genre AND
									G.game_code NOT IN (select game_code from buy where user_name = '$userNameTop')" ;
					}
					else{
						$query = "select * from game_images" ;
					}
					
					$table  = $conn -> query($query);
					$rowValue = "";
					
					while($rowValue = $table->fetch_assoc())  
					{  
						$image = $rowValue['image_data'];
						 echo '
								<div class="show_pictures_box">
									<img src="data:image/jpeg;base64,'.base64_encode($image).'" height="200" width="200" class="show_pictures" /> </div>  
						 ';  
					}  				
				?> 							

			
		
		</div>
		
		<form id ="hiddenUser" method="post" action ="index.php">
				<input id="user" type="hidden" name="user" value="<?php echo htmlspecialchars($userNameTop)?>"> 			
		</form>
		
		
		<hr class="spaceLine" >
		
		<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		
		<br><br><br><br><br><br><br><br><br>
		
		<?php include("include/sourceModal.html")?>
		<?php include("include/accountModal.html")?>
		
		
		
		
		<form id ="logOutFormHidden" method="post" action ="index.php">
				<input id="logout" type="hidden" name="logout" value="ADSASD" >	 			
		</form>
	</div>

	

		
	<div class="chat_box">
		<div class="chat_head" onclick="hideChatBody()"> Chatt </div>
		<div class="chat_body" id="chat_body" >
			<?php echo $chatOutput; ?>
		</div>
	</div>
	
	
	
	<?php //top part images
				
					$query = "select * from game_images" ;
					
					$table  = $conn -> query($query);
					$counter = 0;
					$cars = array();
					
					while($rowValue = $table->fetch_assoc() && $counter != 6)  
					{  
						
						$cars[$counter] = $rowValue['image_data'];
						$counter++;
					}						 
	?>
	

	
		<script  src="jumping.js"> </script>
		<script>	
						
			var timerid = 0;
			
			var images = new Array(	"Game_Pictures/game1.jpg",
						"Game_Pictures/game2.jpg",
						"Game_Pictures/game3.jpg",
						"Game_Pictures/game4.jpg",
						"Game_Pictures/game5.jpg",
						"Game_Pictures/game6.jpg");
			var text = new Array (" Forza is a game that attracts speed fans...",
								" Call of duty is a FPS game...",
								" Murdered soul Suspect ventures in the afterlife world...",
								" DOTA2 is a Moba game, offering a 5v5 gameplay...",
								" The Last of Us, a game that will put you in the post apocalyptic world...",
								" Resident Evil 7, the horror game...");
			var countimages = 0;
			var continuee = true;
			
			
			document.getElementById("img1").src = images[countimages];
			document.getElementById("gameParagraph").innerHTML = text[countimages];

			
			document.getElementById("showP").addEventListener('mouseup', function () {
		
				document.getElementById("showP").style.color = "black";
				showPassword();	
			
			});

			document.getElementById("showP").addEventListener('mousedown', function () {
		
				document.getElementById("showP").style.color = "red";
				showPassword();
			});
			
			
			function showPassword(){

				var sh = document.getElementById("pW");

				if (sh.type === "password")
					sh.type = "text";
				else
					sh.type = "password";
			}
			
			
			
			function startTime(){
				
				if(timerid)
				{
					timerid = 0;
				}
				var tDate = new Date();
				
				if(countimages == images.length)
				{
					
					countimages = 0;
				}
				if(tDate.getSeconds() % 5 == 0)
				{
					document.getElementById("img1").src = images[countimages];
					document.getElementById("gameParagraph").innerHTML = text[countimages];
					countimages++;
				}
				
				
				if( continuee )
					timerid = setTimeout("startTime()", 1000);
				
			}
					
			document.getElementById("img1").addEventListener('mouseover', function () {
				continuee = false;
				//alert(continuee);	
			});
			
			function continueShow(){
				continuee = true;
				startTime();
				//alert(continuee);
			}
			
		
		function loadAllFirst(){
			
			startTime();

		}
		
			
		
		
		</script>




	</body>
</html>
