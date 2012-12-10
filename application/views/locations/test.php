
<?//print_r($user);?>
<style>
#ctrl{width:150px;}
</style>
<script>
$(function(){
	var mapa;
	var poly = [];
	var i = 0;
	$('#map_canvas').gmap().bind('init', function(event,map) { 
		mapa = map;
		$(map).click( function(event) {
			if(i > 0){
				var path = $('#map_canvas').gmap('get','overlays > Polygon')[i-1].getPath();
				if(path == null){
					var p = [event.latLng];
					$('#map_canvas').gmap('get','overlays > Polygon')[i-1].setPath(p);
					
				}else{
					path.push(event.latLng);
				}
			}
		});
		
	//	$('#map_canvas').gmap('addShape', 'Circle', { 'strokeColor': "#FF0000", 'strokeOpacity': 0.8, 'strokeWeight': 2, 'fillColor': "#FF0000", 'fillOpacity': 0.35, 'center': new google.maps.LatLng(58.12, 12.01), 'radius': 2000 });
		
		$('#map_canvas').gmap('addControl', 'ctrl', google.maps.ControlPosition.BOTTOM_RIGHT);
		$('#ctrl').append('<button id="btn">add</button>');
		
		$('#ctrl').append('dasddasdawdwaddw');
		
		
		$.getJSON( 'http://localhost/index.php/locations/get_json/', function(data) { 
			var userPos = new google.maps.LatLng(data.user.location.latitude,data.user.location.longitude);
			$('#map_canvas').gmap('addMarker', { 
				'position': userPos,
				'bounds': true
			}).click(function(){
				$('#map_canvas').gmap('openInfoWindow', {'content': data.user.name+' '+data.user.surname}, this);
			});

			
		});	
	});
	
	$("#btn").click(function(){
		
		poly[i++] = $('#map_canvas').gmap('addShape', 'Polygon',{
			paths: [],
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		});
		
/*		poly[i] = new google.maps.Polygon({
          
		});
		
	*/
		//poly[i++].setMap(mapa);
	});
	
	$("#btn-del").click(function(){
		$('#map_canvas').gmap('get','overlays > Polygon')[i-1].getPath();
	});

});

</script>

<button id="btn">add</button>
<button id="btn-del">delete</button>
<button id="btn-save">save</button>

<div id="map_canvas"></div>