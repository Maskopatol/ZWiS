function Interface(base){
	this.base = base;
	this.ac = 0;
	this.canvas = null;
	this.findOpts = {
		buildings: true,
		lecturers: true,
		students: true
	}
	this.debug = null;
	this.init();

}

Interface.prototype.init = function(){
	var c = $("#"+this.base.settings.mapDivId);
	var filters_button = $("<input class='b-right' id='map_filters_button' type='button' value='Filtry' />");
	var admin_button = $("<input class='b-right' id='map_admin_button' type='button' value='Zarządzaj' />");
	var search_button = $("<input type='button' value='szukaj' />");

	$("<div id='map_top'></div>")
	.append("<label for='map_search'>Szukaj:</label>")
	.append("<input id='search_form' type='text' name='map_search' />")
	.append(search_button)
	.append(filters_button)
	.append(admin_button)
	.appendTo(c);
	//append("<input type='text'>")
	var canvas = $("<div id='map_canvas' />").appendTo(c);
	this.canvas = canvas[0];
	var m = $("<div id='map_menu'></div>")
	.appendTo(c);
	$("<div id='map_filters_menu' class='map_menus'>")
	.append("Filtry:<br />")
	.append("<input type='checkbox' checked='checked' name='buildings'><label for='builgings'>Budynki</label><br />")
	.append("<input type='checkbox' checked='checked' name='lecturers'><label for='lecturers'>Wykładowcy</label><br />")
	.append("<input type='checkbox' checked='checked' name='students'><label for='students'>Studenci</label><br />")
	.appendTo(m);

	var add_button = $("<input type='button' value='Dodaj budynek' />");
	var static_button = $("<input type='button' value='Ustaw statyczną lokację' />");
	var rm_static_button = $("<input type='button' value='Usuń statyczną lokację' />");
	$("<div id='map_admin_menu' class='map_menus'>")
	.append("Zarządzaj:<br />")
	.append(add_button)
	.append(static_button)
	.append(rm_static_button)
	.appendTo(m);

	this.context = $("<div class='contextmenu'><input id='map_setUserPoint' type='button' value='Ustaw lokację statyczną'></div>")
	.appendTo(canvas).hide();




	var th = this;
	$('.map_menus').hide();
	//$('#map_filters_menu').hide();

	admin_button.click(function(){
		if(th.ac != 2){
			th.showAdmin();
		}else{
			th.hideMenu();
		}
	});
	filters_button.click(function(){
		if(th.ac != 1){
			th.showFilters();
		}else{
			th.hideMenu();
		}
	});

	search_button.click(function(){
		th.find($("#search_form").val());
	});

	add_button.click(function(){
		th.base.newBuilding();
	});

	static_button.click(function(){
		th.base.chooseStatic();
	});

	rm_static_button.click(function(){
		$.ajax({
			url: "http://localhost/index.php/locations/unset_static/",
			success: function(){
				document.location = "http://localhost/index.php/locations/";
			}
		});
	});

	$("#map_filters_menu input[type='checkbox']").change(function(){

		th.findOpts[$(this).attr('name')] = !th.findOpts[$(this).attr('name')];
	//	alert($(this).attr('name') + " "+ $(this).is(':checked'));
		th.base.setVisible($(this).attr('name') , $(this).is(':checked'));
	});

}



Interface.prototype.showAdmin = function(){
	if(this.ac == 1){
		$('#map_filters_menu').fadeOut(500,function(){
			$('#map_admin_menu').fadeIn(500);
		});
	}else if(this.ac == 0){
		$("#map_canvas").animate({width:'80%'},1000,function(){
			$('#map_admin_menu').fadeIn(500);
		});
	}
	this.ac = 2;
}

Interface.prototype.showFilters = function(){
	if(this.ac == 2){
		$('#map_admin_menu').fadeOut(500,function(){
			$('#map_filters_menu').fadeIn(500);
		});
	}else if(this.ac == 0){
		$("#map_canvas").animate({width:'80%'},1000,function(){
			$('#map_filters_menu').fadeIn(500);
		});
	}
	this.ac = 1;
}

Interface.prototype.hideMenu = function(){
	$(".map_menus").hide();
	$("#map_canvas").animate({width:'100%'},1000);
	this.ac = 0;
}

Interface.prototype.find = function(string){
	var result = null;
	var th = this;
	this.base.setVisible("all",false);
	$.ajax({
		url: "http://localhost/index.php/locations/find/"+string,
		type: "POST",
		data: {buildings : this.findOpts.buildings , lecturers: this.findOpts.lecturers , students: this.findOpts.students},
		success: function(result){
			th.debug = result;
			if(th.findOpts.buildings == true){
				$.each(th.base.buildings,function(i,v){
					$.each(result.buildings , function(a,b){
						if(v.id == b.id_building){
							v.setVisible(true);
						}

					});
				});
			}
			if(th.findOpts.lecturers == true || th.findOpts.students == true){
				$.each(th.base.users,function(i,v){
					$.each(result.users , function(a,b){
						if(v.userdata.id_user == b.id_user){
							v.setVisible(true);
						}
					});
				});
			}
		}
	});


}
