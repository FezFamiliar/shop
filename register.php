<?php

include 'config.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){


     $username = mysqli_real_escape_string($conn,$_POST['username']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
     $psw = mysqli_real_escape_string($conn,$_POST['password']);
     $query = "INSERT INTO `users` (username,email,password,joined) VALUES('".$username."','".$email."','".md5($psw)."',NOW())";
     if(mysqli_query($conn,$query)){


        $_SESSION['username'] = $username;

     }
     else echo 'Failed!';
   }
 ?>

<div class="wrapper">
  <form action="register" method="POST" autocomplete="off" id="register-form">
    <table>
      <tr>
        <td><label for="username">Username: </label></td>
        <td><input type="text" name="username" autocomplete="off" id="username"></td>
      </tr>
      <tr id="register-user">
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><label for="email">E-mail:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="email" name="email" id="email"></td>
      </tr>
      <tr id="register-email">
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><label for="password"> Password:</label></td>
        <td><input type="password" name="password" id="password"></td>
      </tr>
      <tr id="register-pass">
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="Sign up"></td>
      </tr>
    </table>
  </form>
</div>
