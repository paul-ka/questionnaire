<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="./asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="./asset/css/quill.snow.css">
	<link rel="stylesheet" href="./asset/css/questionnaire.css">
	<link rel="icon" href="./asset/img/sabots.ico" type="image/x-icon">
</head>
<body>
  <div class="container">
    <?php include "./controler/conf.php" ?>
    <?php include "./controler/database.php" ?>
    <?php include "./controler/readAnswer.php" ?>
  </div>



<!-- pour debuggage-->
   <pre>
   <?php
   print_r($answer);
   echo "Superglobale SERVER<BR>";
   print_r($_SERVER);
   echo "Superglobale REQUEST<BR>";
   print_r($_REQUEST);
   echo "__FILE__<BR>";
   echo __FILE__;
   echo "<br>";
   echo dirname(__FILE__);
   ?>
 </pre>
</body>
</html>