<?php 
echo '<br />';
$req = $pdo->query('SELECT * FROM form');
$resul = [];
while($message = $req->fetch())
{
	array_push($resul, $message);
}
