<html>
<body>
<h1><?=$heading?></h1>
<div class='search'>
<?=form_open('user/search');?>
<input type="text" size="25" name="item" value="Szukaj...">
<input type="submit" value="Szukaj" ?>
</form>	
</div>
	<?php foreach($friends as $user): ?>
	
		<div class='user'>
			<div class='photo'>
				<img src='<?=$user['photo']?>' alt='' />
			</div>
			<div class='data'>
			<div class='fullname'>
				<?=$user['name']?> <?=$user['surname']?>
			</div>
			<br><br>
			<div class='options'>
				<?=anchor('user/info/'.$user['id_user'],'Więcej');?>
			</div>
	</div>
</div>
		<br>
	<?php endforeach; ?>

</body>
</html>