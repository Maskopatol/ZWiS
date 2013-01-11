<h1><?=$heading?></h1>
<div class='field'>
	<div class='data'>
	<table>
		<thead>
			<tr align="center" valign="middle">
			<td>Nazwa Kierunku</td>
			<td>Opis</td>
			<td></td>
			</tr>
		</thead>
		
		<?php foreach($field_list as $field): ?>
			<tbody>
				<tr align="center" valign="middle">
				<td><?=$field->name?></td>
				<td><?=$field->info?></td>
				<td><?=anchor('uni/field/'.$faculty->id,'Tu studiuję!');?></td>
				</tr>
			</tbody>
		<?endforeach; ?>
		<tfoot>
			<tr align="right">
			<td colspan="3"><a href="javascript:history.back()">Powrót do wydziałów</a></td>
			</tr>
		</tfoot>
		</table> 
	</div>
</div>