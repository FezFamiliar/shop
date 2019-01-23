<?
session_start();
include 'functions/functions.php';
$conn = mysqli_connect('localhost','root','','shop') or die('Database connection failed: '.mysqli_error());

$currency = ' $';
$root = $_SERVER['DOCUMENT_ROOT'];
if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'en';
if(isset($_GET['lang']) && $_GET['lang'] == 'ro') $_SESSION['lang'] = 'ro';
if(isset($_GET['lang']) && $_GET['lang'] == 'en') $_SESSION['lang'] = 'en';
if(isset($_GET['lang']) && $_GET['lang'] == 'hu') $_SESSION['lang'] = 'hu';

include 'lang/'.$_SESSION['lang'] .'.php';
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Supermarket</title>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
     <link rel="shortcut icon"  type="image/png" href="images/favicon.ico">
     <link rel="stylesheet" href="lightbox/css/lightbox.min.css">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="/resources/demos/style.css">

     <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   </head>
   <script src="lightbox/js/lightbox-plus-jquery.min.js"></script>
   <script type="text/javascript" src="functions/functions.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   </head>
   <body>

   </body>
 </html>
