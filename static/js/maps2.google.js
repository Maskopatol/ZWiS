

function Mapka( options){
	this.settings = $.extend( {
      x : '',
      y : 'blue'
    }, options);
	this.map = null;
	this.userPoint = new google.maps.LatLng(x,y);
	
		
	this.map = new google.maps.Map(document.getElementById('map_canvas'), {
		zoom: 14,
		center: this.userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	this.users = loadUsers("http://localhost/index.php/locations/get_json/", this.map);
	this.markers = [];
	this.countMarkers = 0;
	
	this.asd = "jakis tam tekst";
	
	this.buildier = new Builder(this.map);
	
//	var mark = this.addMarker(x,y,'Ty');
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

		controlText.innerHTML = '<b>Dodaj budynek</b>';
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


function loadUsers(url , map){
	var users = [];
	$.getJSON(url,function(data){
		$.each(data , function(key, val){
			users.push(new User(val['locations'][0],map,val['name'] ));
		});
	});
	return users;
}



function User(data,map,name){
	this.map = map;
	this.data = data;
	this.name = name;
	//alert(this.data.latitude+" "+this.data.longitude);
	this.infowindow = null;
	this.url = "http://localhost/index.php/locations/user_info/"+this.data.id_user;
	this.marker = new google.maps.Marker({
		position: new google.maps.LatLng(this.data.latitude,this.data.longitude),//this.userPoint,
		map: this.map,
		title: this.name
	});
	var th = this;
	google.maps.event.addListener(this.marker, 'click', function(){
		if(th.infowindow == null){
			$.ajax({
				url: th.url,
				success: function(d){
					th.infowindow = new google.maps.InfoWindow({content: d});
					th.infowindow.open(th.map,th.marker);
				}
			});
		}else{
			th.infowindow.open(th.map,th.marker);
		}
	});
}

function loadBuildings(build){
	var b = [];
	$.getJSON("http://localhost/index.php/locations/loadBuildings/",function(data){
		$.each(data , function(key, val){
			var nb = new Building(build,val.id);
			$.each(val.points,function(k,v){
//				alert(v.latitude +" "+v.longitude);
				nb.pushPoint(v.latitude,v.longitude);
			});
			b.push(nb);
		});
	});
	return b;
}

function Builder(map){
	this.map = map;
	this.count = 0;
	this.buildings = loadBuildings(this);
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



function Building(builder , id = null){
	this.builder = builder;
	this.builder.current = this;
	this.infowindow = null;
	this.id = id;
	this.map = this.builder.map;
	this.poly = new google.maps.Polygon({
		paths: [],
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.35
	});
	this.poly.setMap(this.map);
	
	this.paths = [];
	var th = this;

	google.maps.event.addListener(this.poly, 'click', function(){
		if(th.id == null && th.infowindow == null){
			$.ajax({
				url: "http://localhost/index.php/locations/building/"+((th.id!=null)?th.id:""),
				success: function(d){
					th.builder.current = null;
					th.infowindow = new google.maps.InfoWindow({content: d});
					th.infowindow.setPosition( new google.maps.LatLng(th.paths[0].x,th.paths[0].y));     
					
					th.infowindow.addListener("domready",function(){
						$(".building-form input[type='submit']").click(function(){
							var data = th.save();
							var name = $(".building-form input[name='name']").val();
							var desc = $(".building-form textarea[name='desc']").val();
							$.ajax({
								url: "http://localhost/index.php/locations/saveBuilding/",
								type: "POST",
								data: {data : data , name: name,desc: desc},
								success: function(d){
									th.id = d.id;
								}
							});
							
							th.infowindow.close();
							th.infowindow = null;
						});
					});
					th.infowindow.open(th.map);
					
				}
			});
		}else if(th.infowindow == null){
			$.ajax({
				url: "http://localhost/index.php/locations/building/"+((th.id!=null)?th.id:""),
				success: function(d){
					th.builder.current = null;
					th.infowindow = new google.maps.InfoWindow({content: d});
					th.infowindow.setPosition( new google.maps.LatLng(th.paths[0].x,th.paths[0].y));   
					th.infowindow.open(th.map);
				}
			});
			
		}else{
			th.infowindow.open(th.map);
		}
	});
	
//	google.maps.event.addDomListener(this.poly, 'rightclick', function(){
//		th.builder.current = th;
//	});
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
//		alert("a1");
	}else{
		pat = [pnt];
		this.poly.setPath(pat);
//		alert("a2");
	}
}
Building.prototype.save = function(saveURL){
	var dataStr = "";
	var path = this.paths;
	$.each(path , function(key,val){
		dataStr += val.toString()+"|";
	});
	return dataStr;
}


function Point(x,y){
	this.x = x;
	this.y = y;
}

Point.prototype.toString = function(){
	return this.x+","+this.y;
}


