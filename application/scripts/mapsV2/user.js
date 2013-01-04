function User(base , userdata){
	this.base = base;
	this.map = base.map;
	this.userdata = userdata;
	this.point = new google.maps.LatLng(this.userdata.latitude,this.userdata.longitude);
	this.infoWindow = null;
	this.url = "http://localhost/index.php/locations/user_info/"+this.userdata.id_user;


	//$("<img id='photo"+this.userdata.id_user+"' src='"+this.userdata.photo+"' alt=''/>").appendTo(this.base.interface.mainDiv).hide();

	var th = this;
	this.marker = new google.maps.Marker({
		position: th.point,
		map: th.map,
		title: th.userdata.name+" "+th.userdata.surname,
	//	icon: this.image()//this.base.settings.userFrameUrl
	});

	this.image();
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
	var dataURL = null;
	var frame = new Image();// $('img#frame')[0];
	frame.onload = function(){
		var image = new Image();//$('img#photo'+th.userdata.id_user)[0];
		image.onload =function(){
				img.width = frame.width;
			img.height = frame.height;

			image.width = 36;
			image.height = 36;

			ctx = img.getContext("2d");
			ctx.drawImage(frame, 0, 0);
			ctx.drawImage(image, 4, 4,36,36);
			dataURL = img.toDataURL("image/png");
			th.marker.setIcon(dataURL)
		}
		image.crossOrigin = '';
		image.src = th.userdata.photo;
	}
	frame.crossOrigin = '';
	frame.src = th.base.settings.userFrameUrl;

//	return dataURL;

}
