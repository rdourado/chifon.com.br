// Newsletter
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
	var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
	if (!re.test(f.elements["ne"].value)) {
		alert("Email inválido.");
		return false;
	}
	if (f.elements["nn"] && (!f.elements["nn"].value || f.elements["nn"].value == 'nome')) {
		alert("Digite seu nome.");
		return false;
	}
	if (f.elements["np1"] && (!f.elements["np1"].value || f.elements["np1"].value == 'celular')) {
		alert("Digite seu celular.");
		return false;
	}
	if (f.elements["np2"] && (!f.elements["np2"].value || f.elements["np2"].value == 'aniversário dd/mm')) {
		alert("Digite seu aniversário.");
		return false;
	}
	if (f.elements["ny"] && !f.elements["ny"].checked) {
		alert("You must accept the privacy statement");
		return false;
	}
	return true;
}
}

// Wide Slider
function wideSlider() {
	$wwid = $(window).width();
	if ($wwid < 990) $wwid = 990;

	$witems.css({ float : 'left', width : $wwid });
	$wviewport.css({ position : 'relative', overflow : 'hidden', width : $wwid });

	interval = setInterval(function(){
		var h = $witems.first().find('img').height();
		if (h) {
			$wviewport.height(h);
			clearInterval(interval);
		}
	}, 50);

	$woverview.css({ width : $wwid * wtotal, left : $wwid * -wcur });
	$wnext.unbind('click').click(function(e){
		e.preventDefault();
		if (wcur < wtotal - 1) {
			wcur++;
			$woverview.animate({ left : $wwid * -wcur },'slow');
			$wviewport.animate({ height : $witems.eq(wcur).find('img').outerHeight() },'slow');
		}
		if (wcur >= wtotal - 1) $(this).hide();
		$(this).prev().show();
	});
	$wprev.unbind('click').click(function(e){
		e.preventDefault();
		if (wcur > 0) {
			wcur--;
			$woverview.animate({ left : $wwid * -wcur },'slow');
			$wviewport.animate({ height : $witems.eq(wcur).find('img').outerHeight() },'slow');
		}
		if (wcur <= 0) $(this).hide();
		$(this).next().show();
	});
};

