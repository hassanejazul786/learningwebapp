<?php 
  session_start();
  require("db.php");
?>

<html>
  <head>
    <title>Login Page</title>
     
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">

    <script type="text/javascript" src="javascript/funcs.js"></script>
  </head>

  <body class="bg py-5">
    <div class="container-fluid py-5">
      <div class="container">
        <div class="d-flex justify-content-center">
          <div class="card card2">
            <div class="card-header">
              <h3>Sign In</h3>
            </div>
            <div class="card-body">
              <form name="Login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i><span class="text-danger">*</span></span>
                  </div>
                  <input type="text" class="form-control" name="email" placeholder="email" required>
                </div>
                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i><span class="text-danger">*</span></span>
                  </div>
                  <input type="password" class="form-control" name="pass" placeholder="password" required>
                </div>
                <div class="form-group text-center">
                  <input type="submit" value="Login" class="btn login_btn">
                </div>
              </form>
            </div>
            <div class="card-footer">
              <div class="d-flex justify-content-center links">
                Don't have an account?<a href="register.php">Sign Up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $email=$_POST['email'];
        $password=md5($_POST['pass']);

        $sql="SELECT * FROM student WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);


        $sql2="SELECT * FROM parent WHERE email='$email'";
        $result2=mysqli_query($conn,$sql2);
        $num2=mysqli_num_rows($result2);

        $sql3="SELECT * FROM teacher WHERE email='$email'";
        $result3=mysqli_query($conn,$sql3);
        $num3=mysqli_num_rows($result3);


        if($num>0) {
          while($row=mysqli_fetch_array($result)){
            if($password == $row["password"]){
              /*echo "Login Successfully...";*/
              $_SESSION["user"]=$row;
              $_SESSION["type"]='Student';
              /*header("Location: dashboard.php");*/
              echo '<script type="text/javascript">dashboard();</script>';
              break;
            }
            else{
             ?>
              <h5 class="text-center text-danger">username/Password is incorrect</h5>
             <?php
            }
          }
        }
        
        else if($num2>0) {
          while($row=mysqli_fetch_array($result2)){
            if($password == $row["password"]){
              /*echo "Login Successfully...";*/
              $_SESSION["user"]=$row;
              $_SESSION["type"]='Parent';
  
              /*header("Location: dashboard.php");*/
              echo '<script type="text/javascript">dashboard();</script>';
              break;
            }
            else{
             ?>
              <h5 class="text-center text-danger">username/Password is incorrect</h5>
             <?php
            }
          }
        }

         else if($num3==0){
          ?>
          <h5 class="text-center text-danger">Email doesn't exist</h5>
          <?php
        }else if($num3>0) {
          while($row=mysqli_fetch_array($result3)){
            if($password == $row["password"]){
              /*echo "Login Successfully...";*/
              $_SESSION["user"]=$row;
              $_SESSION["type"]='Teacher';
  
              /*header("Location: dashboard.php");*/
              echo '<script type="text/javascript">dashboard();</script>';
              break;
            }
            else{
             ?>
              <h5 class="text-center text-danger">username/Password is incorrect</h5>
             <?php
            }
          }
        }

      }
    ?>
  </body>
</html>