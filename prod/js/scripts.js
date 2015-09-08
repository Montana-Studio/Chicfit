var feed = new Instafeed({
    get:'user',
    userId:1021323093,
    accessToken:'641827348.467ede5.82e872aed9ed4959a3ee985d62781c51',
    clientId:'cd33a91424cc4cf8a6aaac7db1f6e955',
    template:'<a href="{{link}}" target="_blank"><img src="{{image}}" alt="" /></a>',
    limit:20
});
(function($) { 'use strict'; 
	
    window.mySwipe = $('#slider').Swipe({
		speed:1000,
		auto: 3000,
		continuous: true,
		disableScroll: true,
		stopPropagation: true,
		callback: function(index, element) {},
		transitionEnd: function(index, element) {}
	}).data('Swipe');
	
	$(window).load(function(){

	 	var $container = $('#container');
		// initialize
		$container.masonry({
		 	columnWidth: '.item-principal',
		  	itemSelector: '.item-principal'
		});

	 });

	feed.run();

	$('marquee').marquee('pointer').mouseover(function(){
            $(this).trigger('stop');
        }).mouseout(function(){
            $(this).trigger('start');
        }).mousemove(function(event){
            if ($(this).data('drag') === true){
                this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
            }
        }).mousedown(function(event){
            $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
        }).mouseup(function(){
            $(this).data('drag', false);
    });

    //$('.content-menu').css({'height':0,'padding-bottom':'0'});

    $('.pestana').swipe({
        swipeDown:function() {
          $('.content-menu').animate({
                height: 291,
                'padding-bottom':50
            },{duration:500});
          console.log('down');
        },
        swipeUp:function(){
            $('.content-menu').animate({
                height:'0px',
                'padding-bottom':0
            },{duration:500});
            console.log('up');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
         //threshold:5
    });

    $(window).scroll(function() {

        if ($(this).scrollTop()>1200)
         {
            $('.bg-newsletter').show();
            $('.newsletter-new-suscribe').show();

            setTimeout(function(){
                $('.content-first-box-pop .logo').animate({opacity:1},{duration:500}); }, 700);
            setTimeout(function(){
                $('.title-content-p').animate({opacity:1},{duration:500}); }, 1000);
            setTimeout(function(){
                $('.form-popups').addClass('fade-in-left-sm'); }, 1200);
            setTimeout(function(){
                $('.mensaje-popups').addClass('fade-in-right-sm'); }, 1400);
            setTimeout(function(){
                $('.facebook-popups-animation').addClass('bounceIn'); }, 2000);
            setTimeout(function(){
                $('.tw-popups-animation').addClass('bounceIn'); }, 2300);
             setTimeout(function(){
                $('.inst-popups-animation').addClass('bounceIn'); }, 2600); 
             setTimeout(function(){
                $('.content-poweredby').addClass('showDelay'); }, 2900); 
         }
    });

    $('.close-button-popups').click(function(){
        $('.newsletter-new-suscribe').remove();
        $('.bg-newsletter').remove();
        $('.newsletter-footer').remove(); 
    });



}(jQuery));