// Me
var interval, wcur, $wwid, $wslider, $witems, $woverview, $wviewport, $wprev, $wnext, wtotal;
function ready(){

	// Menu
	try{
		$('#menu>.menu-item-news>a').unbind('click').click(function(e){
			e.preventDefault();
			$(this).parent().toggleClass('current-menu-item');
			$('#newsform').slideToggle();
		});
		$('#menu>.menu-item-news').removeClass('current-menu-item');
		$('#newsform').slideUp(0);
	}catch(e){}
	try{
		$('#menu>li:not(".no-ajax")>a,#menu-colecao>li>a,#logo>a,#body>.highlight>a').unbind('click').click(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$.ajax({
				url: href,
				type: 'get',
				data: {ajax:'1'},
				dataType: 'json',
				cache: false
			}).done(function(data){
				$('body').removeClass().addClass(data.slug);
				$('#body').replaceWith(data.post_content);
				try{
					$('#head>.board').remove();
					if (data.slug == 'home')
						$('#logo').after('<img src="' + data.image + '" alt="" class="board" />');
					else if (data.image)
						$('#head').append('<img src="' + data.image + '" alt="" class="board" />');
				}catch(e){}
				$('html,body').scrollTop(0);
				ready();
			});
		});
	}catch(e){}


	// Mask
	try{

		var SaoPauloCelphoneMask = function(phone, e, currentField, options){
			return phone.match(/^(\(?11\)? ?9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g) ? '(00) 00000-0000' : '(00) 0000-0000';
		};
		$('#np1, #cf_field_20,#cf_field_21,#cf_field_22, #cf2_field_5, #cf3_field_4, #cf4_field_7,#cf4_field_8').mask(SaoPauloCelphoneMask, { onKeyPress: function(phone, e, currentField, options){
			$(currentField).mask(SaoPauloCelphoneMask(phone), options);
		}});

		$('#np2').mask('99/99');

		$('#cf_field_4,#cf_field_8').mask('99/99/9999');
		$('#cf_field_3').mask('999.999.999-99');
		$('#cf_field_17').mask('99999-999');

		$('#cf4_field_4').mask('99.999.999/9999-99');

		$('#newsform input').trigger('blur');
		
	}catch(e){}

	// Fancybox
	try{ $('#body .fancybox').fancybox({type:'image'}); }catch(e){}

	// Go Up
	try{
		$('#up-up-and-away').unbind('click').click(function(e){
			e.preventDefault();
			$('html,body').animate({scrollTop:0}, 500);
		});
	}catch(e){}

	// Wide Slider
	try{
		$wslider = $('.wide-slider','#body');
		$witems = $wslider.find('>*');
		$woverview = $wslider.parent().css('position', 'relative');
		$wviewport = $woverview.parent();
		$wprev = $wviewport.find('>.wide-prev').hide();
		$wnext = $wviewport.find('>.wide-next');
		wtotal = $witems.length;
		wcur = 0;
		$('body').unbind('keydown').keydown(function(e){
			var keyCode = e.keyCode || e.which,
				arrow = {left: 37, up: 38, right: 39, down: 40};
			if (keyCode == arrow.left)
				$wprev.trigger('click');
			else if (keyCode == arrow.right)
				$wnext.trigger('click');
		});
		$(window).unbind('resize').resize(wideSlider).trigger('resize');
		setTimeout(wideSlider, 500);
	}catch(e){}

	// Slider
	try{
		$sslider = $('.slider','#body').wrap('<div class="slider-viewport"><div class="slider-overview"></div></div>');
		$sslider.each(function(){
			var $this = $(this),
				$sitems = $this.find('>*'),
				$soverview = $this.parent(),
				$sviewport = $soverview.parent()
				sshow = parseInt($this.attr('data-show') ? $this.attr('data-show') : 4);

			if ($sitems.length > sshow) {

				$sviewport.prepend('<button class="slider-prev"></button><button class="slider-next"></button>').css({ position : 'relative' });
				var $sprev = $sviewport.find('>.slider-prev').hide(),
					$snext = $sviewport.find('>.slider-next');

				interval = setInterval(function(){
					var h = $sitems.first().find('img').outerHeight();
					if (h) {
						$sviewport.height(h);
						clearInterval(interval);
					}
				}, 200);

				$sviewport.data('scur', 0);
				$sviewport.data('sshow', sshow);
				$sviewport.data('items', $sitems);
				$sviewport.data('stotal', $sitems.length);
				$sitems.filter(':gt('+(sshow-1)+')').hide();

				$snext.unbind('click').click(function(e){
					e.preventDefault();
					var $this 		= $(this),
						$viewport 	= $this.parent(),
						$sitems 	= $viewport.data('items'),
						scur 		= $viewport.data('scur'),
						sshow 		= $viewport.data('sshow'),
						stotal 		= $viewport.data('stotal');

					if (scur < stotal-sshow) {
						scur += sshow;
						$viewport.data('scur', scur);
						$sitems.filter(':visible').fadeOut('normal', function(){
							for (i=0; i<sshow; i++)
								$sitems.eq(i+scur).fadeIn('normal');
						});
					}
					if (scur >= stotal-sshow) $(this).hide();
					$(this).prev().show();
				});
				$sprev.unbind('click').click(function(e){
					e.preventDefault();
					var $this 		= $(this),
						$viewport 	= $this.parent(),
						$sitems 	= $viewport.data('items'),
						scur 		= $viewport.data('scur'),
						sshow 		= $viewport.data('sshow'),
						stotal 		= $viewport.data('stotal');

					if (scur > 0) {
						scur -= sshow;
						$viewport.data('scur', scur);
						$sitems.filter(':visible').fadeOut('normal', function(){
							for (i=0; i<sshow; i++)
								$sitems.eq(i+scur).fadeIn('normal');
						});
					}
					if (scur <= 0) $(this).hide();
					$(this).next().show();
				});

			}

		});

	}catch(e){}

	// Lojas
	try{
		var map, geocoder, marker;
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-14.235004,-51.92528);
		var mapOptions = {
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		marker = new google.maps.Marker({ map: map });

		function codeAddress(address) {
			geocoder.geocode( {'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					marker.setPosition(results[0].geometry.location);
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
		}
	}catch(e){}
	try{
		var $lojas = $('#body .loja');
		$('#lojas').unbind('change').change(function(){
			$lojas.hide();
			var $current = $('#'+$(this).val()).show();
			codeAddress($current.find('.info-text>span').text() + ', Rio de Janeiro, Brasil');
		}).trigger('change');
	}catch(e){}

	// Clipping
	try{
		var $clips = $('#body .slider-viewport');
		$('#months').unbind('change').change(function(){
			document.location = $(this).attr('data-action') + '?clip=' + $(this).val();
			//$clips.hide();
			//$('#'+$(this).val()).parent().parent().show();
			//$('#current').text($(this).find(':selected').text());
		});
	}catch(e){}

	// Radio
	try{
		if (!$('#radio').hasClass('on')) {
			var songs = [
			{
				title:"The XX - Crystalised",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/crystalised.mp3"
			},
			{
				title:"The Japanese Popstars - Shells Of Silver",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/shells-of-silver.mp3"
			},
			{
				title:"Rihanna - Diamonds",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/diamonds.mp3"
			},
			{
				title:"Bruno Mars - Locked Out Of Heaven",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/locked-out-of-heaven.mp3"
			},
			{
				title:"Justin Timberlake - Mirrors",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/mirrors.mp3"
			},
			{
				title:"Swedish House Mafia - Don't You Worry Child",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/dont-you-worry-child.mp3"
			},
			{
				title:"David Guetta - She Wolf (Falling To Pieces)",
				mp3:"http://chifon.com.br/wp-content/themes/chifon/audio/mp3/she-wolf.mp3"
			}];
			songs.sort(randOrd);
			$('#radio').addClass('on').html('<div id="jquery_jplayer_1" class="jp-jplayer"></div><div id="jp_container_1" class="jp-audio"><div class="jp-type-playlist"><div class="jp-gui jp-interface"><ul class="jp-controls"><li><a href="javascript:;" class="jp-previous">previous</a></li><li><a href="javascript:;" class="jp-play">play</a></li><li><a href="javascript:;" class="jp-pause">pause</a></li><li><a href="javascript:;" class="jp-next">next</a></li><li><a href="javascript:;" class="jp-stop">stop</a></li><li><a href="javascript:;" class="jp-mute" title="mute">mute</a></li><li><a href="javascript:;" class="jp-unmute" title="unmute">unmute</a></li><li><a href="javascript:;" class="jp-volume-max" title="max volume">max volume</a></li></ul><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div><div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div><div class="jp-current-time"></div><div class="jp-duration"></div><ul class="jp-toggles"><li><a href="javascript:;" class="jp-shuffle" title="shuffle">shuffle</a></li><li><a href="javascript:;" class="jp-shuffle-off" title="shuffle off">shuffle off</a></li><li><a href="javascript:;" class="jp-repeat" title="repeat">repeat</a></li><li><a href="javascript:;" class="jp-repeat-off" title="repeat off">repeat off</a></li></ul></div><div class="jp-playlist"><ul><li></li></ul></div><div class="jp-no-solution"></div></div></div>');
			new jPlayerPlaylist({jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1"}, songs,
			{
				playlistOptions: { autoPlay: true },
				swfPath: "/wp-content/themes/myth/js/jplayer",
				supplied: "mp3",
				wmode: "window"
			});
		}
	}catch(e){}

};
$(document).ready(ready);

// Recursive Height
function getHeight(img) {
	var h = img.height();
	if (!h) return getHeight(img);
	return h;
}

// Array Random
function randOrd() {
	return (Math.round(Math.random())-0.5);
}