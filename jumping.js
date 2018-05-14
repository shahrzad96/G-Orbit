var loggedIn;
var popups;
var name ="";

var script = document.createElement('script');
var ajScript = document.createElement('ajScript');
 
//script.src = '//code.jquery.com/jquery-1.11.0.min.js';
//ajScript.src = 'src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">';
//document.getElementsByTagName('head')[0].appendChild(script); 

if( document.getElementById("login_btn").value == "logout" ){
	loggedIn = true;
	popups = [];
}
else 
	loggedIn = false;

//

function alertThisShit(){

	alert("Theis shit is real");
	
}

function playGame(){


	if( loggedIn ){
	window.location.href = 'play.php';
	}
	else{
		login_Btn.click();
	}
	
}

function goHome(){

	window.location.href = 'index.php';
	
}

function trophies(){

	window.location.href = 'trophies.php';
	
}

function ownedGames() {
	
	if( loggedIn ){
		window.location.href = 'owned.php';
	}
	else{
		login_Btn.click();
	}

	
	
}

function purchaseGames() {
	
	//alert("Purchase games " + loggedIn);
	if( loggedIn ){
		window.location.href = 'purchase.php';
	}
	else{
		//alert("showing modal");
		login_Btn.click();
	}
	
	
}

function ownedItems() {
	
	//alert("Owned Items " + loggedIn);
	if( loggedIn ){
		window.location.href = 'ownedItems.php';
	}
	else{
		//alert("showing modal");
		login_Btn.click();
	}
}

function goAccount(){
	

	if( loggedIn ){
		window.location.href = "account.php";
	}
	else{
		//alert("showing modal");
		login_Btn.click();
	}
	
	
	
}

//  PASSWORD IN SIGNING IN

	function getCredentials(){
		var userName = document.getElementById("uN").value;
		var passWord = document.getElementById("pW").value;
		var text ="UserName: " +  userName + "   Password: " + passWord;
		
		
		if( userName == "" || passWord == "" ){
			//alert("The credentials are not correct");
			document.getElementById('myModal').style.display = "block";
			}
		else{
			//alert(userName + "   "+passWord);
			document.getElementById("login_Form").submit();
		}
			
		
	}


//============================================


// MODAL for signing in and for signing updateCommands


	var myModall = document.getElementById('myModal');
	var spanClick = document.getElementsByClassName("close")[0];
	var login_Btn = document.getElementById("login_btn");
	
	var accModal = document.getElementById('accountModal');
	var spanClickk = document.getElementsByClassName("close")[1];


	spanClick.onclick = function() {
		//alert("Trying to close modal");
		myModall.style.display = "none";
	}
	spanClickk.onclick = function() {
		//alert("Trying to close modal1111");
		accModal.style.display = "none";
	}

	function logoutdude() {
		
		//alert(login_Btn.value);
		if( login_Btn.value == "logout" ){
			var userName = document.getElementById('user').value;
			alert(userName);
			
			$.ajax({
				url:'logOut.php',
				method:'get',
				data:{userr: userName},
				success: function(){
					document.getElementById("logOutFormHidden").submit();
				},
				error: function(){
					alert("fuck you");
				}
			});
			
			document.getElementById("logOutFormHidden").submit();
			
		}
		else {
			//alert ("SSS");
			myModall = document.getElementById('myModal');
			myModall.style.display = "block";
			if( myModall.style.display == "none" )
				alert ("AAA");
		
			}
		
	}

	window.onclick = function(event) {
		if (event.target == myModall) {
			myModall.style.display = "none";
		}
	}
	



	function createAccountPopUp(){
		myModal.style.display = "none";
		document.getElementById('accountModal').style.display = "block";
		
	}

	function createAccount(){
		
		var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
		var username = document.getElementById('aUserName').value;
		
		
		if( !format.test(username) ){
		
			if( document.getElementById('aPassWord').value == document.getElementById('aConfirmPassWord').value ){
				
				document.getElementById('create_account_form').submit();
				accModal.style.display = "none";
			}
			else{
				alert("The passwords do not match!!");
			}
		
		}
		
		else{
			alert("wrong user name format");
		}
	}

//============================================



// Searching  

	function alertttSearch(){
		alert ("search");
		if( loggedIn ){
			
			var search = document.getElementById("search").value;
			
			document.getElementById("searchBt").value = search;
			
			document.getElementById("searchForm").submit();
			
		}
		else{
			//alert("showing modal");
			login_Btn.click();
		}			

	}


