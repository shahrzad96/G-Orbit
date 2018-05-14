
function changeName(){
		
		//alert("Trying to change name");
			var changeName = document.createElement("div");
			changeName.id = "changeName";

			var newNameInput = document.createElement("input");
			newNameInput.id =  "newNameInput";
			newNameInput.type = "text";
			newNameInput.placeholder = "Enter new display name..";
			newNameInput.style.margin = " 30px ";
			
			var confirm = document.createElement("button");
			confirm.id= "confirm_button";
			confirm.addEventListener("click", function(){
				
				 var a = newNameInput.value;
				 alert(a);
				 newNameInput.value = "";
				
			}, false);
			
			var name = document.createTextNode("Change name");

			
			confirm.appendChild(name);
			changeName.appendChild(newNameInput);
			changeName.appendChild(confirm);
			
			var element = document.getElementById("answers");
			
			deleteChildren(element);
			
			element.appendChild(changeName);
			
			
		}
		
function changePasswordd(){
	//alert("Trying to change password");
	var changePass = document.createElement("div");
		changePass.id = "changePass";

		var newNameInput = document.createElement("input");
		newNameInput.id =  "newNameInput";
		newNameInput.type = "password";
		newNameInput.placeholder = "Enter current password..";
		newNameInput.style.margin = " 30px ";
		
		var newNameInput2 = document.createElement("input");
		newNameInput2.id =  "newNameInput2";
		newNameInput2.type = "password";
		newNameInput2.placeholder = "Enter new password..";
		newNameInput2.style.margin = " 30px ";
		
		var confirm = document.createElement("button");
		confirm.id= "confirm_button";
		confirm.addEventListener("click", function(){

			if( newNameInput.value == newNameInput2.value ){
				alert("The new password is: " + newNameInput2.value);	
				newNameInput.value = "";
				newNameInput2.value = "";
			}
			else
				alert("The passwords do now match");
				newNameInput.value = "";
				newNameInput2.value = "";
			 
		}, false);
		

		var name = document.createTextNode("Change passwords");

		
		confirm.appendChild(name);
		changePass.appendChild(newNameInput);
		changePass.appendChild(newNameInput2);
		changePass.appendChild(confirm);
		
		var element = document.getElementById("answers");
		
		deleteChildren(element);
		
		element.appendChild(changePass);
	
	
	
}





function deleteChildren(element){

	while (element.firstChild) {
		element.removeChild(element.firstChild);
	}
	
}


function getStatus(){
//alert("Getting status");
	var status = document.createElement("div");

	var statusID = document.createElement('p');
	statusID.innerHTML = "There are no problems with your account";
	statusID.className = "statusClass";
	

	status.appendChild(statusID);

	var element = document.getElementById("answers");
			
	deleteChildren(element);
	
	element.appendChild(status);

}

function changeEmail(){
	//alert("Trying to change email");
	var changeEmail = document.createElement("div");
		changeEmail.id = "changeEmail";

		var newNameInput = document.createElement("input");
		newNameInput.id =  "newEmailInput";
		newNameInput.type = "text";
		newNameInput.placeholder = "Enter current e-mail..";
		newNameInput.style.margin = " 30px ";
		
		var newNameInput2 = document.createElement("input");
		newNameInput2.id =  "newEmailInput2";
		newNameInput2.type = "text";
		newNameInput2.placeholder = "Enter new e-mail..";
		newNameInput2.style.margin = " 30px ";
		
		var confirm = document.createElement("button");
		confirm.id= "confirm_button";
		confirm.addEventListener("click", function(){

			if( newNameInput.value == newNameInput2.value ){
				alert("The new email is: " + newNameInput2.value);	
				newNameInput.value = "";
				newNameInput2.value = "";
			}
			else
				alert("The e-mails do now match");
				newNameInput.value = "";
				newNameInput2.value = "";
			 
		}, false);
		
		var name = document.createTextNode("Change e-mail");

		
		confirm.appendChild(name);
		changeEmail.appendChild(newNameInput);
		changeEmail.appendChild(newNameInput2);
		changeEmail.appendChild(confirm);
		
		var element = document.getElementById("answers");
		
		deleteChildren(element);
		
		element.appendChild(changeEmail);
	
	
	
}
function messages(){

//alert("Getting messages");
	var status = document.createElement("div");
	status.className = "msg_input";

	var statusID = document.createElement('p');
	statusID.innerHTML = "There are no new messages";
	statusID.className = "statusClass";
	

	status.appendChild(statusID);

	var element = document.getElementById("answers");
			
	deleteChildren(element);
	
	element.appendChild(status);

}