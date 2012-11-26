<div class="login">
<h2>Logowanie</h2>
	
<?=form_open('user/login');?>
<?=form_label("Email:","email");?><br />
<?=form_input(array('name'=>'email' , 'value' => $this->session->flashdata('email')));?><br />
<?=form_label("Hasło:","password");?><br />
<?=form_password(array('name'=>'password'));?><br /><br />
<?=form_submit('submit',"Zaloguj się");?><br />
<?=form_close();?>
<br />
<a href='#' >Login with Google</a>
</div>