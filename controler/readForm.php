<?php 

$reqFind = false;
if(isset($_POST['formTitle'])){
	$form['formTitle'] = $_POST['formTitle'];
};
//reload the picture if she isn't changed
if(isset($_POST['formPicture'])){
	$form['formPicture'] = $_POST['formPicture'];
};
//$_FILES['formPicture']['tmp_name'] existe même si on ne charge pas de fichier.
if(isset($_FILES['formPicture']['tmp_name'])&&($_FILES['formPicture']['tmp_name'])!==""){						
	$ext = substr(strrchr($_FILES['formPicture']['type'], "/"), 1);
	if($form['formPicture']==''){
		$bytes = rand(1, 99999); //generate randomized name
		$nom = "pict/{$bytes}.{$ext}";
	}else{
		$nom = $form['formPicture']; //give the old name to the new picture
	}
	$filename = $_FILES['formPicture']['tmp_name'];
	list($width, $height) = getimagesize($filename);
	//redimentionne si l'image est < 800px de large
	$newHeight = ($width>800) ? $height * 800 / $width : $height;
	$newWidth = ($width>800) ? 800 : $width;
	$loadedPicture = imagecreatefromjpeg($filename);
	$newPicture = imagecreatetruecolor($newWidth , $newHeight) or die ("Erreur");
	 
	imagecopyresampled($newPicture , $loadedPicture, 0, 0, 0, 0, $newWidth, $newHeight, $width,$height);
	imagejpeg($newPicture, $nom, 90);
	$form['formPicture']=$nom;
};
if(isset($_POST['formContent'])){
	$form['formContent']=$_POST['formContent'];
};
if(isset($_POST['formQuestion'])){
	$form['formQuestion']=$_POST['formQuestion'];
};
if(isset($_POST['question1'])&&($_POST['question1'])!==''){
	$form['question1']=$_POST['question1'];
	$form['questionType1']=$_POST['questionType1'];
};
if(isset($_POST['question1'])&&($_POST['question2'])!==''){
	$form['question2']=$_POST['question2'];
	$form['questionType2']=$_POST['questionType2'];
};
if(isset($_POST['question3'])&&($_POST['question3'])!==''){
	$form['question3']=$_POST['question3'];
	$form['questionType3']=$_POST['questionType3'];
};
if(isset($_POST['question1'])&&($_POST['question1'])!==''){
	$form['question4']=$_POST['question4'];
	$form['questionType4']=$_POST['questionType4'];
};
if(isset($_POST['question5'])&&($_POST['question5'])!==''){
	$form['question5']=$_POST['question5'];
	$form['questionType5']=$_POST['questionType5'];
};
if(isset($_REQUEST['id'])){
	$form['id']=intval($_REQUEST['id']);
};

//List form if no formAction
if(!isset($_REQUEST['formAction'])||(addslashes($_REQUEST['formAction'])=='')){
	include "./view/list.php" ;
}

//new form
if(isset($_REQUEST['formAction'])&&(addslashes($_REQUEST['formAction'])=='newForm')){
	include "./view/form.php";
};
//render data
if(isset($_REQUEST['formAction'])&&(addslashes($_REQUEST['formAction'])=='renderForm')){
	$req = $pdo->prepare("SELECT * FROM form WHERE id = :id");
	$req->bindParam(':id', $form['id'], PDO::PARAM_INT);
	if ($req->execute()) {
	  while ($row = $req->fetch()) {
	  	$form['formTitle'] = trim($row['formTitle'],'\'');
	  	$form['formContent'] = trim($row['formContent'], '\'');
	  	$form['formPicture'] = trim($row['formPicture'], '\'');
	  	$form['question1'] = trim($row['question1'],'\'');
	  	$form['questionType1'] = trim($row['questionType1'],'\'');
	  	$form['question2'] = trim($row['question2'],'\'');
	  	$form['questionType2'] = trim($row['questionType2'],'\'');
	  	$form['question3'] = trim($row['question3'],'\'');
	  	$form['questionType3'] = trim($row['questionType3'],'\'');
	  	$form['question4'] = trim($row['question4'],'\'');
	  	$form['questionType4'] = trim($row['questionType4'],'\'');
	  	$form['question5'] = trim($row['question5'],'\'');
	  	$form['questionType5'] = trim($row['questionType5'],'\'');
	  	$reqFind = true;
	  }
	}
	if($reqFind){
		include "./view/renderForm.php";
	}else{
		include "./view/e404.php";
	}
	
};