//==================

	function alerttt(){
		alert("DFASDFASD" + $modalll);		
	}
	/*
	if( document.getElementById("login_btn").value == "logout" ) {
		document.getElementById("login_btn").onclick = function() {
			alert("SddsfasdfsdaAD");
			
		}
	}
	*/
	
//================== Chat PopUps =========================================

	
				
	//alert("ASDFASDFASDF");
	
	$('.chat_body').hide();
	$('.msg_wrap').hide();
	
	
	function hideChatBody(){

		var elementt = document.getElementById("chat_body");

		var getDown = "#" + elementt.id ;
		$( getDown ).slideToggle('slow');
		
		
	}
	
	function createChatBox(id){
		
		name = id;
		var myId = id;
		var id = id + "_";
		alert(id + "   " + name);
		
		var groupID = 3;
		groupID = groupID + 1;
		
		register_popup(id, name, groupID);
		
	}
	
	$('.chat_headddd').click(function(){
		

		$('.chat_body').slideToggle('slow');
	
	});
	
//extra function
function request(url, callback) {

  var req = new XMLHttpRequest();

  req.onreadystatechange = function() {
    if (req.readyState !== XMLHttpRequest.DONE) return;

    switch (req.status) {
      case 200:
        return callback(null, req.responseText);
      case 404:
        return callback(Error('Sorry, 404 error'));
      default:
        return callback(Error('Some other error happened'))
    }
  };

  req.open("GET", url, true);
  req.send();

  return req;
}
	
	
	function sendMessage(textareaa, id, groupID){
		
		//fcookie = 'mycookie';
		//document.cookie = fcookie + "=" + id;
		
		var msgg = textareaa.value;
		
		var key = window.event.keyCode;
		var userName = document.getElementById('user').value;
		
		if (key === 13) {
						
			var msg = "<div class='msg_b'>" + textareaa.value + "</div>";
			var msgSend = id + "_msg_insert";
			document.getElementById(msgSend).innerHTML = document.getElementById(msgSend).innerHTML + msg;
		
			var s = textareaa.value;
			textareaa.value = "";

			$.ajax({
				url:'saveChat.php',
				method:'get',
				data:{idd: id, msggg: s, myUser: userName, gID: groupID },
			});

		}
		
		
	}
	
	
	
	

	var total_popups = 0;


	//this function can remove a array element.
	Array.remove = function(array, from, to) {
		var rest = array.slice((to || from) + 1 || array.length);
		array.length = from < 0 ? array.length + from : from;
		return array.push.apply(array, rest);
	};


	//this is used to close a popup
	function close_popup(id, groupID)
	{
		alert("Closing popup: " + id + " " + popups.length);
		for(var i = 0; i < popups.length; i++)
		{
			alert(id + " " +popups[i]);
			if(id == popups[i])
			{
				//alert("match found1" );
				Array.remove(popups, i);
				
				//alert("match found2" );
				document.getElementById(id).style.display = "none";
				
				$.ajax({
					url:'closeChat.php',
					method:'get',
					data:{gID: groupID },
				});
				
				//alert("match found3" );
				calculate_popups();
				
				return;
			}
		}   
	}

	//display popups
	function display_popups()
	{
		var right = 300;
		
		var i = 0;
		for(i; i < total_popups; i++)
		{
			if(popups[i] != undefined)
			{
				var element = document.getElementById(popups[i]);
				element.style.right = right + "px";
				right = right + 270;
				element.style.display = "block";
			}
		}
		
		for(var j = i; j < popups.length; j++)
		{
			var element = document.getElementById(popups[j]);
			element.style.display = "none";
		}
	}
	

	
	
	
	//creates markup for a new popup. Adds the id to popups array.
	function register_popup(id, name, groupID)
	{
		
		alert("registering " + id + " " + name + "  " + popups.length );
		
		
		for(var i = 0; i < popups.length; i++)
		{   
			//already registered. Bring it to front.
			if(id == popups[i])
			{
				Array.remove(popups, i);
			
				popups.unshift(id);
				
				calculate_popups();
				
				
				return;
			}
		}      
		
		
			//alert("LOL");
			var msgBoxVar = document.createElement("div");
			msgBoxVar.id = id;
			msgBoxVar.className = "msg_box";
			msgBoxVar.style.right = "300px";
			
			//alert("LOL2");
			var msgHeadVar = document.createElement("div");
			msgHeadVar.id = id + "msg_head"
			msgHeadVar.className = "msg_head";
			msgHeadVar.addEventListener("click", function(){
				

				 var getDown = "#" + id + "msg_wrap";
				 $( getDown ).slideToggle('slow');
				 
				
			}, false);
			msgHeadVar.innerHTML = name;
			
			
			//alert("LOL3");
			var closeMsgVar = document.createElement("div");
			closeMsgVar.className = "closex";

					
			//alert("LOL4");
			var closeA = document.createElement("a");
			closeA.href = "javascript:close_popup('" + id +"','" + groupID + "');";
			closeA.innerHTML = "   &#10005;";
			closeMsgVar.appendChild(closeA);
			
			

			msgHeadVar.appendChild(closeMsgVar);
			

			
			var msgWrapVar = document.createElement("div");
			msgWrapVar.className="msg_wrap";
			msgWrapVar.id = id + "msg_wrap";
			
			var msgBodyVar = document.createElement("div");
			msgBodyVar.className="msg_body";
			
			var msgAVar = document.createElement("div");
			msgAVar.className="msg_a";
			msgAVar.innerHTML = "this is from A";
			
			
			var msgBVar = document.createElement("div");
			msgBVar.className="msg_b";
			msgBVar.innerHTML = "this is fromB";
			
			
			var msgInsertVar = document.createElement("div");
			msgInsertVar.className = "msg_insert";
			msgInsertVar.id = id + "msg_insert";
			
			//alert("LOL5");
			
			var msgFooterVar = document.createElement("div");
			msgFooterVar.className = "msg_footer";
			
			var textAreaVar = document.createElement("textarea");
			textAreaVar.className ="msg_input";
			textAreaVar.addEventListener("keydown", function(){
				
				//alert("trying to ficnfsdafasdf asdfsF");
				sendMessage(textAreaVar, name, groupID);
				
			}, false);

			textAreaVar.rows = 4;
			textAreaVar.placeholder = "Send message...";
			
			msgBodyVar.appendChild(msgAVar);
			msgBodyVar.appendChild(msgBVar);
			msgBodyVar.appendChild(msgInsertVar);
			
			msgFooterVar.appendChild(textAreaVar);
			
			msgWrapVar.appendChild(msgBodyVar);
			msgWrapVar.appendChild(msgFooterVar);
			
			
			
			msgBoxVar.appendChild(msgHeadVar);
			msgBoxVar.appendChild(msgWrapVar);
			
			
			document.body.appendChild(msgBoxVar);
		
		
		
		popups.unshift(id);
				
		calculate_popups();
		
	}
	
	function putDownChat(){
		
		alert("ASDASDASD????????ASDSD");
	}
	
	//calculate the total number of popups suitable and then populate the toatal_popups variable.
	function calculate_popups()
	{
		
		var width = window.innerWidth;
		if(width < 540)
		{
			total_popups = 0;
		}
		else
		{
			width = width - 200;
			//270 is width of a single popup box
			total_popups = parseInt(width/270);
		}
		
		//alert( total_popups);
		display_popups();
		
	}
	
	window.addEventListener("resize", calculate_popups);
	window.addEventListener("load", calculate_popups);
	
	
	
	
	
				

