function validate_teacher()
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
    
   
    if(correct==4){
      return true;
    } else {
      return false;
    }
}