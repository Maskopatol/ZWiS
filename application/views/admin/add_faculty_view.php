<html>
<body>
<h1><?=$heading?></h1>
<h3><?=$info?></h3>
<?=form_open('admin/add_faculty/');?>
Nazwa: <input type="text" size="35" name="name"><br>
Info: <input type="text" size="35" name="info"><br>
<input type="hidden" name="id_uni" value=<?=$id_uni;?>/>
<input type="submit" value="Dodaj">
</form>
<?=form_open('admin/');
echo form_submit('back', 'Anuluj');
form_close();?>
</body>
</html>