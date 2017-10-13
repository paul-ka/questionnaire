<?php 

// Je me conecte à la base
$conf = Conf::$database["default"];//contient la connexion à la BDD
if(isset(Conf::$connections["default"])){//sort si la connexion est déjà faite
  $db = Conf::$connections["default"];//Stock dans db la connexion si elle est déjà active
}
try{
  $pdo = new PDO(
    'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
    $conf['login'],
    $conf['password'],
    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
  );
  Conf::$connections["default"]= $pdo;
  $db = $pdo;
}catch(PDOException $e){
  if(Conf::debug >= 1){//switch des messages de défaut suivant valeur de debug
    die($e->getMessage());
  }else{
    die('Impossible de se connecter à la base');
  }
}

?>