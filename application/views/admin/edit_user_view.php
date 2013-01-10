<html>
<body>
<h1><?=$heading?></h1>
<?=form_open('admin/edit_user/'.$user['id_user']);?>
Imię: <input type="text" size="35" name="name" value=<?= $user['name'];?>><br>
Nazwisko: <input type="text" size="35" name="surname" value=<?= $user['surname'];?>><br>
Email: <input type="text" size="35" name="email" value=<?= $user['email'];?>><br>
Wykładowca: <input type="text" size="1" name="lecturer" value=<?= $user['lecturer'];?>><br>
Admin: <input type="text" size="1" name="admin" value=<?= $user['admin'];?>><br>
<input type="submit" value="Edytuj" name="submit_action">
<input type="submit" value="Anuluj" name="submit_action">
</form>
</body>
</html>