<img src="./asset/img/logo.png">
<h1><?php echo $form['formTitle'] ?></h1>
<?php 
  if($form['formPicture']){
    echo "<br /><img src='{$form['formPicture']}'>";
  } 
?>

<div><?php echo $form['formContent'] ?></div>

<form action="recordAnswer.php" method="POST" >
        <?php 
        echo(userQuest('question1', $form['questionType1'], $form)); 
        echo(userQuest('question2', $form['questionType2'], $form)); 
        echo(userQuest('question3', $form['questionType3'], $form)); 
        echo(userQuest('question4', $form['questionType4'], $form)); 
        echo(userQuest('question5', $form['questionType5'], $form)); 
        ?>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
