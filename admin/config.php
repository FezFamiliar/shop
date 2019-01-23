<?
include 'functions/functions.php';

$conn = mysqli_connect('localhost','root','','shop') or die('Database connection failed: '.mysqli_error());

$currency = ' $';
$root = $_SERVER['DOCUMENT_ROOT'];
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
     <link rel="stylesheet" href="admin_style.css">
      <link rel="shortcut icon"  type="image/png" href="../images/favicon-server.ico">
     <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   </head>
   <script
     src="https://code.jquery.com/jquery-3.3.1.js"
     integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
     crossorigin="anonymous"></script>
   <script type="text/javascript" src="functions/functions.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../tinymce/jquery.tinymce.min.js">
  </script>
  <script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
  <script type="text/javascript" src="../tinymce/themes/modern/theme.min.js"></script>
   </head>
   <body>

   </body>
 </html>
