<?php
require("db.php");
global $conn;
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_by=$_POST['uploader'];
  $reply=mysqli_real_escape_string($conn, $_POST['reply']);
  $date=$_POST['date'];
  $topic=$_POST['topic'];

  $sql="INSERT INTO posts(post_topic, post_by, post_cont, post_date) VALUES('$topic', '$post_by', '$reply', '$date' )";
  if(mysqli_query($conn, $sql) === True){
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
  }else {
    echo "Error:".$sql."<br>". $conn->error;
  }
  $conn->close();
  }
?>