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
    <script type="text/javascript" src="javascript/teach_validation.js"></script>
    <script type="text/javascript" src="javascript/funcs.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js"></script>
  </head>
  
  <body class="bg py-5">
    <div class="container my-5">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header">
            <h3>Teacher Sign Up</h3>
          </div>
          <div class="card-body">
            <form name="Registration" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onsubmit="return validate_teacher();">
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
        $password=md5($_POST['pass']);

       
        $sql_e = "SELECT * FROM teacher WHERE email='$email'";
        $res_e = mysqli_query($conn, $sql_e);

        
       if(mysqli_num_rows($res_e) > 0){
          ?>
          <h5 class="text-center text-danger">Sorry... email already exists</h5>
          <?php
          exit();
        }else{
           
          $sql = "INSERT INTO teacher(name, email, password)
                VALUES('$name', '$email', '$password')";

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