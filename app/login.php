<?php
require(__DIR__."/MQPublish.inc.php");


session_start();
?>

<?php
if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

 $response = login($username, $password);
        if($response->status == 200){
                $_SESSION["user"] = $response->data;
 header("location: welcome.php");
        }
        else{
                var_export($response);
        }



}
?>



<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<?php include 'partials/nav.php'?>


  <div class="header">
        <h2>Login</h2>
  </div>
  <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
          <label>Username/Email</label>
          <input type="text" name="username"required/>
        </div>
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password" required/>
        </div>

        </div>
  <div class="input-group">
          <button type="submit" class="btn" name="login">Login</button>
        </div>


        <p>
                Not yet a member? <a href="register.php">Sign up</a>
        </p>
  </form>
</body>
</html>
