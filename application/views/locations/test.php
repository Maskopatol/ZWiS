
<div id="map_canvas"></div>
<script>


$(function(){
	x = <?=$user['location']['latitude']?>;
	y = <?=$user['location']['longitude']?>;
	var m = new Mapka(x,y);
});


//google.maps.event.addDomListener(window, 'load', init);

//alert(m.countMarkers);

//google.maps.event.addDomListener(window, 'load', initialize);

//loadUsers("<?=base_url();?>index.php/locations/get_json/");
</script>

