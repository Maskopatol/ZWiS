<html>
<body>
<h1><?=$heading?></h1>
<div class='uni'>
	<div class='data'>
	<table cellpadding="2" border="1">
		<tr align="center" valign="middle">
		<td>Nazwa uczelni</td>
		<td>Adres</td>
		<td>Założona</td> 
		<td>Liczba studentów</td> 
		<td>Strona domowa</td> 
		<td>Czy publiczna</td>
		</tr>
		<?php foreach($uni_list as $uni): ?>
	
			<tr align="center" valign="middle">
			<td><?=$uni->name?></td>
			<td><?=$uni->address?></td>
			<td><?=$uni->established?></td>
			<td><?=$uni->students?></td>
			<td><a href=<?=$uni->home_page?> target="_blank"><img src="../home_icon.png" border="0" /></a></td>
			<td><?=$uni->is_public ? tak : nie ?></td>
			<td><?=anchor('uni/faculty/'.$uni->id,'Wydziały');?></td>
			</tr>
			
		<?endforeach; ?>
		
		</table> 
	</div>
</div>
</body>
</html>
