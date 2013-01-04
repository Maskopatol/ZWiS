<html>
<body>
<div class='user'>
			<div class='photo'>
				<img src='<?=$user['photo']?>' alt='' />
			</div>
			<div class='data'>
				<div class='fullname'>
					<?=$user['name']?> <?=$user['surname']?>
				</div>
				<div class='email'>
					<?=$user['email']?>
				</div>
			</div>
		</div>
		<br>
<div class='priv'>
<?=form_open('user/add_message');?>

<textarea rows="5" cols="40" name="message_content">
Napisz wiadomość prywatną
</textarea><br>
<input type="submit" value="Wyślij wiadomość" />
<input name="id_user" type="hidden" value="<?= $id_user ?>" />
<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
</form>
</div>
<?=form_open('user/add_post');?>
<div class='addpost'>
<textarea rows="5" cols="40" name="post_content">
Napisz posta
</textarea><br>
<input type="submit" value="Dodaj post" ?>
<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
</form>
</div><br>
	<?php foreach($posts as $pst): ?>
	

			<div class ='post'><h3><?=anchor('user/info/'.$pst->id_user, $pst->name); ?></h3>
			<?php echo $pst->post_date; ?>
			<p><?php echo $pst->post_content; ?></p>
			<div class ='comments'>
				<?php foreach($pst->comments as $comment): ?>
					<div class ='comment'>
					<p><?=anchor('user/info/'.$comment->id_user, $comment->name); ?></p>
					<p><?php echo $comment->comment_content; ?></p>
					<p><?php echo $comment->comment_date; ?></p>
					</div>
				<?php endforeach; ?>
			<?=form_open('user/add_comment');?>

			<textarea rows="3" cols="40" name="comment_content">Komentarz</textarea>
			<input type="submit" value="Dodaj komentarz" >
			<input name="post_id" type="hidden" value="<?= $pst->post_id ?>" />
			<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
			</form>
			</div>
			</div>
	<?php endforeach; ?>
		

</body>
</html>