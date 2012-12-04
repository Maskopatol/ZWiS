var map;
var user;
var poly = [];
var i = 0;
var x;
var y;
function initialize() {

	userPoint = new google.maps.LatLng(x,y);
	var mapOptions = {
		zoom: 15,
		center: userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	
	var marker = new google.maps.Marker({
		position: userPoint,
		map: map,
		title: 'title'
	});
	google.maps.event.addListener(map, 'click', addLatLng);
	
	  var coords = [
            new google.maps.LatLng(x,y)
        ];
	

}

function addLatLng(event) {
	if(i == 0){
		newPoly();
	}
	var path = poly[i].getPath();
	if(path == null){
		var p = [event.latLng];
		poly[i].setPath(p);
		
	}else{
		path.push(event.latLng);
		if(path.length == 4){
			newPoly();
		}
	}
}

function newPoly(){
	i++;
	poly[i] = new google.maps.Polygon({
          paths: [],
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
     });
	
	poly[i].setMap(map);
}