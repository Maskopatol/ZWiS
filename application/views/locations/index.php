
<?//print_r($user);?>
<script>
var map;
var user;
function initialize() {
	userPoint = new google.maps.LatLng(<?=$lat['latitude']?>,<?=$lat['longitude']?>);
	var mapOptions = {
		zoom: 15,
		center: userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

	var beachMarker = new google.maps.Marker({
		position: userPoint,
		map: map,
		icon: {
			path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW, //"<?=$user['photo']?>",
			scale: 2
		}
	});

}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="map_canvas"></div>