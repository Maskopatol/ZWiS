

function Mapka( x , y){
	this.map = null;
	this.userPoint = new google.maps.LatLng(x,y);
	
		
	this.map = new google.maps.Map(document.getElementById('map_canvas'), {
		zoom: 15,
		center: this.userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	
	this.markers = [];
	this.countMarkers = 0;
	
	this.asd = "jakis tam tekst";
	
	this.buildier = new Builder(this.map);
	
	var mark = this.addMarker(x,y,'Ty');
	//google.maps.MapsEventListener.addListener(mark,"click",function(){alert('dupa!');});
	
	  var homeControlDiv = document.createElement('div');
		this.createMarkerPanel(homeControlDiv, this.map);

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

		controlText.innerHTML = '<b>Dodaj</b>';
        controlUI.appendChild(controlText);
		var th = this;
        google.maps.event.addDomListener(controlUI, 'click', function(){
			th.buildier.newBuilding();
		});
}
/*
Mapka.prototype.newPoly = function(){	
	
	this.polys[this.countPolys] = new google.maps.Polygon({
          paths: [],
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
     });
	this.polys[this.countPolys].setMap(this.map);
	this.currentPoly = this.polys[this.countPolys];
	this.countPolys++;
}*/


function loadUsers(url){
	var users = [];
	$.getJSON(url,function(data){
		$.each(data , function(key, val){
			users.push(new User(val[0]));
		});
	});
	return users;
}



function User(data,map){
	this.map = map;
	this.data = data;
	this.infowindow = null;
	this.url = "http://jakis";
	this.marker = new google.maps.Marker({
		position: new google.maps.LatLng(this.data.latitude,this.data.longitude),//this.userPoint,
		map: this.map,
		title: data.""
	});
	var th = this;
	google.maps.event.addListener(this.marker, 'click', function(){
		if(th.infowindow == null){
			$.ajax({
				url: th.url,
				success: function(d){
					th.infowindow = new google.maps.InfoWindow({content: d});
					infowindow.open(th.map,th.marker);
				}
			});
		}else{
			infowindow.open(th.map,th.marker);
		}
	});
}


function Builder(map){
	this.map = map;
	this.count = 0;
	this.buildings = [];
	this.current = null;
}

Builder.prototype.newBuilding = function(){
	this.buildings[this.count++] = new Building(this);
//	alert("nowy budynek");
}

Builder.prototype.addPoint = function(x,y){
	if(this.current != null){
		this.current.pushPoint(x,y);
	//	alert("nowy punkt");
	}
}



function Building(builder){
	this.builder = builder;
	this.builder.current = this;
	
	this.poly = new google.maps.Polygon({
		paths: [],
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.35
	});
	this.poly.setMap(this.builder.map);
	
	this.paths = [];
	var th = this;
	google.maps.event.addDomListener(this.poly, 'click', function(){
		th.builder.current = th;
	});
	google.maps.event.addDomListener(this.poly, 'rightclick', function(){
		th.builder.current = th;
	});
}
Building.prototype.pushPoint = function(x,y){
	var p = new Point(x,y);
	if(this.paths != null){
		this.paths.push(p);
	}else{
		this.paths = [p];
	}
	var pat = this.poly.getPath();
	var pnt = new google.maps.LatLng(x,y);
	if(pat != null){
		pat.push(pnt);
		alert("a1");
	}else{
		pat = [pnt];
		this.poly.setPath(pat);
		alert("a2");
	}
}
Building.prototype.save = function(saveURL){
	var dataStr = "";
	var path = this.paths;
	$.each(path , function(key,val){
		dataStr += val.toString()+"|";
	});
	$.ajax({
		url: saveURL,
		type: "POST",
		data: {data : dataStr},
	});
}


function Point(x,y){
	this.x = x;
	this.y = y;
}

Point.prototype.toString = function(){
	return this.x+","+this.y;
}


