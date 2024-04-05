(function(){

	$.fn.scrollTop = function(){

		var settings = $.extend({
			// Dimensions
			width:50,
			height:50,
			text:'Top'
		});

		var div = document.createElement('div');
		div.className = 'scrollTop';
		$('body').append(div);
		var link = document.createElement('a');
                link.href = "#";
                var i = document.createElement('i');
                i.className = 'fa fa-angle-up';
		$(link).append(i);
		$(div).append(link);

		$('.scrollTop').click(function(e){
			e.preventDefault();
			$('html, body').animate({
				scrollTop:0
			}, 500, 'linear');
		});

		$(window).on('scroll', function(){
                        console.log($(window).scrollTop());
			if($(window).scrollTop() > 300){
				$('.scrollTop').stop().fadeIn(200);
			} else if($(window).scrollTop() < 300){
				$('.scrollTop').stop().fadeOut(200);
			}
		});

	};

	$.fn.scrollTop();

})(jQuery);