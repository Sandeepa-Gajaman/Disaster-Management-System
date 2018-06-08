function loginValidate(){
	var userName= document.getElementById("userName").value;
	var Password= document.getElementById("password").value;
	//var tempUserName= userName.match(/\s?/g);
	//var tempPassword= Password.match(/\s?/g);
	var tempUserName= userName.trim();
	var tempPassword= Password.trim();

	if(tempUserName== ""){
		document.getElementById("error").innerHTML= "Can't leave field(s) empty!";
		return false;
	}
	if(tempPassword== ""){
		document.getElementById("error").innerHTML= "Can't leave field(s) empty!";
		return false;
	}
	return true;
}

function resetErrors(){
	document.getElementById("error").innerHTML= "";
	document.getElementById("error2").innerHTML= "";
}

function validateUserName(){
	var userName= document.getElementById("userName").value;
	var tempUserName= userName.trim();
	if(tempUserName== ""){
		document.getElementById("error").innerHTML= "Can't leave field(s) empty!";
	}
}

function validatePassword(){
	var Password= document.getElementById("password").value;
	var tempPassword= Password.trim();
	if(tempPassword== ""){
		document.getElementById("error").innerHTML= "Can't leave field(s) empty!";
	}
}