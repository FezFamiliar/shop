<?php

include 'config.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){


  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);


  $query = "SELECT * FROM `users` WHERE username = '".$username."' AND password = '".md5($password)."'";
  $result = mysqli_query($conn,$query);
  if(mysqli_num_rows($result) > 0){

    $_SESSION['username'] = $username;
    header("refresh:0;url=login.php");

  }else{

    echo 'Username or password doesn\'t match!';

  }

}
 ?>
 <div class="wrapper">
   <form action="login.php" method="POST" autocomplete="off" id="login-form">
     <table>
       <tr>
         <td><label for="username">Username: </label></td>
         <td><input type="text" name="username" autocomplete="off" id="username"></td>

       </tr>
       <tr id="validate-user">
         <td></td>
         <td></td>
       </tr>
       <tr>
         <td><label for="password"> Password:</label></td>
         <td><input type="password" name="password" id="password"></td>
       </tr>
       <tr id="validate-pass">
         <td></td>
         <td></td>
       </tr>
       <tr>
         <td id="par"></td>
         <td><input type="submit" value="Login"></td>
       </tr>
     </table>
   </form>
 </div>
<? include 'footer.php'; ?>
