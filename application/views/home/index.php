
<div class='user'>
	<div class='photo'>
		<img src='<?=$user['photo']?>' alt='' />
	</div>
	<div class='data'>
		<div class='fullname'>
			<?=$user['name']?> <?=$user['surname']?>
		</div>
		<div class='email'>
			<?=$user['email']?>
		</div>
		<div class='options'>
			<?=anchor('profile/edit','Edytuj dane');?>
		</div>
	</div>
</div>