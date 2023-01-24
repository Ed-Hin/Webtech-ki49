<?php
   include("../../connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!doctype html>
<html lang="eng">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="login.css">
        <title>Log in | Forum</title>
    </head>
    <body>
    <form action="home.html" method="post">

        <div class="logo">
            <a href="home.html" title="NAME"></a>
        </div>

        <div class="huh">
        <div class="container">
            <div style="position: relative;">
                <span class="close"><a href="home.html">&times;</a></span>
                
            </div>
            <h1>Log In</h1>
            <label for="username"><p class="user">Username</p></label>
            <input type="text" name="username" required>

            <label for="password"><p class="pass">Password</p></label>
            <input type="text" name="password" required>

            <button type="submit">Log In</button>
        </div>
        </div>
        </div>
</form>
    </body>
</html>