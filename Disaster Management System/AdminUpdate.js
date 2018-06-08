function f1(){
	var fName= document.getElementById("fName").value;
	var pattern= /[0-9]/;
	if(fName.length< 1 || fName.length> 25 || pattern.test(fName)== true){
		document.getElementById("e1").innerHTML= "Should contain 1- 25 characters without numbers!";
		errors= false;
	}
	else{
		document.getElementById("e1").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
		errors= true;
	}
}
function f11(){
	var lName= document.getElementById("lName").value;
	var pattern= /[0-9]/;
	if(lName.length< 1 || lName.length> 25  || pattern.test(lName)== true){
		document.getElementById("e8").innerHTML= "Should contain 1- 25 characters without numbers!";
		errors= false;
	}
	else{
		document.getElementById("e8").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
		errors= true;
	}
}
function f2(){
	var address= document.getElementById("address").value;
	if(address.length<=1){
		document.getElementById("e2").innerHTML= "Should contain 1- 100 characters";
		errors= false;
	}
	else{
		document.getElementById("e2").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
		errors= true;
	}
}
function f3(){
	var contactNumber= document.getElementById("contactNumber").value;
	var pattern= /[\+-]?[0-9]{9,12}/;
	if(pattern.test(contactNumber)== false){
		document.getElementById("e3").innerHTML= "Invalid mobile number!";
		errors= false;
	}
	else{
		document.getElementById("e3").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
		errors= true;
	}
}
function f4(){
	var email= document.getElementById("email").value;
	var pattern= /[a-zA-Z0-9.]{1,20}[@]{1}[a-zA-Z0-9]+[.]{1}[a-z]+[.a-z]+/;
	if(pattern.test(email)== false){
		document.getElementById("e4").innerHTML= "Invalid email!";
		errors= false;
	}
	else{
		document.getElementById("e4").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
		errors= true;
	}
}

function f5(){
	var occupation= document.getElementById("occupation").value;
	if(occupation.length<=1){
		document.getElementById("e5").innerHTML= "Should contain 1- 50 characters";
		errors= false;
	}
	else{
		document.getElementById("e5").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
		errors= true;
	}
}

function f6(){
	var userName= document.getElementById("userName").value;
	if(userName.length<=1){
		document.getElementById("e6").innerHTML= "Should contain 5- 10 characters";
		errors= false;
	}
    else if(userName.length<=5){
		document.getElementById("e6").innerHTML= "Username is too short!";
		errors= false;
	}
	else if(userName.length>=10){
		document.getElementById("e6").innerHTML= "Username is too long!";
		errors= false;
	}
	else{
		document.getElementById("e6").innerHTML= "";
		document.getElementById("error_list").innerHTML= "";
	}
}


function f7(){
	var passwords= document.getElementById("password").value;
	//var cpassword= document.getElementById("cpassword").value;
	if(passwords.length<=1){
		document.getElementById("e7").innerHTML= "Invalid password!";
	}
	else{
		document.getElementById("e7").innerHTML= "";
		//document.getElementById("error_list").innerHTML= "";
	}
}


function f9(){
  var cpasswords= document.getElementById("cpassword").value;
  var passwords= document.getElementById("password").value;
	
	if(cpasswords.length== 0){
		document.getElementById("e9").innerHTML= "Password is empty!";
		errors= false;
	}
	else if(!(cpasswords==passwords)){
		document.getElementById("e9").innerHTML= "Passwords don't match!";
		errors= false;
	}
	else{
		document.getElementById("e9").innerHTML= "";
		
		errors= true;
	}
}


function AddNewUserValidation(){
	var errors=true;;
	//var fName= document.getElementById("fName").value;
	//var pattern= /[a-z]+/;
	
	
	/*if(fName.length < 1 || fName.length > 25 )
	{
		document.getElementById("fNameError").innerHTML= "Should contain 1- 25 characters without numbers!";
		errors= false;
	}*/
	
	
	
var fName= document.getElementById("fName").value;
	var pattern= /[a-z]+/;
	if(fName.length < 1)
	{
		document.getElementById("e1").innerHTML= "Should contain 1- 25 characters without numbers!";
		errors= false;
		//alert("hello");
	}
	if(fName.length>25)
	{
		errors=false;
		document.getElementById("e1").innerHTML= "Should contain 1- 25 characters without numbers!";
		//alert('2');
	}
	if(pattern.test(fName)== false)
	{
		errors=false;
		document.getElementById("e1").innerHTML= "Should contain 1- 25 characters without numbers!";
		//alert('3');
	}
	/*else{
		document.getElementById("fNameError").innerHTML= "";
		errors= true;
		alert("second");
	}*/
	
	
	var lName= document.getElementById("lName").value;
	var pattern= /[a-z]+/;
	if(lName.length< 1 || lName.length> 25  || pattern.test(lName)== false){
		document.getElementById("e8").innerHTML= "Should contain 1- 25 characters without numbers!";
		errors= false;
	}
	/*else{
		document.getElementById("lastNameError").innerHTML= "";
		errors= true;
	}*/
	
	
	var address= document.getElementById("address").value;
	if(address.length< 1 || address.length>100){
		document.getElementById("e2").innerHTML= "Should contain 1- 100 characters!";
		errors= false;
	}
	/*else{
		document.getElementById("addressError").innerHTML= "";
		errors= true;
	}*/
	
	
	var contactNumber= document.getElementById("contactNumber").value;
	var pattern= /[\+-]?[0-9]{9,12}/;
	if(pattern.test(contactNumber)== false){
	   document.getElementById("e3").innerHTML= "Invalid contact number!";
		errors= false;
	}
	/*else{
		document.getElementById("contactNumberError").innerHTML= "";
		errors= true;
	}*/
	
	
	var email= document.getElementById("email").value;
	var pattern= /[a-zA-Z0-9.]{1,20}[@]{1}[a-zA-Z0-9]+[.]{1}[a-z]+[.a-z]+/;
	if(pattern.test(email)== false){
		document.getElementById("e4").innerHTML= "Invalid email!";
		errors= false;
	}
	/*else{
		document.getElementById("emailError").innerHTML= "";
		errors= true;
	}*/
	
	var occupation= document.getElementById("occupation").value;
	if(occupation.length< 1 || occupation.length>50){
		document.getElementById("e5").innerHTML= "Should contain 1- 50 characters!";
		errors= false;
	}
	/*else{
		document.getElementById("occupationError").innerHTML= "";
		errors= true;
	}*/
	var userName= document.getElementById("userName").value;
	if(userName.length< 1 || userName.length>50){
		document.getElementById("e6").innerHTML= "Should contain 1- 50 characters!";
		errors= false;
	}
	
	/*var passwords= document.getElementById("password").value;
	if(passwords.length< 5 || passwords.length> 10){
		document.getElementById("e7").innerHTML= "Password should be between 5- 10 characters!";
		errors= false;
	}
	/*else{
		document.getElementById("e7").innerHTML= "";
		errors= true;
	}*/
	
	
	/*var cpassword= document.getElementById("cpassword").value;
	if(passwords.length== 0){
		document.getElementById("e9").innerHTML= "Password is empty!";
		errors= false;
	}
	else if(cpassword!= passwords){
		document.getElementById("e9").innerHTML= "Passwords don't match!";
		errors= false;
	}
	/*else{
		document.getElementById("e9").innerHTML= "";
		errors= true;
	}
	*/
	
	
//alert(errors);
	return errors;
	
	
}