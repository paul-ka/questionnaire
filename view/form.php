  <h2>Formulaire</h2>
  <a href="./index.php">Retour à la page d'accueil</a>

  <form action="?" method="POST" enctype="multipart/form-data">
    <p>
      <div class="form-group">
        <label for="formTitle">Nom du formulaire</label>
          <input type="text" class="form-control" id="formTitle" placeholder="Nom du formulaire" name="formTitle" value="<?php echo htmlspecialchars($form['formTitle'], ENT_QUOTES) ?>">
        </div>
        <div class="form-group">
         <label for="formPicture">Charger fichier image</label>
          <?php 
            if($form['formPicture']){
              echo "<br /><img src='{$form['formPicture']}'>";
              echo "<input type='hidden' name='formPicture' value='{$form['formPicture']}'>";
            } 
          ?>
          <input type="file" class="form-control" id="formPicture"  name="formPicture">
        </div>

        <div class="form-group">
          <label for="formContent">Descriptif de la situation</label>
          <div id="snow-container">
            <?php echo $form['formContent'] ?>
          </div>
        </div>

        <?php 
        echo(renderQuest('question1', 'questionType1', $form)); 
        echo(renderQuest('question2', 'questionType2', $form)); 
        echo(renderQuest('question3', 'questionType3', $form)); 
        echo(renderQuest('question4', 'questionType4', $form)); 
        echo(renderQuest('question5', 'questionType5', $form)); 
        ?>

        <input type="hidden" name="formAction" value="saveForm">
        <input type="hidden" name="formContent" id="formContent">
        <input type="hidden" name="id" value="<?php echo $form['id'] ?>">
    </p>

    <p>
      <button type="submit" class="btn btn-primary btn-block" 
      onclick="document.getElementById('formContent').value = document.getElementsByClassName('ql-editor')[0].innerHTML;">Valider</button>
    </p>

  </form>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->