<html>
<body>
<h1><?=$heading?></h1>
<div class='field'>
	<div class='data'>
	<table cellpadding="2" border="1">
		<tr align="center" valign="middle">
		<td>Nazwa wydziału</td>
		<td>Opis</td>
		</tr>
		<?php foreach($field_list as $field): ?>
	
			<tr align="center" valign="middle">
			<td><?=$field->name?></td>
			<td><?=$field->info?></td>
			<td><?=anchor('uni/field/'.$faculty->id,'Tu studiuję!');?></td> 
			</tr>
			
		<?endforeach; ?>
		
		</table> 
	</div>
</div>
</body>
</html>
