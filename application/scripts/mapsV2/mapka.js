

function Mapka(options){
	this.settings = $.extend({
		x: 51.107779,
		y: 17.038493,
		mapDivId: "Mapka",
		buildingInfoWindowUrl: "http://localhost/index.php/locations/building/",
		userFrameUrl: "http://localhost/static/images/frame.png"
	},options);

	this.map = null;
	this.interface = new Interface(this);
	this.userPoint = new google.maps.LatLng(this.settings.x,this.settings.y);
	this.mapDiv = this.interface.canvas;
	this.mapOpts = {
		zoom: 14,
		center: this.userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		draggableCursor: null
	};
	this.map = new google.maps.Map(this.mapDiv, this.mapOpts);


	var u = new User(this,{
		name: "Mate",
		surname: "Russak",
		photo: "https://lh4.googleusercontent.com/-p5GNt-Uiq98/AAAAAAAAAAI/AAAAAAAABgw/lGcVPV5MO3A/photo.jpg",
		latitude: this.settings.x,
		longitude: this.settings.y,
	});




	this.buildings = this.loadBuildings();
	this.nowy = null;

	this.markers = [];
	this.countMarkers = 0;



	var th = this;
	google.maps.event.addDomListener(this.map, 'click', function(event){
		th.mapClickHandler(event);
	});
}

Mapka.prototype.mapClickHandler = function(event){
	var x = event.latLng.lat();
	var y = event.latLng.lng();
	if(this.nowy != null){
		this.nowy.pushPoint(x,y);
	}
}


Mapka.prototype.addMarker = function(x,y,t){
	this.markers[this.countMarkers] = new google.maps.Marker({
		position: new google.maps.LatLng(x,y),//this.userPoint,
															 map: this.map,
														  title: t
	});
	return this.markers[this.countMarkers++];
}

Mapka.prototype.newBuilding = function(){
	this.nowy = new Building(this);
	this.buildings.push(this.nowy);
	this.map.setOptions({draggableCursor:'crosshair'});
//	this.mapOpts.draggableCursor = "default";
//	this.map.getDragObject().setDraggableCursor("default");
}
Mapka.prototype.buildingFinished = function(){
	this.nowy = null;
	this.map.setOptions({draggableCursor:null});
//	this.map.getDragObject().setDraggableCursor("crosshair");
}

Mapka.prototype.setVisible = function(k,val){
	if(k == 'buildings'){
		$.each(this.buildings,function(i ,v){
			v.setVisible(val);
		});
	}
}

Mapka.prototype.loadBuildings = function(){
	var b = [];
	var th = this;
	$.getJSON("http://localhost/index.php/locations/loadBuildings/",function(data){
		$.each(data , function(key, val){
			var nb = new Building(th,val.id);
			$.each(val.points,function(k,v){
				//				alert(v.latitude +" "+v.longitude);
				nb.pushPoint(v.latitude,v.longitude);
			});
			b.push(nb);
		});
	});
	//	this.buildings = b;
	return b;
}







