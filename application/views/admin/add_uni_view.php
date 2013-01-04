<html>
<body>
<h1><?=$heading?></h1>
<h3><?=$info?></h3>
<?=form_open('admin/add_uni/');?>
Nazwa: <input type="text" size="35" name="name"><br>
Adres: <input type="text" size="35" name="address"><br>
Rok założenia: <input type="text" size="4" name="established"><br>
Liczba studentów: <input type="text" size="8" name="students"><br>
Strona WWW: <input type="text" size="35" name="home_page"><br>
Czy publiczna(0/1): <input type="text" size="1" name="is_public"><br>
<input type="submit" value="Dodaj" name="submit_action">
<input type="submit" value="Anuluj" name="submit_action">
</form>
</body>
</html>