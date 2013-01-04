<div id="edit">
	<h2>Edycja danych o użytkowniku:</h2>

	<div class='photo'>
	<img src='<?=$photo?>' alt='' />
	<input type="button" onclick="document.location='<?=site_url("profile/photo")?>'" value="zmień zdjęcie" />
	</div>


	<?=$this->notices->get("profile-edit");?>
<?=form_open('profile/update');?>
<table class="profile_edit">
<tr><td class="profile_desc"></td><td class="profile_mod"></td></tr>
<tr><td class="profile_desc">Email:
</td><td class="profile_mod"><?=$email;?></td></tr>
<tr><td class="profile_desc"><?=form_label("Hasło:","password");?>
</td><td class="profile_mod"><?=form_password(array('name'=>'password'));?></td></tr>
<tr><td class="profile_desc"><?=form_label("Powtórz hasło:","password_confirmation");?>
</td><td class="profile_mod"><?=form_password(array('name'=>'password_confirmation'));?></td></tr>
<tr><td class="profile_desc"><?=form_label("Imię:","name");?>
</td><td class="profile_mod"><?=form_input(array('name'=>'name','value'=>$name));?></td></tr>
<tr><td class="profile_desc"><?=form_label("Nazwisko:","surname");?>
</td><td class="profile_mod"><?=form_input(array('name'=>'surname','value'=>$surname));?></td></tr>
<tr><td class="profile_desc">
</td><td class="profile_mod"><?=form_submit('submit',"Zapisz");?></td></tr>
</table>
<?=form_close();?>
</div>
