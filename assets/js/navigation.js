
//------------------------------------------------------------------------
//                      NAVBAR SLIDE SCRIPT
//------------------------------------------------------------------------      
    $(window).scroll(function () {
        if ($(window).scrollTop() > $("nav").height()) {
            $("nav.navbar-slide").addClass("show-menu");
        } else {
            $("nav.navbar-slide").removeClass("show-menu");
            $(".navbar-slide .navMenuCollapse").collapse({toggle: false});
            $(".navbar-slide .navMenuCollapse").collapse("hide");
            $(".navbar-slide .navbar-toggle").addClass("collapsed");
        }
    });
    
})


    
//------------------------------------------------------------------------
//                      ANCHOR SMOOTHSCROLL SETTINGS
//------------------------------------------------------------------------
    $('a.goto, .navbar .nav a').smoothScroll({speed: 1200});
    
