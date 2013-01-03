<?
if(!empty($notices)):?>
	<div id="notices">
	<?foreach($notices as $notice):?>
		<div class="notice <?=$notice['type']?>">
		<?=$notice['message']?>
		</div>
	<?endforeach;?>
	</div>
<?endif;?>