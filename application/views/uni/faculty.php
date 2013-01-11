<h1><?=$heading?></h1>
<div class='faculty'>
	<div class='data'>
	<table>
		<thead>
			<tr align="center" valign="middle">
			<td>Nazwa wydziału</td>
			<td>Opis</td>
			<td></td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($faculty_list as $faculty): ?>
	
			<tr align="center" valign="middle">
			<td><?=$faculty->name?></td>
			<td><?=$faculty->info?></td>
			<td><?=anchor('uni/field/'.$faculty->id,'Kierunki');?></td>
			</tr>
			
		<?endforeach; ?>
		</tbody>
		<tfoot>
			<tr align="right">
			<td colspan="3"><a href="javascript:history.back()">Powrót do uczelni</a></td>
			</tr>
		</tfoot>
		</table> 
	</div>
</div>