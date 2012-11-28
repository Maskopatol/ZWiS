<div class="login">
	<h2>Rejestracja</h2>
<?=form_open('register');?>
<?=form_label("Email:","email");?><br />
<?=form_input(array('name'=>'email' , 'value' => $this->session->flashdata('email')));?><br />
<?=form_label("Hasło:","password");?><br />
<?=form_password(array('name'=>'password'));?><br />
<?=form_label("Powtórz hasło:","password_confirmation");?><br />
<?=form_password(array('name'=>'password_confirmation'));?><br /><br />
<?=form_submit('submit',"Rejestruj");?><br />
<?=form_close();?>
</div>