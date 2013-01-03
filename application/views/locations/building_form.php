<div class="building-form">
<label for="name">Nazwa:</label><br />
<input type="text" name="name" /><br />
<label for="name">Uczelnia:</label><br />
<?=form_dropdown('uni',$options);?><br />
<label for="desc">Opis:</label><br />
<textarea name="desc"> </textarea><br />
<input type="submit" value="Zapisz">
</div>