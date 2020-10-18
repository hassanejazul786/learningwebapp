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
    <script type="text/javascript" src="javascript/reg_validation.js"></script>
    <script type="text/javascript" src="javascript/funcs.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js"></script>
  </head>
  
  <body class="bg py-5">
    <div class="container my-5">
      <div class="d-flex justify-content-center">
        <div class="card card2">
          <div class="card-header text-center">
            <h3>Sign Up</h3>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="studentreg.php">Student Sign up</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="parentreg.php">Parent Sign up</a>
            </div>
            <br>
            <div class="d-flex justify-content-center">
              <a class="btn login_btn w-50" href="teacherreg.php">Teacher Sign up</a>
            </div>
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

    
  </body>
</html>