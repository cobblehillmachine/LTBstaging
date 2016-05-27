hashtag_regexp = /#([a-zA-Z0-9]+)/g;
var $sticky;
var offset;
var headerHeight;

$( window ).load(function() {
	tipsMasonry();
	summerScroll();
	if ($('#instafeed.homepage').length > 0) {
		homepageInstagramFeed();
	}
	if ($('#instafeed.isurvived').length > 0) {
		var msnry;
		iSurvivedInstagramFeed();
	}
/*
	if ($('.microsite-nav.homepage').length > 0) {
		$sticky = $('.microsite-nav.homepage');
		offset = $sticky.offset().top - 104;
		headerHeight = $('header .desktop').height() + $sticky.height();

	}
*/
	accordion()
	
	videoLightbox()
	storySlider();
	if ($(window).width() > 900) {
		divEqualizer($('.table-cell.text'))
		
	}
	if ($(window).width() < 1060) {
		navToggle()
	}
	if ($(window).width() > 700) {
		deepLinking()
	} else {
		$('.fade-in').css('opacity', 1);
		$('.deep-link').on('click', function(e) {
			e.preventDefault();
			var target = $(this).attr('href');
			smoothScroll($(target), 0)
		})
	}
	

})

$( document).ready(function() {
	
	$('iframe').each(function() {
		$(this).wrap('<div class="iframe-container"></div>')
	})
})

$( window ).resize(function() {
	if ($(window).width() > 990) {
		
	} else {
		
	}	
})

$(window).on('scroll', function() {
	gridFadeIn();
	if ($(window).width() > 700) {
		sectionFadeIn();
	} else {
		$('.fade-in').css('opacity', 1);
	}
	
/*
	if ($('.microsite-nav.homepage').length > 0 && $(window).width() > 1060) {
		if ($(window).scrollTop() > offset) {
			$sticky.addClass('sticky');
			$('.body-wrapper').css('margin-top', headerHeight)
		} else {
			$sticky.removeClass('sticky');
			$('.body-wrapper').css('margin-top', headerHeight - $sticky.height())
		}
	}
*/
})

$(document).ajaxComplete( function() {
	
})


function squareMaker(selector) {
	var width = selector.width();
	selector.css('height', width);
	if ($(window).width() > 1150) {
		$('.contact.offset-cont .side-cont').css('height', width);
	}
}

function divEqualizer(divSelector) {
	var maxHeight = 0;
	divSelector.each(function(){
   		if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	});
	divSelector.height(maxHeight);
}

function centerBlogImages() {
	$('img.aligncenter').parent().css('text-align','center')
}

function smoothScroll(element, padding) {
	$('html, body').animate({
        scrollTop: element.offset().top - padding
    }, 600);
}


function homepageInstagramFeed() {
	 var imgs = [];
	 var homepageFeed = new Instafeed({
        accessToken: '201262366.467ede5.828bc3cf2dac4a9a9f8da543240196fb',
        clientId: '4b07bb475d01479b94a6ee3c1e84b768',
        get: 'tagged',
        tagName: 'purebarre',
        sortBy: 'most-recent',
        limit: 6,
        resolution: 'standard_resolution',
        template: '<a class="table-cell link-fix" href="{{link}}" target=_blank ><img src="{{image}}" /></a>',
        success: function (data) {
            // read the feed data and create owr own data struture.
            var images = data.data;
            var result;
            for (i = 0; i < images.length; i++) {
                var image = images[i];
                result = this._makeTemplate(this.options.template, {
                    model: image,
                    id: image.id,
                    link: image.link,
                    image: image.images[this.options.resolution].url
                });
                imgs.push(result);
            }
           
            $("#instafeed2 .first-two").html(imgs.slice(0, 2));
            $("#instafeed2 .third").html(imgs.slice(2,3));

            $("#instafeed3 .fourth").html(imgs.slice(3,4));
            $("#instafeed3 .last-two").html(imgs.slice(4,7));

        }
    });
    homepageFeed.run();
}

function masonry() {
	var $grid = $('#instafeed.isurvived').masonry({
		itemSelector: '.masonry-item',
		columnWidth: '.masonry-item'
	})
	$grid.imagesLoaded().progress( function() {
	  $grid.masonry('layout');
	});
	
}

function iSurvivedInstagramFeed() {
	var feed = new Instafeed({
        accessToken: '201262366.467ede5.828bc3cf2dac4a9a9f8da543240196fb',
        clientId: '4b07bb475d01479b94a6ee3c1e84b768',
        get: 'tagged',
        tagName: 'purebarre',
        sortBy: 'most-recent',
        limit: 24,
        resolution: 'standard_resolution',
        template: '<div class="masonry-item shadow"><a class="link-fix" href="{{link}}" target=_blank ><img src="{{image}}" /></a><div class="cont"><h3>@{{model.user.username}}</h3><p>{{caption}}</p></div></div>',
        after: function() {
	        masonry();
	        $('.masonry-item .cont ').each(function() {
		        $(this).html(linkHashtags($(this).html()));
		    });
		    
        }
    });
    feed.run();
}

