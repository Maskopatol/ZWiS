function Interface(parent){

	this.ac = 1;


	var th = this;
		$('#map_admin_menu').hide();


		$("#map_admin_button").click(function(){
			if(ac == 1){
				$('#map_filters_menu').fadeOut(500,function(){
					$('#map_admin_menu').fadeIn(500);
					th.ac = 2;
				});
			}else if(ac == 0){
				$("#map_canvas").animate({width:'80%'},1000,function(){
					th.ac = 2;
					$('#map_admin_menu').fadeIn(500);
				});
			}else{
				$(".map_menus").hide();
				$("#map_canvas").animate({width:'100%'},1000,function(){th.ac = 0;});
			}
		});
		$("#map_filters_button").click(function(){
			if(ac == 2){
				$('#map_admin_menu').fadeOut(500,function(){
					$('#map_filters_menu').fadeIn(500);
					th.ac = 1;
					//	$("#map_canvas").animate({width:'100%'},1000,showFilters);
				});

				//	$("#map_menu").animate({width:'0%'},1000);
			}else if(ac == 0){
				$("#map_canvas").animate({width:'80%'},1000,function(){
					th.ac = 1;
					$('#map_filters_menu').fadeIn(500);
				});
			}else{
				$(".map_menus").hide();
				$("#map_canvas").animate({width:'100%'},1000,function(){th.ac = 0;});
			}
		});
}

Interface.prototype.admin
