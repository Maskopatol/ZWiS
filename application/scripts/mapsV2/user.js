function User(base , userdata){
	this.base = base;
	this.map = base.map;
	this.userdata = userdata;
	this.point = new google.maps.LatLng(this.userdata.latitude,this.userdata.longitude);
	this.infoWindow = null;
	this.url = "http://localhost/index.php/locations/user_info/"+this.userdata.id_user;


	var th = this;
	this.marker = new google.maps.Marker({
		position: th.point,
		map: th.map,
		title: th.userdata.name+" "+th.userdata.surname,
		icon: this.base.settings.userFrameUrl
	});

	google.maps.event.addListener(this.marker, 'click', function(e){
		th.clickHandler(e);
	});

}
User.prototype.clickHandler = function(ev){
	if(this.infoWindow == null){
		var th = this;
		$.ajax({
			url: th.url,
			success: function(d){
				th.infoWindow = new google.maps.InfoWindow({content: d});
				th.infoWindow.open(th.map,th.marker);
			}
		});
	}else{
		this.infoWindow.open(th.map,th.marker);
	}
}

User.prototype.setVisible = function(val){
	this.marker.setVisible(val);
}

User.prototype.image = function(){
	var img = document.createElement("canvas");
	var ctx = null;
	var th = this;

	var frame = new Image();

	frame.onload = function(){
		var photo = new Image();

		photo.onload = function(){
			img.width = frame.width;
			img.height = frame.height;
			ctx = img.getContext("2d");
			ctx.drawImage(frame, 0, 0);
			ctx.drawImage(photo, 4, 4);
		}
		photo.src = th.userdata.photo;
	}
	frame.src = this.base.settings.userFrameUrl;

	var dataURL = img.toDataURL("image/png");

	return dataURL;
}
