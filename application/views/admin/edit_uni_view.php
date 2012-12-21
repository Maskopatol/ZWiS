<html>
<body>
<h1><?=$heading?></h1>
<?=form_open('admin/edit_uni/'.$uni_inf['id']);?>
Nazwa: <input type="text" size="35" name="name" value=<?= $uni_inf['name'];?>><br>
Adres: <input type="text" size="35" name="address" value=<?= $uni_inf['address'];?>><br>
Rok założenia: <input type="text" size="4" name="established" value=<?= $uni_inf['established'];?>><br>
Liczba studentów: <input type="text" size="8" name="students" value=<?= $uni_inf['students'];?>><br>
Strona WWW: <input type="text" size="35" name="home_page" value=<?= $uni_inf['home_page'];?>><br>
Czy publiczna(0/1): <input type="text" size="1" name="is_public" value=<?= $uni_inf['is_public'];?>><br>
<input type="submit" value="Edytuj">
</form>
<?=form_open('admin/');
echo form_submit('back', 'Anuluj');
form_close();?>
</body>
</html>