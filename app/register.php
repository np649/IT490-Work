<?php
require(__DIR__."/MQPublish.inc.php");
session_start();
?>

<?php
if(isset($_POST["register"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	echo $_SESSION["username"];




	//calls function from MQPublish.inc.php to communicate with MQ
	$response = register($username, $password);
	 if($response ->status == 200){
                $_SESSION["user"] = $response->data;
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
  	<h2>Registration</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username/Email</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>" required/>
  	</div>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password" required/>
  	</div>

  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="register">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>


