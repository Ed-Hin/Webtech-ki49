<?php
   include("../../connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($connection,$_POST['username']);
      $mypassword = mysqli_real_escape_string($connection,$_POST['password']); 
      
      $sql = "SELECT * FROM Users WHERE user = '$username'";
      $result = mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      if ($row) {
        if (password_verify($mypassword, $row["pass"])) {
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id'] = $row["ID"];
            header("location: index.php");
        } else {
            $error = "Your Login Name or Password is invalid";
        }
      } else {
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
    <link rel="icon" type="image/x-icon" href="logo_alleen_symbol.png">
    <title>WhoAsked</title>
</head>

<body>
    <form action="login.php" method="post">

        <div class="logo">
            <a href="index.php" title="NAME"></a>
        </div>

        <div class="huh">
            <div class="container">
                <div style="position: relative;">
                    <span class="close"><a href="index.php" class="closebtn">&times;</a></span>

                </div>
                <h1>Log In</h1>
                <?php
                if (isset($error)) {
                    echo "<h4> Error: " . $error . "</h4>";
                }
            ?>
                <label for="username">
                    <p class="user">Username</p>
                </label>
                <input type="text" name="username" required>

                <label for="password">
                    <p class="pass">Password</p>
                </label>
                <input type="password" name="password" required>

                <button type="submit">Log In</button>
            </div>
        </div>
        </div>
    </form>
</body>

</html>