<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: login.php");
   }
?>




<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<?php include 'partials/nav.php'?>


<div class="header">
        <h2>Please click on the logout button</h2>
 
</div>
<div
      <div
        <h3>

        </h3>
      </div>

</div>

</body>
</html>
