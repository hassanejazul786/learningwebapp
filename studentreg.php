<?php 
  require("db.php");
?>

<html>
  <head>
    <title>Registration Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
      
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link rel="stylesheet" type="text/css" href="CSS/mediaquery.css">
    <script type="text/javascript" src="javascript/stud_validation.js"></script>
    <script type="text/javascript" src="javascript/funcs.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js"></script>
  </head>
  
  <body class="bg py-5">
    <div class="container my-5">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header">
            <h3>Student Sign Up</h3>
          </div>
          <div class="card-body">
            <form name="Registration" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onsubmit="return validate_student();">
              <div class="input-group form-group">
                <div class="input-group-prepend ">
                  <span class="input-group-text input-text1">Name<span class="text-danger">*</span></span>
                </div>
                <input type="text" class="form-control" name="name" placeholder="name">
              </div>
              <p id="nm"></p>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text input-text1">E-mail<span class="text-danger">*</span></span>
                </div>
                <input type="text" class="form-control" name="email" placeholder="e-mail">
              </div>
              <p id="em"></p>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text input-text1">Join Code<span class="text-danger">*</span></span>
                </div>
                <input type="text" class="form-control" name="join" placeholder="enter join code">
              </div>
              <p id="jc"></p>

              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text input-text1">D.O.B<span class="text-danger">*</span></span>
                </div>
                <input type="date" class="form-control" max="<?php echo date("Y-m-d"); ?>" name="dob" placeholder="enter your D.O.B">
              </div>
              <p id="db"></p>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text input-text1">Gender<span class="text-danger">*</span></span>
                </div>
                <div class="text-white mt-2 px-3">
                  <input class="ml-2" type="radio" name="genders" value="male">Male
                  <input class="ml-2" type="radio" name="genders" value="female">Female
                </div>
              </div>
              <p id="gend"></p>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text input-text1">Password<span class="text-danger">*</span></span>
                </div>
                <input type="password" class="form-control" name="pass" placeholder="password">
              </div>
              <p id="pw"></p>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text input-text1">Confirm Password<span class="text-danger">*</span></span>
                </div>
                <input type="password" class="form-control" name="cpass" placeholder="Confirm password">
              </div>
              <p id="pw2"></p>
              <div class="form-group text-center">
                <input type="submit" value="Register" class="btn login_btn">
              </div>
            </form>
          </div>
          <div class="card-footer">
            <div class="d-flex justify-content-center links">
              <span class="reg-text">Already have an account?<a href="index.php">Sign In</a></span>
            </div>
            <div class="d-flex justify-content-center">
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") { 
          
        $name=$_POST['name'];
        $email=$_POST['email'];
        $join=$_POST['join'];
        $dob=$_POST['dob'];
        $gender=$_POST['genders'];
        $password=md5($_POST['pass']);

        $sql_u = "SELECT * FROM student WHERE join_code='$join'";
        $res_u = mysqli_query($conn, $sql_u);
        $sql_e = "SELECT * FROM student WHERE email='$email'";
        $res_e = mysqli_query($conn, $sql_e);

        if(mysqli_num_rows($res_u) > 0){
          ?>
          <h5 class="text-center text-danger">Sorry... join code already exists</h5>
          <?php
          exit();
        }
        else if(mysqli_num_rows($res_e) > 0){
          ?>
          <h5 class="text-center text-danger">Sorry... email already exists</h5>
          <?php
          exit();
        }else{
           
          $sql = "INSERT INTO student(name, email, join_code, dob, gender, password)
                VALUES('$name', '$email', '$join', '$dob', '$gender', '$password')";

          if($conn->query($sql) === True) {?>
            <h5 class="text-success text-center">Registered Successfully</h5>
            <?php
            echo '<script type="text/javascript">index();</script>';
          }
          else
          {
            echo "Error:".$sql."<br>". $conn->error;
          }

          $conn->close();
        }
      }
   ?>
  </body>
</html>