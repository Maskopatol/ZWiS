<div class="login">
<h2>Logowanie</h2>
<?=$this->notices->get('login');?>
<br />
<?=form_open('login');?>
<?=form_label("Email:","email");?><br />
<?=form_input(array('name'=>'email' , 'value' => $this->session->flashdata('email')));?><br />
<?=form_label("Hasło:","password");?><br />
<?=form_password(array('name'=>'password'));?><br /><br />
<?=form_submit('submit',"Zaloguj się");?><br />
<?=form_close();?>
<br />
<?=anchor("register","Zarejestruj się");?>
<br />
<div class="google">
<?=anchor($this->auth->google_login_link(),"Google");?>
</div>
</div>