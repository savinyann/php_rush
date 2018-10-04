<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="inscription.css">
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

   <?php
   session_start();
   if (isset($_POST["username"]))
   {
      $i = true;
      $username = $_POST["username"];
      $password = $_POST["password"];
      $password_conf = $_POST["password_conf"];
      $email = $_POST["email"];
      $admin = 0;

      if ((strlen($username) < 3) || (strlen($username) > 20)) {
         echo "Invalid name <br>";
         $i = false;
      }

      if (!filter_var(strtolower($email), FILTER_VALIDATE_EMAIL)) {
         echo "Invalid email <br>";
         $i = false;
      }

      if ((strlen($password) < 4) || (strlen($password) > 12) || ($password != $password_conf)) {
         echo "Invalid password or password confirmation.<br>";
         $i = false;
      }

      if ($i == true) {
         $host ="coding-academy.com";
         $port =3306;
         $db ="pool_php_rush";
         $my_username ="root";
         $my_password ="root";
         $password = password_hash($password, PASSWORD_DEFAULT);
         try
         {
            $dbh = new PDO("mysql:host=$host;port=$port;dbname=$db", $my_username, $my_password);
            $req= $dbh->prepare("INSERT INTO users(username, password, email, admin) VALUES ('$username','$password','$email','0')");
            $req->execute();
            echo "User created<br>";
            header("Location: index.php");
         }
         catch (PDOException $e) {
            echo $req . "<br>" . $e->getMessage();
         }
      }
   }
   ?>
   <div id="fullscreen_bg" class="fullscreen_bg"/>
   <div class="register">


      <h1>Register</h1>
      <form action="inscription.php" method="post">
         <label for="username">Name </label><input type="text" class="form-control" name="username" required/>
         <label for="email">Email </label><input type="email" name="email" class="form-control" required/>
         <label for="password">Password </label><input type="password" class="form-control" name="password" required/>
         <label for="password_conf">Password Confirmation </label><input type="password" class="form-control" name="password_conf" required/></p>
         <div> <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button></div>
      </form>
      <p>Already registered? <a href="login.php">Log in!</a></p>
   </div>
</div>
</body>
</html>
