<html>
<body>
<h1><?=$heading?></h1>

	<?php foreach($messages as $msg): ?>
	
			<div><h3><?=anchor('user/info/'.$msg->sender_id, $msg->name); ?></h3>
			<?php echo $msg->message_date; ?>
			<p><?php echo $msg->message_content; ?></p>
			</div>
	<?php endforeach; ?>
		

</body>
</html>