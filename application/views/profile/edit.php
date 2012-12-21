<div id="edit">
	<h2>Edycja danych o użytkowniku:</h2>
	<?=$this->notices->get("profile-edit");?>
<?=form_open('profile/update');?>
Email:<br />
<?=$email;?><br />
<?=form_label("Hasło:","password");?><br />
<?=form_password(array('name'=>'password'));?><br />
<?=form_label("Powtórz hasło:","password_confirmation");?><br />
<?=form_password(array('name'=>'password_confirmation'));?><br />
<?=form_label("Imię:","name");?><br />
<?=form_input(array('name'=>'name','value'=>$name));?><br />
<?=form_label("Nazwisko:","surname");?><br />
<?=form_input(array('name'=>'surname','value'=>$surname));?><br />

<?=form_submit('submit',"Zapisz");?><br />
<?=form_close();?>
</div> 