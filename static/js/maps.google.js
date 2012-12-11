var map;
var user;
var poly = [];
var polyl = [];
var i = 0;
var x;
var y;
var base_url = "http://localhost/index.php/locations/"

function initialize() {

	userPoint = new google.maps.LatLng(x,y);
	var mapOptions = {
		zoom: 15,
		center: userPoint,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	
//	var m = addMarker(x,y,"Ty");
//	addInfoWindow(m , "http://localhost/index.php");
//	userPoint = m.getPosition();
	
	createPanel();

	google.maps.event.addListener(map, 'click', addLatLng);
	
	var coords = [new google.maps.LatLng(x,y)];
}

function loadUsers(url){
	$.getJSON(url,function(data){
		$.each(data , function(key, val){
			var m = addMarker(val[0].latitude,val[0].longitude,val[0].id_user);
			addInfoWindow(m , base_url+"get/"+val[0].id_user);
		});
	});
}

function addMarker(x,y,t){
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(x,y),
		map: map,
		title: t
	});
	return marker;
}

function addInfoWindow(m , url){
	google.maps.event.addListener(m, 'click', function(){
		$.ajax({
			url: url,
			success: function(data){
				var infowindow = new google.maps.InfoWindow({content: data});
				infowindow.open(map,m);
			}
		});
	});
}

function createPanel(){
	var controlDiv = document.createElement('div');
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.cursor = 'pointer';
	controlUI.title = 'Kliknij aby dodać nowe miejsce';
	controlDiv.appendChild(controlUI);

	var controlText = document.createElement('div');
	controlText.className = "gbutton";

	controlText.innerHTML = '<b>Dodaj</b>';
	controlUI.appendChild(controlText);

	google.maps.event.addDomListener(controlUI, 'click', newPoly);
	controlDiv.index = 1;
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
}

function addLatLng(event) {
	if(i == 0){
		newPoly();
	}
	var path = poly[i].getPath();
	if(path == null){
		var p = [event.latLng];
		poly[i].setPath(p);
		polyl[i].pushPoint(event.latLng.lat() ,event.latLng.lng());
	}else{
		polyl[i].pushPoint(event.latLng.lat() ,event.latLng.lng());
		path.push(event.latLng);
		if(path.length == 4){
			polyl[i].save();
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
	polyl[i] = new Building(base_url+"saveBuilding/");
	
	google.maps.event.addDomListener(poly[i], 'click', function(){
		alert(asd);
	});

}


function Building(saveURL){
	this.saveURL = saveURL;
	this.paths = [];
}
Building.prototype.pushPoint = function(x,y){
	var p = new Point(x,y);
	if(this.paths != null){
		this.paths.push(p);
	//	alert(this.paths.length);
	}else{
		this.paths = [p];
	}
}
Building.prototype.save = function(){
	var dataStr = "";
	var path = this.paths;
	$.each(path , function(key,val){
		dataStr += val.toString()+"|";
	});
	$.ajax({
		url: this.saveURL,
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
