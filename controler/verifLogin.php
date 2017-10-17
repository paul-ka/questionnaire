<?php 
$auth = 0;

if(isset($_POST['username']) && isset($_POST['password'])){
    include "./controler/conf.php";
    include "./controler/database.php";
    $username = $pdo->quote($_POST['username']);
    $password = sha1($_POST['password']);


	//render data
	$req = $pdo->prepare("SELECT * FROM ident WHERE login = :login AND pwd = ':pwd'");
	$req->bindParam(':login', $username, PDO::PARAM_STR);
	$req->bindParam(':pwd', $password, PDO::PARAM_STR);
	if ($req->execute()) {
	  while ($row = $req->fetch()) {
	  	$_SESSION['id'] = $row['id'];
	  	header('Location:index.php');
	  }	
	}

	
}
 ?>