function deepLinking() {
	if (location.hash) {
		$('.subpage').hide();
		$(location.hash).show();
		$('.tabs a').each(function() {
			if($(this).attr('href') == location.hash) {
				$(this).addClass('current');
			}
		})
	}
	$('a.deep-link').on('click', function(event) {
		event.preventDefault();
		$('.subpage').hide();
		$('.subpage .fade-in').css('opacity', 0);
		$('.tabs a').removeClass('current');
		var id = $(this).attr('href');
		$(id).fadeIn('slow');
		$(this).addClass('current');
		divEqualizer($('.table-cell.text'))
		location.hash = id;
		$('.tabs a').each(function() {
			if($(this).attr('href') == location.hash) {
				$(this).addClass('current');
			}
		})
	})
}



function linkHashtags(text) {
    return text.replace(
        hashtag_regexp,
        '<a class="hashtag" target=_blank href="http://www.instagram.com/explore/tags/$1">#$1</a>'
    );
} 

function gridFadeIn() {
	$('.masonry-item').each(function() {
		var top_of_object = $(this).offset().top + 50;
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        if (bottom_of_window > top_of_object) {
            $(this).animate({ 'opacity': '1'}, 1000);
         }
	})	
}

function sectionFadeIn() {
	$('.fade-in').each(function() {
		var top_of_object = $(this).offset().top + 50;
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        if (bottom_of_window > top_of_object) {
            $(this).animate({ 'opacity': '1'}, 1000);
         }
	})
}

function videoLightbox() {
	$(".video").click(function(e) { 
		e.preventDefault();
		var height = screen.height/2.5;
	    $.fancybox({
	        type : 'iframe',
	        maxWidth    : 1600,
            fitToView   : true,
            width : 16/9. * height,
			height : height,
            autoSize    : false,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none',
            topRatio: 0.25,
	        // hide the related video suggestions and autoplay the video
	        href : this.href.replace(new RegExp('watch\\?v=', 'i'), 'embed/') + '?rel=0&autoplay=1'
	    });
		return false;
	});
}

function tipsMasonry() {
	$('.tips').masonry({
		itemSelector: '.masonry-item',
		columnWidth: '.masonry-item'
	})
}

function navToggle() {
	$('.nav-toggle').on('click', function() {
		console.log('click');
		$('.side-nav').toggleClass('open');
		$('.moved-by-nav').toggleClass('open');
	})
	$('.moved-by-nav.open').on('click', function () {
		$('.side-nav').toggleClass('open');
		$('.moved-by-nav').toggleClass('open');	
	})
	$('li.menu-item-has-children a').on('click', function(e) {
		e.preventDefault();
		$(this).next($('.sub-menu')).toggleClass('open');
		$('.back').toggleClass('open');
	})
	$('.microsite-nav-toggle').on('click', function() {
		if($(this).hasClass('closed')) {
			$(this).html('close')
		} else {
			$(this).html('menu')
		}
		$(this).toggleClass('closed');
		$('.menu-microsite-nav-container').slideToggle();
	})
	$('.close').on('click', function() {
		$('.side-nav').toggleClass('open');
		$('.moved-by-nav').toggleClass('open');
	})
	$('.back').on('click', function() {
		$('.sub-menu.open').toggleClass('open');
		$('.back').toggleClass('open');

	})
}

function storySlider() {
	$('.first-class-stories.flexslider').flexslider({
		slideshow:false,
		directionNav: true,
		prevText: '',
		nextText: '',
		controlnav: true,
		animation: 'slide',
		smoothHeight: true,
		after: function() {
			if ($(window).width() < 900) {
				smoothScroll($('.flexslider'), 20);
			}
		}
	})
}

function accordion() {
	$('.featured-testimonials .table-cell').on('click', function() {
		if ($(this).hasClass('open')) {
			
		} else {
			$('.table-cell').removeClass('open');
			$('.cont').css('opacity', 0);
			$(this).addClass('open');
			setTimeout(function() {
				$('.open .cont').animate({opacity: 1});
			}, 500)
		}
		
		
	})
}

function summerScroll() {
	$('#cat_hero').on('change', function() {
		smoothScroll($('.offers'), 0)
	})
	$('.fake-dropdown').on("click", function(e) {
		e.preventDefault();
		smoothScroll($('.offers'), 0)
	})
}



























