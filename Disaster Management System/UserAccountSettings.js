function matchPasswords(){
	var a= document.getElementById("password").value;
	var b= document.getElementById("passwordConfirm").value;
	document.getElementById("errors").innerHTML= "";
	document.getElementById("errors2").innerHTML= "";
}

function validateForm(){
	var a= document.getElementById("password").value.trim();
	var b= document.getElementById("passwordConfirm").value.trim();
	var regularExpression= /\s+/g;
	
	if(a== ""){
		document.getElementById("errors").innerHTML= "Fields are empty!";
		return false;
	}
	else if(a!= b){
		document.getElementById("errors").innerHTML= "Passwords don't match!";
		return false;
	}
	else if(a.length< 5){
		document.getElementById("errors").innerHTML= "Password too short!";
		return false;
	}
	else if(a.length> 10){
		document.getElementById("errors").innerHTML= "Password too long!";
		return false;
	}
	else if(regularExpression.test(a)){
		document.getElementById("errors").innerHTML= "Password can't contain spaces!";
		return false;
	}
	else{
		return true;
	}
}