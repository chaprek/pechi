$(document).ready(function(){

	//hidden blocks menu
		// hidden search
		$('#search').on('click', function(event) {
			$(this).toggleClass('visible');
				if ($(this).hasClass('visible')) {
					$('#hidden-search').slideDown(200);
				}
				else {
					$('#hidden-search').slideUp(200);
				}
			return false;
		}); 
		// hidden menu
		$(".menu").click(function(){
			var w = 280;
			var bar = $("#hidden-menu");
			bar.toggleClass("open");
			if (bar.hasClass("open")){
				$('.menu').addClass('checked');
			    $('#wrapper').css({
			    	'position': 'absolute',
			    	'overflow': 'hidden'
			    });
			    $("#page").append("<div class='page-mask'/>");
			    bar.show().animate({"width": w}, function(){});
                $("header .right").css({
                    "position": "absolute",
                    "right": '10px'
                });
			    $("#page").animate({"margin-left": w});
			}
			else {
				bar.animate({"width": 0}, function(){
				    bar.hide();
				    $(".page-mask").remove();
				});
				$('.menu').removeClass('checked');
				$("#wrapper").css({
					'position':'relative',
					'overflow':''
				});
				$("#page").animate({"margin-left": 0});
			}
			return false;
		});

	    $("#page").on("click", ".page-mask", function(){
	        $("#hidden-menu").removeClass("open");
	        $("#hidden-menu").animate({"width": 0}, function(){
	            $("#hidden-menu").hide();
	            $('.menu').removeClass('checked');
	            $(".page-mask").remove();
	            $("#header .right").removeAttr("style");
	            $("header .right").removeAttr("style");
	        });
	        $("#wrapper").css("position", "");
	        $("#page").animate({"margin-left": 0});
	    });
			// accordion hidden-menu
			$('#hidden-menu .inner-body a:last-child').css('border-bottom','none');
			$('#hidden-menu .link-name').on('click', function() {
				$(this).toggleClass('selected');
				if ($(this).hasClass('selected')) {
					$(this).parent().find('.inner-body').slideDown(250);
				}
				else {
					$(this).parent().find('.inner-body').slideUp(250);
				}
			});
		// hidden menu

		// hidden basket
		$(".basket").click(function(){
			var widhtBasket = 280;
			var bar = $("#hidden-basket");
			bar.toggleClass("open");
			if (bar.hasClass("open")){
				$('.basket').addClass('checked');
				$(".page-mask-basket").animate({
					'margin-right': widhtBasket},
					100, function() {});
			    $('#wrapper').css({
			    	'position': 'absolute',
			    	'overflow': 'hidden'
			    });
			    $("#page").append("<div class='page-mask-basket'/>");
			    bar.show().animate({"width": widhtBasket}, function(){});
                $("header .right").css({
                    "position": "absolute",
                    "right": '10px'
                });
			    $("#page").animate({"margin-right": widhtBasket});
			}
			else {
				bar.animate({"width": 0}, function(){
				    bar.hide();
				    $(".page-mask-basket").remove();
				});
				$('.basket').removeClass('checked');
				$("#wrapper").css({
					'position':'relative',
					'overflow':''
				});
				$("#page").animate({"margin-right": 0});
			}
			return false;
		});

	    $("#page").on("click", ".page-mask-basket", function(){
	        $("#hidden-basket").removeClass("open");
	        $("#hidden-basket").animate({"width": 0}, function(){
	            $("#hidden-basket").hide();
	            $('.basket').removeClass('checked');
	            $(".page-mask-basket").remove();
	            $("#header .right").removeAttr("style");
	            $("header .right").removeAttr("style");
	        });
	        $("#wrapper").css("position", "");
	        $("#page").animate({"margin-right": 0});
	    });
		// hidden-basket

			// accordion hidden-menu
			$('#hidden-menu .inner-body a:last-child').css('border-bottom','none');
			$('#hidden-menu .link-name').on('click', function() {
				$(this).toggleClass('selected');
				if ($(this).hasClass('selected')) {
					$(this).parent().find('.inner-body').slideDown(250);
				}
				else {
					$(this).parent().find('.inner-body').slideUp(250);
				}
			});
		// hidden menu

		// hidden contacts
		var counterHght = 364;
		$('.phone').on('click', function() {
			$(this).toggleClass('checked');
			if ($(this).hasClass('checked')) {
				$("#page").append("<div class='page-mask-contacts'/>");
				$(".page-mask-contacts").animate({
					'margin-top': counterHght},
					100, function() {});
				$("#wrapper").css({
					'position':'absolute',
					'overflow':'hidden'
				});
				$('#hidden-contacts').slideDown(250);
			}
			else {
				$(".page-mask-contacts").remove();
				$('#hidden-contacts').slideUp(250);
				$("#wrapper").css({
					'position':'relative',
					'overflow':''
				});
			}
			return false;
		});
	    $("#page").on("click", ".page-mask-contacts", function(){
	    	$('#hidden-contacts').slideUp(250);
	    	$(".page-mask-contacts").remove();
	    	$('.phone').removeClass('checked');
			$("#wrapper").css({
				'position':'relative',
				'overflow':''
			});
	    });
	    // hidden contacts

	// first slider with counter slides
	var slider = $('.recommended ul').bxSlider({
	  auto: false,
	  autoControls: true,
	  pager: false,
	  speed: 300,
	  controls: true,
	  infiniteLoop: false,
	  startSlide: 0,
	  onSlideAfter: function(){
		if ($('.recommended ul').length)
			$('.recommended .right .current').text(slider.getCurrentSlide() + 1);
	  }
	});
	// get current slides function
	if ($('.recommended ul').length) {
		var counter = slider.getSlideCount();
		$('.current-current').text(slider.getCurrentSlide() + 1);
	}
	$('.number-slides').text(counter);

	// second slider with counter slides
	var sliderSecond = $('.action ul').bxSlider({
	  auto: false,
	  autoControls: true,
	  pager: false,
	  speed: 300,
	  controls: true,
	  infiniteLoop: false,
	  startSlide: 0,
	  onSlideAfter: function(){
		if ($('.action ul').length)
			$('.action .right .current').text(sliderSecond.getCurrentSlide() + 1);
	  }
	});
	// get current slides function
	if ($('.action ul').length) {
		var counter = sliderSecond.getSlideCount();
		$('.current-current').text(sliderSecond.getCurrentSlide() + 1);
	}
	$('.number-slides').text(counter);

	// brands slider
	$('.brands .slider ul').bxSlider({
		pager: false,
		controls: true,
		speed: 300
	});

});


