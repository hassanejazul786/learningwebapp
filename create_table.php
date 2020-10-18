<?php
 require("db.php");
  
 $sql = "CREATE table student(
        ID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(30) NOT NULL,
        join_code INT(11) NOT NULL,
        dob datetime NOT NULL,
        gender VARCHAR(10) NOT NULL,
        password VARCHAR(50) NOT NULL)";

  if ($conn->query($sql) === TRUE)
 {
  echo "Table student created successfully";
 } 
 else 
 {
  echo "Error creating table: " . $conn->error;
 }

 
 $sql2 = "CREATE table parent(
        ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(30) NOT NULL,
        pairing_code INT(11) NOT NULL,
        password VARCHAR(50) NOT NULL,
        contact VARCHAR(10) NOT NULL)";

 if ($conn->query($sql2) === TRUE)
 {
  echo "<br>"."Table parent created successfully";
 } 
 else 
 {
  echo "<br>"."Error creating table: " . $conn->error;
 }

 $sql3 = "CREATE table teacher(
        ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL)";

 if ($conn->query($sql3) === TRUE)
 {
  echo "<br>"."Table teacher created successfully";
 } 
 else 
 {
  echo "<br>"."Error creating table: " . $conn->error;
 }

$sql4 = "CREATE table notice(
        ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        subject VARCHAR(100) NOT NULL,
        notice text(500) NOT NULL,
        notice_date date NOT NULL)";

 if ($conn->query($sql4) === TRUE)
 {
  echo "<br>"."Table notice created successfully";
 } 
 else 
 {
  echo "<br>"."Error creating table: " . $conn->error;
 }

$sql5 = "CREATE table materials(
        ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        subject VARCHAR(30) NOT NULL,
        uploaded_by VARCHAR(50) NOT NULL,
        upload_date date NOT NULL,
        filename VARCHAR(100) NOT NULL)";

 if ($conn->query($sql5) === TRUE)
 {
  echo "<br>"."Table materials created successfully";
 } 
 else 
 {
  echo "<br>"."Error creating table: " . $conn->error;
 }

$sql6 = "CREATE table topics(
        ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        topic_subject VARCHAR(30) NOT NULL,
        topic_by VARCHAR(50) NOT NULL,
        topic_title text(100) NOT NULL,
        topic_desc text(500) NOT NULL,
        topic_date date NOT NULL)";

 if ($conn->query($sql6) === TRUE)
 {
  echo "<br>"."Table topics created successfully";
 } 
 else 
 {
  echo "<br>"."Error creating table: " . $conn->error;
 }

 $sql7= "CREATE table posts(
        ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        post_topic int(11) NOT NULL,
        post_by VARCHAR(50) NOT NULL,
        post_cont text(500) NOT NULL,
        post_date date NOT NULL)";

 if ($conn->query($sql7) === TRUE)
 {
  echo "<br>"."Table posts created successfully";
 } 
 else 
 {
  echo "<br>"."Error creating table: " . $conn->error;
 }
 
 
 ?>