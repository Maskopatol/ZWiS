

function Mapka( x,y){

	this.map = null;
	this.userPoint = new google.maps.LatLng(x,y);


	this.map = new google.maps.Map(document.getElementById('map_canvas'), {
		zoom: 14,
		center: this.userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		draggableCursor: "default"
	});

	Mcore.map = this.map;
	this.users = loadUsers("http://localhost/index.php/locations/get_json/" );
	this.markers = [];
	this.countMarkers = 0;

	this.asd = "jakis tam tekst";

	this.buildier = new Builder(this.map);

	//	var mark = this.addMarker(x,y,'Ty');
	//google.maps.MapsEventListener.addListener(mark,"click",function(){alert('dupa!');});

	//var homeControlDiv = document.createElement('div');
//	this.createMarkerPanel(homeControlDiv, this.map);

	homeControlDiv.index = 1;
	this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

	var th = this;
	google.maps.event.addDomListener(this.map, 'click', function(event){
		th.mapClickHandler(event);
	});
}

Mapka.prototype.mapClickHandler = function(event){
	var x = event.latLng.lat();
	var y = event.latLng.lng();

	this.buildier.addPoint(x,y);
}


Mapka.prototype.addMarker = function(x,y,t){
	this.markers[this.countMarkers] = new google.maps.Marker({
		position: new google.maps.LatLng(x,y),//this.userPoint,
															 map: this.map,
														  title: t
	});
	return this.markers[this.countMarkers++];
}

Mapka.prototype.createMarkerPanel = function(controlDiv, map){
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.cursor = 'pointer';
	controlUI.title = 'Kliknij aby dodać nowe miejsce';
	controlDiv.appendChild(controlUI);

	var controlText = document.createElement('div');
	controlText.className = "gbutton";

	controlText.innerHTML = '<b>Dodaj budynek</b>';
	controlUI.appendChild(controlText);
	var th = this;
	google.maps.event.addDomListener(controlUI, 'click', function(){
		th.buildier.newBuilding();
	});
}
/*
 * Mapka.prototype.newPoly = function(){
 *
 *	this.polys[this.countPolys] = new google.maps.Polygon({
 *          paths: [],
 *          strokeColor: '#FF0000',
 *          strokeOpacity: 0.8,
 *          strokeWeight: 2,
 *          fillColor: '#FF0000',
 *          fillOpacity: 0.35
 });
 this.polys[this.countPolys].setMap(this.map);
 this.currentPoly = this.polys[this.countPolys];
 this.countPolys++;
 }*/
