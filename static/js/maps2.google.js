

function Mapka( x , y){
	this.map = null;
	this.userPoint = new google.maps.LatLng(x,y);
	
	var mapOptions = {
			zoom: 15,
			center: this.userPoint,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
	this.map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	
	this.markers = [];
	this.countMarkers = 0;
	
	this.asd = "jakis tam tekst";
	
	this.polys = [];
	this.countPolys= 0;
	
	this.currentPoly = null;
	
	var mark = this.addMarker(x,y,'Ty');
	//google.maps.MapsEventListener.addListener(mark,"click",function(){alert('dupa!');});
	
	  var homeControlDiv = document.createElement('div');
		this.createMarkerPanel(homeControlDiv, this.map);

        homeControlDiv.index = 1;
        this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

		
	google.maps.event.addDomListener(this.map, 'click', function(event){
		var x = event.latLng.lat();
		var y = event.latLng.lng();
		
		alert(this.asd);
		
		if(this.currentPoly != null){
			var path = this.currentPoly.getPath()
			if(path == null){
				path = [new google.maps.LatLng(x,y)];
				this.currentPoly.setPath(path);
			}else{
				path.push(new google.maps.LatLng(x,y))
			}
		}else{
			this.addMarker(x, y,'click');
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

        google.maps.event.addDomListener(controlUI, 'click', this.newPoly);
}
Mapka.prototype.newPoly = function(){
	this.polys[this.countPolys] = new Poly();
	this.currentPoly = this.polys[this.countPolys].getPolygon();
	this.countPolys++;
}

function Poly(){
	this.p;
	var opts = {
          paths: [],
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
     };
	
	this.p = new google.maps.Polygon(opts);
	this.p.setMap(this.map);
	
}
Poly.prototype.getPolygon = function(){
	return this.p;
}