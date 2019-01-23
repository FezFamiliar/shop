<?php
session_start();
include 'config.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(mysqli_real_escape_string($conn,$_POST['name']) == 'admin' && mysqli_real_escape_string($conn,$_POST['psw']) == 'abc'){
          $_SESSION['admin'] = 'admin';
          header( "refresh:0;url=products.php?page=1");
        }
  else
    echo "<script>alert('data incorecte')</script>";

}
if(isset($_GET['logout']))session_unset();

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="admin_style.css">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <div class="container">
      <form action="index.php" method="POST" autocomplete="off">
        <br>
        <h2>Administration area</h2>
            <table>
              <tr>
                <td width="50"></td>
                <td><b>Utilizator:</b></td>
                <td><input type="text" name="name"></td>
              </tr>
              <tr>
                <td width="50"></td>
                <td align="left"><b>Parola:</b></td>
                <td><input type="password" name="psw"></td>
              </tr>
            </table>
        <input type="submit" value="Login" class="submit">
        <br><br>
        <p>If you haven't got privileges for this entrance,<br>
         please go back to our <a href="../index.php">Main Page.</a></p>
      </form>
    </div>
  </body>
</html>