//read data
if(isset($_REQUEST['formAction'])&&(addslashes($_REQUEST['formAction'])=='readForm')){
	$req = $pdo->prepare("SELECT * FROM form WHERE id = :id");
	$req->bindParam(':id', $form['id'], PDO::PARAM_INT);
	$saveId = $form['id'];
	if ($req->execute()) {
	  while ($row = $req->fetch()) {
	  	foreach($form as $k => $v){
	  		$form[$k]= stripslashes(substr($row[$k],1,-1));
	  	}
	  	$form['id'] = $saveId;
	  	$reqFind = true;
	  }
	}
	if($reqFind){
		include "./view/form.php";
	}else{
		include "./view/e404.php";
	}
};
//save data
if(isset($_REQUEST['formAction'])&&(addslashes($_REQUEST['formAction'])=='saveForm')){
	if($form['id']==0){
		$req = $pdo->prepare("INSERT INTO form (
				formTitle, 
				formPicture, 
				formContent,
				question1,
				questionType1, 
				question2,
				questionType2, 
				question3,
				questionType3, 
				question4,
				questionType4, 
				question5,
				questionType5 
			)VALUES (
				:title, 
				:picture, 
				:content,
				:question1,
				:questionType1, 
				:question2,
				:questionType2, 
				:question3,
				:questionType3, 
				:question4,
				:questionType4, 
				:question5,
				:questionType5 
			)");
		$req->execute(array(
			':title' => $pdo->quote($form['formTitle']),
			':picture' => $pdo->quote($form['formPicture']),
			':content' => $pdo->quote($form['formContent']),
			':question1' => $pdo->quote($form['question1']),
			':questionType1' => $pdo->quote($form['questionType1']),
			':question2' => $pdo->quote($form['question2']),
			':questionType2' => $pdo->quote($form['questionType2']),
			':question3' => $pdo->quote($form['question3']),
			':questionType3' => $pdo->quote($form['questionType3']),
			':question4' => $pdo->quote($form['question4']),
			':questionType4' => $pdo->quote($form['questionType4']),
			':question5' => $pdo->quote($form['question5']),
			':questionType5' => $pdo->quote($form['questionType5'])
		));		
	}else{
		$req = $pdo->prepare("UPDATE form SET
			formTitle = :title, 
			formPicture = :picture, 
			formContent = :content,
			question1 = :question1,
			questionType1 = :questionType1, 
			question2 = :question2,
			questionType2 = :questionType2, 
			question3 = :question3,
			questionType3 = :questionType3, 
			question4 = :question4,
			questionType4 = :questionType4, 
			question5 = :question5,
			questionType5 = :questionType5 			
		 	WHERE id = :id");
		echo('-'.$pdo->quote($form['question5']).'-');
		$req->execute(array(
			':title' => $pdo->quote($form['formTitle']),
			':picture' => $pdo->quote($form['formPicture']),
			':content' => $pdo->quote($form['formContent']),
			':question1' => $pdo->quote($form['question1']),
			':questionType1' => $pdo->quote($form['questionType1']),
			':question2' => $pdo->quote($form['question2']),
			':questionType2' => $pdo->quote($form['questionType2']),
			':question3' => $pdo->quote($form['question3']),
			':questionType3' => $pdo->quote($form['questionType3']),
			':question4' => $pdo->quote($form['question4']),
			':questionType4' => $pdo->quote($form['questionType4']),
			':question5' => $pdo->quote($form['question5']),
			':questionType5' => $pdo->quote($form['questionType5']),
			':id' => $form['id']
		));
	}
	
	include "./view/form.php";

};
//delete data
if(isset($_REQUEST['formAction'])&&(addslashes($_REQUEST['formAction'])=='delForm')){
	//delete the picture
		$req = $pdo->prepare("SELECT formPicture FROM form WHERE id = :id");
	$req->bindParam(':id', $form['id'], PDO::PARAM_INT);
	if ($req->execute()) {
	  while ($row = $req->fetch()) {
	  	$toDelete =trim($row['formPicture'], '\'');
	  	if(file_exists($toDelete)){unlink($toDelete);};
	  }
	}
	//delete the record in the database
	$req = $pdo->prepare("DELETE FROM form WHERE id = :id");
	$req->bindParam(':id', $form['id'], PDO::PARAM_INT);
	$req->execute();
	include "./view/list.php";
};
function renderQuest($quest, $type, $form){
	 $render= "<div class='form-row'>";
     $render.= "<div class='col-10'>";
     $render.= "<input type='text' class='form-control'  id=\"{$quest}\" placeholder='Question à poser' name='{$quest}' value=\"".htmlspecialchars($form[$quest], ENT_QUOTES)."\" >";
     $render.= "</div>";
     $render.= "<div class='col-2'>";
     $render.= "<select class='custom-select' id='{$type}' name='{$type}'>";
     $render.= "<option value='Texte' ".($form[$type]==='Texte'?'selected':'').">Préponse Texte</option>";
     $render.= "<option value='OuiNon' ".($form[$type]==='OuiNon'?'selected':'').">Préponse Oui/non</option>";
     $render.= "<option value='Valeur' ".($form[$type]==='Valeur'?'selected':'').">Préponse Valeur</option>";
     $render.= "</select>";
     $render.= "</div>";
     $render.= "</div>";
     return $render;
}
function userQuest($quest, $type, $form){
	 $render = '';
	 $questContent = $form[$quest];
	 if($questContent != ''){
	    if($type == 'OuiNon'){
		    $render .= "<div class='checkbox'>";
    		$render .= "<label><input type='checkbox'> ".$questContent."</label>";
  			$render .= "</div>";

	 	}elseif ($type == 'Texte') {
		 	$render = "<div class='form-group'>";
		 	$render .= "<label for='formTitle'>{$questContent}</label>";
     		$render.= "<input type='text' class='form-control'  id=\"{$questContent}\" placeholder='Réponse' name='{$questContent}' value=\"\" >";
		 	$render.= "</div>";
	 	}else{
		 	$render = "<div class='form-group'>";
		 	$render .= "<label for='formTitle'>{$questContent}</label>";
     		$render.= "<input type='number' class='form-control'  id=\"{$questContent}\" placeholder='Nombre' name='{$questContent}' value=\"\" >";
		 	$render.= "</div>";
	 	}
	 }    
     return $render;
}
?>
