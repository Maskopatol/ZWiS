/*
 * TODO:
 * -zmienić kolory budynków!
 * -link do zapisu budynków
 * -this.base nie działa...
 */

function Building(base , id = null){

	this.base = base;
//	alert(this.base);
	this.map = base.map;
	this.poly = new google.maps.Polygon({
		paths: [],
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.35
	});
	this.poly.setMap(this.map);
	this.infoWindow = null;
	this.id = id;
	this.test = "asd";

	var th = this;
	google.maps.event.addListener(this.poly, 'click', function(e){th.showInfoWindow(e);});
}

Building.prototype.getPath = function(){
	return this.poly.getPath();
}

Building.prototype.pushPoint = function(x,y){
	var pat = this.getPath();
	var pnt = new google.maps.LatLng(x,y);
	if(pat != null){
		pat.push(pnt);
	}else{
		pat = [pnt];
		this.poly.setPath(pat);
	}
}

Building.prototype.showInfoWindow = function(ev = null){
//	alert(this.test);
	var th = this;
	if(th.infoWindow == null){

		$.ajax({
			url: th.base.settings.buildingInfoWindowUrl+((th.id!=null)?th.id:""),
			success: function(data){
				th.infoWindow = new google.maps.InfoWindow({content: data});
				th.infoWindow.setPosition( (ev==null)?th.getPath().b[0]:ev.latLng);

				if(th.id == null){
					th.infoWindow.addListener("domready",function(){
						$(".building-form input[type='submit']").click(function(){
							var data = th.save();
							var uni = $(".building-form select").val();
							var name = $(".building-form input[name='name']").val();
							var desc = $(".building-form textarea[name='desc']").val();
							$.ajax({
								url: "http://localhost/index.php/locations/saveBuilding/",
								type: "POST",
								data: {data : data , name: name,desc: desc,uni: uni},
								success: function(d){
									th.id = d.id;
									th.infoWindow.close();
									th.infoWindow = null;
									th.base.buildingFinished();
								}
							});
						});
					});

				}
				th.infoWindow.open(th.map);

			}
		});
	}else{
		th.infoWindow.open(th.map);
	}

}

Building.prototype.save = function(){
	var dataStr = "";
	var path = this.getPath();
	$.each(path.b , function(key,val){
		dataStr += val.Ya+","+val.Za+"|";
	});
	return dataStr;
}

Building.prototype.setVisible = function(v){
	this.poly.setVisible(v);
}

