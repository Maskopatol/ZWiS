<html>
<body>
<h1><?=$heading?></h1>

<?=form_open('User/add_post');?>

<textarea rows="5" cols="20" name="post_content">
Napisz posta
</textarea>
<input type="submit" value="Dodaj post" ?>
<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
</form>
	<?php foreach($posts as $pst): ?>
	

			<div><h3><?=anchor('User/info/'.$pst->id_user, $pst->name); ?></h3>
			<?php echo $pst->post_date; ?>
			<p><?php echo $pst->post_content; ?></p>
			<ul>
				<?php foreach($pst->comments as $comment): ?>
					<li><p><?=anchor('User/info/'.$comment->id_user, $comment->name); ?></p>
					<p><?php echo $comment->comment_content; ?></p>
					<p><?php echo $comment->comment_date; ?></p></li>
				<?php endforeach; ?>
			<?=form_open('User/add_comment');?>

			<textarea rows="2" cols="20" name="comment_content">Komentarz</textarea>
			<input type="submit" value="Dodaj komentarz" >
			<input name="post_id" type="hidden" value="<?= $pst->post_id ?>" />
			<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
			</form>
			</ul>
			<hr>
			</div>
	<?php endforeach; ?>
		

</body>
</html>