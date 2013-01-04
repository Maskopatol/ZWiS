<html>
<body>
<h1><?=$heading?></h1>
<h3><?=$info?></h3>
<?=form_open('admin/add_field/');?>
Nazwa: <input type="text" size="35" name="name"><br>
Info: <input type="text" size="35" name="info"><br>
<input type="hidden" name="id_fac" value=<?=$id_fac;?>/>
<input type="submit" value="Dodaj" name="submit_action">
<input type="submit" value="Anuluj" name="submit_action">
</form>
</body>
</html>