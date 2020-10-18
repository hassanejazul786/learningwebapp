function validate()
{ 
  var correct=0;
  var error=0;
   if(document.Registration.uname.value == ""){
     document.getElementById("un").innerHTML="Please enter your user name!";
     document.getElementById("un").style.color = "red";
     document.Registration.uname.focus();
     error++;
   } else {
     document.getElementById("un").innerHTML="Correct";
     document.getElementById("un").style.color = "green";
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
   if(document.Registration.usertype.value){
    document.getElementById("ut").innerHTML="Correct";
     document.getElementById("ut").style.color = "green";
     correct++;
   }else{
    document.getElementById("ut").innerHTML="Please select user type";
     document.getElementById("ut").style.color = "red";
     document.Registration.usertype.focus() ;
     error++;
   }

   if(document.Registration.dob.value){
     document.getElementById("db").innerHTML="Correct";
     document.getElementById("db").style.color = "green";
     correct++;
   }else{
     document.getElementById("db").innerHTML="Please select your D.O.B";
     document.getElementById("db").style.color = "red";
     document.Registration.dob.focus() ;
     error++;
   }
   
    /*x=document.Registration.dob.value;
    y= new Date();
    var eighteenYearsAgo = moment().subtract(18, "years");
    var birthday = moment(x);
    var current = moment(y);

    if (!birthday.isValid()) {
      document.getElementById("db").innerHTML="Please Select your DOB"; 
      document.getElementById("db").style.color = "red";
      document.Registration.dob.focus();
      error++;
   }   
    else if(eighteenYearsAgo.isAfter(birthday)) {
      document.getElementById("db").innerHTML="You are 18+";    
      document.getElementById("db").style.color = "green";
      correct++;
    }else {
      document.getElementById("db").innerHTML="You are Under 18";    
      document.getElementById("db").style.color = "red";
      error++;
    }*/
    var gender = Registration.querySelectorAll('input[name="genders"]:checked');
   if(!gender.length)
   {
     document.getElementById("gend").innerHTML="Please select your gender!";
     document.getElementById("gend").style.color = "red";
     error++;
   }else {
     document.getElementById("gend").innerHTML="Correct";
     document.getElementById("gend").style.color = "green";
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
    
   
    if(correct==7){
      return true;
    } else {
      return false;
    }
}