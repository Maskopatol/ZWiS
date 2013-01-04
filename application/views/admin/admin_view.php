<html>
<body>
<h1><?=$heading?></h1>
<div class='typ'>
<fieldset><legend>Uczelnie</legend>

<?=anchor('admin/uni/1', 'Dodaj'); ?>
<?=anchor('admin/choose_uni/2', 'Edytuj'); ?>
</fieldset>
</div>
<div class='typ'>
<fieldset><legend>Wydziały</legend>

<?=anchor('admin/choose_uni/3', 'Dodaj'); ?>
<?=anchor('admin/choose_uni/4', 'Edytuj'); ?>
</fieldset>
</div>
<div class='typ'>
<fieldset><legend>Kierunki</legend>

<?=anchor('admin/choose_uni/5', 'Dodaj'); ?>
<?=anchor('admin/choose_uni/6', 'Edytuj'); ?>		
</fieldset>
</div>
</body>
</html>