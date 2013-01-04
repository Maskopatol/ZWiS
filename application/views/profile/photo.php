
<?php echo $error;?>

<iframe id="upload_iframe" name="upload_iframe" style="width:0px;height:0px;visibility:hidden; border:none;"></iframe>

<table>
<tr><td style="width:400px;">

<form id ="upload_form" target="upload_iframe" action="<?=site_url('profile/do_upload')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
</td>
<td>
	<div id="controls"></div>
</td>
</tr>
</table>

<div id="results"></div>
<script>
var img;
var filename;
var selected;

function preview(img, selection) {
	var scaleX = 100 / (selection.width || 1);
	var scaleY = 100 / (selection.height || 1);

	$('#prev').css({
		width: Math.round(scaleX * img.width) + 'px',
		height: Math.round(scaleY * img.height) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
	});
}

function save(img,selection){
	selected = $.extend(selection,{
		photo: filename,
		photo_width: img.width ,
		photo_height:img.height,
		photo_natural_width: img.naturalWidth,
		photo_natural_height: img.naturalHeight
	});
}

$(function(){
	$("iframe#upload_iframe").load(function(){
		if($(this).contents().find("#message img").length != 0){
			var res =$('#results').empty();
			var cnt =$('#controls').empty();
			filename = $(this).contents().find("#filename")[0].innerHTML;
			img = $(this).contents().find("#message img");
			img.css("width","800px").appendTo(res).imgAreaSelect({ aspectRatio: '1:1', handles: true,onSelectChange: preview, onSelectEnd:save });
			$("<input type='button' value='Zapisz' />").appendTo(cnt).click(function(){
				$("<div></div>").appendTo($("body"))
					.css("position","absolute")
					.css("width","100%")
					.css("height","100%")
					.css("left","0px")
					.css("top","0px")
					.css("opacity","0")
					.css("background-color","black")
					.css("z-index","1000")
					.animate({
						opacity: '+=0.7'
					},1000);
				$.ajax({
					url: "<?=site_url("profile/rescale")?>",
					type: "POST",
					data: selected,
					success: function(data){
						setTimeout(function(){document.location= "<?=site_url("home/index")?>";},1000);
					}
				});
			});
			$('<div><img id="prev" src="'+img.attr("src")+'" style="position: relative;" /><div>')
			.css({
				float: 'left',
				position: 'relative',
				overflow: 'hidden',
				width: '100px',
				height: '100px'
			}).appendTo(cnt);
		//	$("<img id='prev' />").appendTo(cnt);
		}
	});

//	$("#upload_form").submit(function(){

	//	return false;
//	});
});
</script>
