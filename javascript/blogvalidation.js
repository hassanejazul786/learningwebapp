function blogsvalidate()
{ 
  var correct=0;
  var error=0;
   if(document.blog.title.value == ""){
     document.getElementById("ti").innerHTML="Please enter title!";
     document.getElementById("ti").style.color = "red";
     document.blog.title.focus();
     error++;
   } else {
     document.getElementById("ti").innerHTML="Correct";
     document.getElementById("ti").style.color = "green";
     correct++;
   }

   if(document.blog.desc.value == ""){
     document.getElementById("des").innerHTML="Please enter description!";
     document.getElementById("des").style.color = "red";
     document.blog.desc.focus();
     error++;
   } else {
     document.getElementById("des").innerHTML="Correct";
     document.getElementById("des").style.color = "green";
     correct++;
   }
   if(correct==2){
    return true;
   }else
   {
    return false;
   }

 }
