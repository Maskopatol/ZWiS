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
	<div id='footer'><?=($this->auth->is_admin() && ($this->layout->layoutname != "admin"))?anchor(site_url("admin"),"Panel administratora"):"";?></div>
</div>
</body>
</html>
