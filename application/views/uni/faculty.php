<html>
<body>
<h1><?=$heading?></h1>
<div class='faculty'>
	<div class='data'>
	<table cellpadding="2" border="1">
		<tr align="center" valign="middle">
		<td>Nazwa wydzia³u</td>
		<td>Opis</td>
		</tr>
		<?php foreach($faculty_list as $faculty): ?>
	
			<tr align="center" valign="middle">
			<td><?=$faculty->name?></td>
			<td><?=$faculty->info?></td>
			<td><?=anchor('uni/field/'.$faculty->id,'Kierunki');?></td>
			</tr>
			
		<?endforeach; ?>
		
		</table> 
	</div>
</div>
</body>
</html>
