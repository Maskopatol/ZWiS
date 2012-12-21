<html>
<body>
<h1><?=$heading?></h1>
<?php
print_r ($options);
print_r ($unis);
?>
<?form_open();
echo form_dropdown('uni',$options);
form_close();
?>

</body>
</html>