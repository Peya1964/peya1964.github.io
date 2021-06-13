        function show_view(num,obj){
            var a = '#apt-'+num;
            var b = '.qi-'+num;
        
            if (!jQuery(a).is(':visible') ){
                jQuery('.apt-view').slideUp( "slow" );
                jQuery(a).slideDown( "slow" );
    
	         jQuery('.qicon-help').slideUp( "slow" );    
 
                jQuery('#qi-0').attr( "class", "qicon qi-0" );
                jQuery('#qi-1').attr( "class", "qicon qi-1" );
                jQuery('#qi-2').attr( "class", "qicon qi-2" );
                jQuery('#qi-3').attr( "class", "qicon qi-3" );
                jQuery('#qi-4').attr( "class", "qicon qi-4" );
                
                jQuery(b).attr("class", "qicon qi-"+num+" active");

            }    
        }
        
        function show_tabs(){
            jQuery('.ap-view-tab-wrapper').slideDown( "slow" );
            jQuery('.ap-view-tab-start-wrapper').slideUp( "slow" );
	     
        }
        
        function ff_toggle(text) {
            jQuery('.ff-content').slideToggle( "fast", function() {
            });    
        }        
        
jQuery( function($) {
	
	$(document).ready(function(){
        	
        
		// Main menu superfish
		$('#main-menu > ul').addClass('dropdown-menu sf-menu');
		$('#main-menu > ul').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: false,
			disableHI: true
		});

		$('.user-menu > ul').addClass('dropdown-menu sf-menu');
		$('.user-menu > ul').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: false,
			disableHI: true
		});

		// Mobile Menu
		jQuery('#navigation-toggle').sidr({
			name: 'sidr-main',
			source: '#sidr-close, #mobile-navigation',
			side: 'left'
		});
		jQuery(".sidr-class-toggle-sidr-close").click( function() {
			$.sidr('close', 'sidr-main');
			return false;
		});

        jQuery(document).ready(function(){
            jQuery("#menu-wrapper").sticky({topSpacing:0});
        });   

        $(".fancybox").attr('rel', 'img-gallery').fancybox({
    		wrapCSS     : 'fancy-img',
            wrapCSS     : 'webseta',
            maxWidth	: '80%',
    		maxHeight	: '80%',
    		fitToView	: true,
    		width		: '80%',
    		height		: '80%',            
            openEffect  : 'fade',
            closeEffect : 'fade',
            nextEffect  : 'fade',
            prevEffect  : 'fade',
      		fitToView	: false,
    		autoSize	: false,
            padding     : 0,
            margin      : [20, 60, 20, 60] // Increase left/right margin
        });

       	jQuery("#seta-gallery .gallery").fancybox({
       	    wrapCSS     : 'fancy-webseta',
    		maxWidth	: 1920,
    		maxHeight	: 1080,
    		fitToView	: true,
    		width		: '100%',
    		height		: '95%',
    		autoSize	: true,
    		closeClick	: false,
    		openEffect	: 'fade',
    		closeEffect	: 'fade'
    	});       
        
 	 if ( jQuery(document).width() < 768 ){
		jQuery('#seta-gallery .gallery').attr('target','_blank');
		jQuery('#seta-gallery .gallery').removeClass('gallery');
	 }

        jQuery("#sbs-calendar").bxSlider({
            minSlides: 3,
            maxSlides: 12,
            slideWidth: 75,
            slideMargin: 16,
            infiniteLoop: false,
            adaptiveHeight: true
        });
        
        if (Drupal.settings.leaflet){
            
            var zoom = Drupal.settings.leaflet[0].lMap.getZoom();
            Drupal.settings.leaflet[0].lMap.on('popupopen', function(centerMarker) {
                var cM = Drupal.settings.leaflet[0].lMap.project(centerMarker.popup._latlng);
                cM.y -= (centerMarker.popup._container.clientHeight/3)*2
                Drupal.settings.leaflet[0].lMap.setView(Drupal.settings.leaflet[0].lMap.unproject(cM),zoom, {animate: true});
            });
          
          
          var dkIcon = L.icon({
                iconUrl: '/map-marker2.png',
                iconSize: [55, 55],
                iconAnchor: [27,55],
                popupAnchor: [0,-60],
            });  
            
            var text = '<h2><a href="/#3dv">Doboskút Vendégház</a></h2><br /><a href="/#3dv"><img src="/vh_1.jpg" width="300" height="169"  /></a>';
            
            L.marker([48.001885,19.5091512],{ icon: dkIcon } ).bindPopup(text).addTo(Drupal.settings.leaflet[0].lMap);
		
  	     Drupal.settings.leaflet[0].lMap.setZoom( Drupal.settings.leaflet[0].lMap.getZoom()-1 );

        }
            
        jQuery('#main-menu a').removeClass('active');
        
/**
 *         jQuery('section').scrollSpy();
 *         jQuery('section').on('scrollSpy:enter', function() {
 *             console.log('enter:', $(this).attr('id'));
 *             var ref= '#main-menu a[href$="/#'+jQuery(this).attr('id')+'"]';    
 *             jQuery('#main-menu a').removeClass('active');
 *             jQuery(ref).addClass('active');
 *             
 *         });
 *         
 *         jQuery('section').on('scrollSpy:exit', function() {
 *             console.log('exit:', jQuery(this).attr('id'));
 *             var ref= '#main-menu a[href$="/#'+jQuery(this).attr('id')+'"]';    
 *             jQuery(ref).removeClass('active');
 *         });
 */
        

        jQuery('a').smoothScroll();

	}); 

	$(window).load(function(){

	}); 
	
});