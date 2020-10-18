function validate_parent()
{ 
  var correct=0;
  var error=0;
   if(document.Registration.name.value == ""){
     document.getElementById("nm").innerHTML="Please enter your name!";
     document.getElementById("nm").style.color = "red";
     document.Registration.name.focus();
     error++;
   } else {
     document.getElementById("nm").innerHTML="Correct";
     document.getElementById("nm").style.color = "green";
     correct++;
   }

   var email = document.Registration.email.value;
   atpos = email.indexOf("@");
   dotpos = email.lastIndexOf(".");
   if (email == "" || atpos < 1 || ( dotpos - atpos < 2 )) 
   {
     document.getElementById("em").innerHTML="Please enter correct email ID";
     document.getElementById("em").style.color = "red";
     document.Registration.email.focus() ;
     error++;

   } else {
     document.getElementById("em").innerHTML="Correct";
     document.getElementById("em").style.color = "green";
     correct++;
   }
   if(document.Registration.pair.value){
    document.getElementById("pc").innerHTML="Correct";
     document.getElementById("pc").style.color = "green";
     correct++;
   }else{
    document.getElementById("pc").innerHTML="Please enter pairing code";
     document.getElementById("pc").style.color = "red";
     document.Registration.pair.focus() ;
     error++;
   }

   if(document.Registration.pass.value == "")
   {
     document.getElementById("pw").innerHTML="Please enter your password!";
     document.getElementById("pw").style.color = "red";
     document.Registration.pass.focus();
     error++;
   }else if(document.Registration.pass.value.length < 6) {
     document.getElementById("pw").innerHTML="Password should have atleast 6 characters";
     document.getElementById("pw").style.color = "red";
     document.Registration.pass.focus();
     error++;
   }else {
     document.getElementById("pw").innerHTML="Correct";
     document.getElementById("pw").style.color = "green";
     correct++;
   }

   var pass1=document.Registration.pass.value;
   var pass2=document.Registration.cpass.value;

   if(document.Registration.cpass.value == "")
   {
     document.getElementById("pw2").innerHTML="Please confirm your password!";
     document.getElementById("pw2").style.color = "red";
     document.Registration.cpass.focus();
     error++;
   }else if(pass1!=pass2) {
    document.getElementById("pw2").innerHTML="Password didn't match";
    document.getElementById("pw2").style.color = "red";
    document.Registration.cpass.focus();
    error++; 
   }else {
     
     document.getElementById("pw2").innerHTML="Correct";
     document.getElementById("pw2").style.color = "green";
     correct++;
   }

   if( document.Registration.cont.value == "" ||
           isNaN( document.Registration.cont.value) ||
           document.Registration.cont.value.length != 10 )
   {
     document.getElementById("ph").innerHTML="Please provide your correct contact number!";
     document.getElementById("ph").style.color = "red";
     document.Registration.cont.focus() ;
      error++;
   }else {
     document.getElementById("ph").innerHTML="Correct";
     document.getElementById("ph").style.color = "green";
     if(error>0){error--};
     correct++;
   }
    
   
    if(correct==6){
      return true;
    } else {
      return false;
    }
}