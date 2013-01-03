<div id="Mapka"></div>
<script>

var m=null;
$(function(){

	m = new Mapka({
		x : <?=(!empty($user['location']['latitude'])?$user['location']['latitude']:51.107779)?>,
		y : <?=(!empty($user['location']['longitude'])?$user['location']['longitude']:17.038493)?>
	});
});


//google.maps.event.addDomListener(window, 'load', init);

//alert(m.countMarkers);

//google.maps.event.addDomListener(window, 'load', initialize);

//loadUsers("<?=base_url();?>index.php/locations/get_json/");
</script>

