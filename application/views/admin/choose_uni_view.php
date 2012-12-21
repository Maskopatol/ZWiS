<html>
<body>
<h1><?=$heading?></h1>
Wybierz z listy rozwijnej:<br>
<?=form_open('admin/uni/'.$id);
echo form_dropdown('uni',$options);?>
<br>
<input type="submit" value="Wybierz">
</form>
<?=form_open('admin/');
echo form_submit('back', 'Anuluj');
form_close();?>
</body>
</html>