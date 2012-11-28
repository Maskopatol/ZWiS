<html>
<head>
<title><?=(!empty($pagetitle))?$pagetitle:"";?><?=(!empty($subpagetitle))?" - ".$subpagetitle:"";?></title>
<META CHARSET="utf-8">
<base href="<?=base_url().index_page()."/";?>" target="_self">
<?=$style_src;?>
<?=$scripts;?>
</head>
<body>
<div id="all">
	<?=$body;?>
	<div id='footer'></div>
</div>
</body>
</html>
