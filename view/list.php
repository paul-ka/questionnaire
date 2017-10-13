
<?php 
include "./controler/listForm.php";
/*echo '<pre>';
print_r($resul[0]);
echo '</pre>';*/
?>
<a href="./index.php?formAction=newForm">Créer un nouveau questionnaire</a> 
<table class='table'>
	<thead>
		<td>Questionnaire</td>
		<td>Action</td>
	</thead>
	<?php foreach ($resul as $value): ?>
		<tr>
			<td>
				<?php echo(trim($value["formTitle"],'\'')); ?>
			</td>
			<td>
				<a href="./index.php?formAction=renderForm&id=<?php echo($value["id"]); ?>" target="_blank">voir</a> 
				<a href="./index.php?formAction=readForm&id=<?php echo($value["id"]); ?>">Editer</a> 
				<a href="./index.php?formAction=delForm&id=<?php echo($value["id"]); ?>" 
					onclick="return confirm('Voulez-vous vraiment supprimer ce questionnaire ?')">Supprimer</a> 
			</td>
		</tr>
	 <?php endforeach; ?>
</table>
