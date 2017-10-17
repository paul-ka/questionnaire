<?php 

$reqFind = false;
if(isset($_POST['formId'])){
	$answer['formId'] = $_POST['formId'];
};
if(isset($_POST['question1'])&&($_POST['question1'])!==''){
	$answer['question1']=$_POST['question1'];
};
if(isset($_POST['question2'])&&($_POST['question2'])!==''){
	$answer['question2']=$_POST['question2'];
};
if(isset($_POST['question3'])&&($_POST['question3'])!==''){
	$answer['question3']=$_POST['question3'];
};
if(isset($_POST['question4'])&&($_POST['question4'])!==''){
	$answer['question4']=$_POST['question4'];
};
if(isset($_POST['question5'])&&($_POST['question5'])!==''){
	$answer['question5']=$_POST['question5'];
};
//save data
$req = $pdo->prepare("INSERT INTO answers (
		formId, 
		question1,
		question2,
		question3,
		question4,
		question5
	)VALUES (
		:formId, 
		:question1,
		:question2,
		:question3,
		:question4,
		:question5
	)");
$req->bindParam(':formId', $answer['formId'], PDO::PARAM_INT);
$req->bindParam(':question1', $answer['question1'], PDO::PARAM_STR);
$req->bindParam(':question2', $answer['question2'], PDO::PARAM_STR);
$req->bindParam(':question3', $answer['question3'], PDO::PARAM_STR);
$req->bindParam(':question4', $answer['question4'], PDO::PARAM_STR);
$req->bindParam(':question5', $answer['question5'], PDO::PARAM_STR);

$req->execute();		
	
/*include "./view/merci.php";*/

?>
