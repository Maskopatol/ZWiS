<html>
<body>
<h1><?=$heading?></h1>
<?=form_open('admin/uni/'.$id);
echo form_dropdown('uni',$options);?>
<br><br>
<input type="submit" value="Wybierz" name="submit_action">
<input type="submit" value="Anuluj" name="submit_action">
</form>
</body>
</html>