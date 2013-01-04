<html>
<body>
<h1><?=$heading?></h1>
<div class='search'>
<?=form_open('user/search');?>
Szukaj znajomych<br>
<input type="text" size="25" name="item" value="Szukaj...">
<input type="submit" value="Szukaj" ?>
</form>		
</div>


	<?php foreach($friends as $fnd): ?>
	
		<div class='user'>
			<div class='photo'>
				<img src='<?=$fnd->photo?>' alt='' />
			</div>
			<div class='data'>
				<div class='fullname'>
					<?=$fnd->name?>
				</div>
				<div class='email'>
					<?=$fnd->email?>
				</div>
				<div class='options'>
					<?=anchor('user/info/'.$fnd->id_user,'Ściana');?>
				</div>
			</div>
		</div>
		<br>
	<?php endforeach; ?>
</body>
</html>