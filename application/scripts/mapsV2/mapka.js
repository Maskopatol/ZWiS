

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

	this.users = this.loadUsers();
	this.static = false;

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
	if(this.static == true){
		this.sendStatic(x,y);
	}
}
Mapka.prototype.chooseStatic = function(){
	this.static = true;
	this.map.setOptions({draggableCursor:'crosshair'});
}
Mapka.prototype.sendStatic = function(x,y){
	var th = this;
	$.ajax({
		url: "http://localhost/index.php/locations/set_static/",
		type: "POST",
		data: {latitude : x , longitude: y },
		success: function(result){
			th.static = false;
			th.map.setOptions({draggableCursor:null});
			document.location = "http://localhost/index.php/locations/";
		}
	});
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
	if(k == 'buildings' || k == 'all'){
		$.each(this.buildings,function(i ,v){
			v.setVisible(val);
		});
	}
	if(k == 'lecturers'|| k == 'all'){
		$.each(this.users,function(i ,v){
			if(v.userdata.lecturer == 1)
				v.setVisible(val);
		});
	}
	if(k == 'students' || k == 'all'){
		$.each(this.users,function(i ,v){
			if(v.userdata.lecturer == 0)
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

Mapka.prototype.loadUsers = function(){
	var u = [];
	var th = this;
	$.getJSON("http://localhost/index.php/locations/loadUsers/",function(data){
		$.each(data , function(key, val){
			var nu = new User(th,val);
			u.push(nu);
		});
	});
	return u;
}





