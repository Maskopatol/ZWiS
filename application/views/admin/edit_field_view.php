<html>
<body>
<h1><?=$heading?></h1>
<h3><?=$info?></h3>
<?=form_open('admin/edit_field/'.$field_inf['id']);?>
Nazwa: <input type="text" size="35" name="name" value=<?= $field_inf['name'];?>><br>
Info: <input type="text" size="35" name="info" value=<?= $field_inf['info'];?>><br>
<input type="hidden" name="id_fac" value=<?=$field_inf['id_fac'];?>/>
<input type="submit" value="Edytuj" name="submit_action">
<input type="submit" value="Anuluj" name="submit_action">
</form>
</body>
</html>