<?php 
	session_start();

	if(isset($_POST['username']) && isset($_POST['password'])){
	    include "./controler/conf.php";
	    include "./controler/database.php";
	    $username = addslashes($_POST['username']);
	    $password = sha1($_POST['password']);

		//render data
		$req = $pdo->prepare("SELECT * FROM ident WHERE login = :login AND pwd = :pwd");
		$req->bindParam(':login', $username, PDO::PARAM_STR);
		$req->bindParam(':pwd', $password, PDO::PARAM_STR);
		try {
	      $req->execute();
	      //$req->debugDumpParams();
	      while($row = $req->fetch(PDO::FETCH_ASSOC)){
		      $_SESSION['id'] = $row['id'];
			  header('Location:index.php');
	      };

	    } catch (PDOException $e) {
	      echo 'Erreur : ' . $e->getMessage() . '<br />';
	      echo 'N° : ' . $e->getCode();
	    }
	}
?>
 


<form action="#" method="post">
	<div class="form-group">
		<label for="username">Nom d'utilisateur</label>
		<input type="text" class="form-control" id="username" name="username">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
	<button type="submit" class="btn btn-default">Se connecter</button>
</form>

<!-- pour debuggage-->
  <!-- <pre>
   <?php
   echo "Superglobale SESSION<BR>";
   print_r($_SESSION);
   echo "Superglobale SERVER<BR>";
   print_r($_SERVER);
   echo "Superglobale FILE<BR>";
   print_r($_FILE);
   echo "Superglobale REQUEST<BR>";
   print_r($_REQUEST);
   echo "__FILE__<BR>";
   echo __FILE__;
   echo "<br>";
   echo dirname(__FILE__);
   ?>
 </pre> -->