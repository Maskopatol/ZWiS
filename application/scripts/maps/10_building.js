
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

	google.maps.event.addListener(this.poly, 'click', th.clickListener);

	//	google.maps.event.addDomListener(this.poly, 'rightclick', function(){
		//		th.builder.current = th;
		//	});
	}

	Building.prototype.clickListener = function(){
		if(this.id == null && this.infowindow == null){
			$.ajax({
				url: "http://localhost/index.php/locations/building/"+((this.id!=null)?this.id:""),
				   success: function(d){
					   this.builder.current = null;
					   this.infowindow = new google.maps.InfoWindow({content: d});
					   this.infowindow.setPosition( new google.maps.LatLng(this.paths[0].x,this.paths[0].y));

					   this.infowindow.addListener("domready",function(){
						   $(".building-form input[type='submit']").click(function(){
							   var data = this.save();
							   var uni = $(".building-form select").val();
							   var name = $(".building-form input[name='name']").val();
							   var desc = $(".building-form textarea[name='desc']").val();
							   $.ajax({
								   url: "http://localhost/index.php/locations/saveBuilding/",
				 type: "POST",
				 data: {data : data , name: name,desc: desc,uni: uni},
				 success: function(d){
					 this.id = d.id;
				 }
							   });

							   this.infowindow.close();
							   this.infowindow = null;
						   });
					   });
					   this.infowindow.open(this.map);

				   }
			});
		}else if(this.infowindow == null){
			$.ajax({
				url: "http://localhost/index.php/locations/building/"+((this.id!=null)?this.id:""),
				   success: function(d){
					   this.builder.current = null;
					   this.infowindow = new google.maps.InfoWindow({content: d});
					   this.infowindow.setPosition( new google.maps.LatLng(this.paths[0].x,this.paths[0].y));
					   this.infowindow.open(this.map);
				   }
			});

		}else{
			this.infowindow.open(this.map);
		}
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
