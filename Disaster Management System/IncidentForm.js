function myFunction()
   {
	   var x=document.getElementById("texta").value;
	   if(x=="")
	   {
		   //alert("required field");
		   document.getElementById("a").style.display="block";
	   }
	   else
	   {
		   document.getElementById("a").style.display="none";
	   }
   }
   function myFunction1()
   {
	   var x=document.getElementById("tArea").value;
	   if(x=="")
	   {
		   //alert("required field");
		   document.getElementById("b").style.display="block";
	   }
	   else
	   {
		   document.getElementById("b").style.display="none";
	   }
   }
   function myfunction2()
   {
	   var x=document.getElementById("deathA").value;
	   if(x=="")
	   {
		   //alert("required field");
		   document.getElementById("deathB").style.display="block";
	   }
	   else
	   {
		   document.getElementById("deathB").style.display="none";
	   }
	   
   }
   function myfunction3()
   {
	   var x=document.getElementById("missingA").value;
	   if(x=="")
	   {
		   //alert("required field");
		   document.getElementById("missingB").style.display="block";
	   }
	   else
	   {
		   document.getElementById("missingB").style.display="none";
	   }
	   
   }
   function myfunction4()
   {
	   var x=document.getElementById("severelyA").value;
	   if(x=="")
	   {
		   //alert("required field");
		   document.getElementById("severelyB").style.display="block";
	   }
	   else
	   {
		   document.getElementById("severelyB").style.display="none";
	   }
	   
   }
   function myfunction5()
   {
	   var x=document.getElementById("minorA").value;
	   if(x=="")
	   {
		   //alert("required field");
		   document.getElementById("minorB").style.display="block";
	   }
	   else
	   {
		   document.getElementById("minorB").style.display="none";
	   }
	   
   }
    function check()
   {
	  var status=true; 
	  var lat=document.getElementById("formLattitude").value;
	  var longt=document.getElementById("formLongitude").value;
      var nme = document.getElementById("fileToUpload");
	  var title=document.getElementById("texta").value;
	  var Area=document.getElementById("tArea").value;
	  var deaths=document.getElementById("deathA").value;
	  var missing=document.getElementById("missingA").value;
	  var severely=document.getElementById("severelyA").value;
	  var injuries=document.getElementById("minorA").value;
	  var patt=/^[0-9]+$/;
	
	  
	 if(!(patt.test(missing)))
	  { 
		  document.getElementById("missingB").style.display="block";
		   document.getElementById("missingA").style.color="red";
		   status=false;
		  
	  }
	 if(!(patt.test(severely)))
	  {
		  document.getElementById("severelyB").style.display="block";
		   document.getElementById("severelyA").style.color="red";
		   status=false;
		  // alert("second");
	  }
	  if(!(patt.test(deaths)))
	  {
		  document.getElementById("deathB").style.display="block";
		   document.getElementById("deathA").style.color="red";
		   status=false;
		  // alert("third");
	  }
	   if(!(patt.test(injuries)))
	  {
		  document.getElementById("minorB").style.display="block";
		   document.getElementById("minorA").style.color="red";
		   status=false;
		   //alert("fourth");
	  }
	 // alert("hello");
	   if(nme.files.length>5)
	  {   document.getElementById("imagesb").style.display="block";
		  alert("you can upload only upto 5 images");
		    status=false;
	  }
	  
	  if(lat=="")
	  {
		  //alert('lattitude
		  document.getElementById("pin").style.display="block";
           status=false;
		  
	  }
	  if(nme.files.length<1)
	  {
		  
		  status=false;
		  document.getElementById("imagesb").style.display="block";
		  
	  }
	  

	  if(title=="")
	  {
		  status=false;
		  document.getElementById("a").style.display="block";
	  }
	  if(Area=="")
	   {   document.getElementById("b").style.display="block";
		  status=false;
	   }
	 
	   if(document.getElementById("star-1").checked ==false &&document.getElementById("star-2").checked ==false && document.getElementById("star-3").checked ==false )
	   {
		    status=false;
		   document.getElementById("threatb").style.display="block";
	   }
	return status;   
			  
   }