//===========================================================================================


//====================  Showing Notifications   ==================================

  function showNotifications(){
    
    var bell = document.getElementById("bellImg");
      
    $.get( "returnSTH.php", function( data ) {
      //alert( "Data Loaded: [" + data +"]" );
      document.getElementById("notificationArea").innerHTML = data;
    });   
    
  }
  
  //==================== Starting game and inviting

  function inviteFriend(whom){
    
    //alert("Inviting: " + whom);
    
    if( document.getElementById("joined").innerHTML.indexOf(whom) < 0 ){
      var a = document.getElementById("joined");
      a.innerHTML = a.innerHTML + whom + " just joined the chat!<br>";
    }
    else{
      var a = document.getElementById("joined");
      a.innerHTML = a.innerHTML + whom + " already invited/joined!<br>";
    }
    
  }
  
  
  
  var timerid = 0;
  var i = 3;
  
  function startTimee(){
    if(timerid)
    {
      timerid = 0;
    }
    var tDate = new Date();
    

    if(tDate.getSeconds() % 6 != 0)
    {
      document.getElementById("playtimer").innerHTML = i;
      i--;
    }
    else{
       window.location.href = "https://www.youtube.com/watch?v=OD3F7J2PeYU";
    }

    timerid = setTimeout("startTimee()", 1000);
    
  }
  
  function playNow(){
    
    startTimee();
  }
  function confirmSessionStart(){
	//var userName = document.getElementById('user').value;
	var sessionName = document.getElementById('sessionName').value;
	
	$.ajax({
		url:'sessionName.php',
		method:'get',
		data:{sesName: sessionName},
	});
	
  }
  //====================  Downloading current version of the game  ==================================
  
    function download(){

       window.location.href = "http://thewitcher.com/en/witcher3";
    
  }
