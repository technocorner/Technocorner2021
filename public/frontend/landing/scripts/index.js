//logo animation
anime({
    targets: '.logo polygon, .logo image, .logo path, .logo rect, .logo mask',
    fillOpacity: [0, 1],
    loop: false,
    direction: 'alternate',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutSine',
    duration: 1000,
    delay: (el, i) => { return i * 50 },
    complete: function(anim) {
            
        setTimeout(() =>  {
            //resize logo
            // if( $(window).width() < 400){
            //     $("svg").height('200px');
            // } else if( $(window).width() < 500){
            //     $("svg").height('250px');
            // } else if( $(window).width() < 800){
            //     $("svg").height('320px');
            // } else {
            //     $("svg").height('450px');
            // }
            
            var marginTop = "-" + $(window).height() / 6 + "px"
            console.log(marginTop)
            $(".logodiv").height('80%');
            $('.textdiv').css('margin-top', marginTop);            

            //show body
            $( "#logo" ).even().addClass( "logo-after" );
            setTimeout(() =>  {
                $( "#coming-soon-text" ).even().addClass( "coming-soon-text-reveal" );
                $( ".footer-mid" ).show(2000);
                $("img").show(3000);
            }, 1000);        
        }, 2000);        

        $( ".backline" ).show('slow');
        //backline animation
        anime({
            targets: '.backline polygon, .backline path, .backline rect',
            opacity: [0.2, 1],
            loop: true,
            direction: 'alternate',
            strokeDashoffset: [anime.setDashoffset, 0],
            easing: 'easeInOutSine',
            duration: 1000,
            delay: (e, i) =>  500,
        })

    }
});