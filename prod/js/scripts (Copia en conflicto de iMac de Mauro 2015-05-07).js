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


    $('.pestana').swipe( {
        swipeDown:function() {
          $('.content-menu').animate({
                height: 271,
                'padding-bottom':50
            },{duration:500});
        },
        swipeUp:function(){
            $('.content-menu').animate({
                height:'0px',
                'padding-bottom':0
            },{duration:500});
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
         //threshold:5
    });


}(jQuery));
