(function($){
  /*mobile*/
  var nav_global = $('#navGlobal');
  var showMenuMobile = function () {
    $('#btnMenu').click(function(e){
      var w_device = $(window).width();
      if(e.handled !== true){
        if(w_device < 959 && $('#btnMenu').is(':visible')){
          if(nav_global.is(':visible')){
            nav_global.slideUp(500);
          }else{
            nav_global.delay(100).slideDown(500);
          }
        }
        $(this).toggleClass('show');
        e.handled = true;
      }
      e.preventDefault();
    });
  };
  /*tabContent*/
  var $tabs = $('#horizontalTab');
  $tabs.responsiveTabs({
      rotate: false,
      startCollapsed: 'accordion',
      collapsible: 'accordion',
      setHash: true,
      activate: function(e, tab) {
          $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
      },
      activateState: function(e, state) {
          //console.log(state);
          $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
      }
  });
  /*end*/
  /*fixedHeader*/
  // scroll is still position
    $(function(){ 
    // scroll is still position
      var scroll = $(document).scrollTop();
      var headerHeight = $('.header').outerHeight();
      //console.log(headerHeight);
      
      $(window).scroll(function() {
        // scrolled is new position just obtained
        var scrolled = $(document).scrollTop();
                
        // optionally emulate non-fixed positioning behaviour
      
        if (scrolled > headerHeight){
          $('.header').addClass('offCanvas');
        } else {
          $('.header').removeClass('offCanvas');
        }

          if (scrolled > scroll){
               // scrolling down
           $('.header').removeClass('hFixed');
            } else {
            //scrolling up
            $('.header').addClass('hFixed');
          }       
        scroll = $(document).scrollTop(); 
       });
    });
  /*end*/
  var slideHomepage = function(){
    $('#slideHomepage').owlCarousel({
        margin:0,
        responsiveClass:true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive:{
            0:{
                items:1,
                nav:true,
                dots: false
            },
            640:{
                items:1,
                nav:true,
                dots: false
            },
            1000:{
                items:1,
                nav:true,
                dots: false
            }
        }
    });
  };
  var slideHistory = function(){
      $('#slideHistory').owlCarousel({
        loop:true,
          autoplay: true,
          autoPlaySpeed: 5000,
          autoPlayTimeout: 5000,
          autoplayHoverPause: true,
        margin:20,
        responsiveClass:true,
        responsive:{
          0:{
            items:1,
            nav:true,
            dots: false
          },
          640:{
            items:2,
            nav:true,
            dots: false
          },
          1000:{
            items:2,
            nav:false,
            loop:true,
            dots: true
        }
      }
    });
  };

    var slideProduct = function(){
        $('#slide-product').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:2,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
	/*tabs*/
	var tabContent = function(){
        $("a[data-type='tab']").on('click',function(e){
            e.preventDefault();
            var parent = $(this).data('parent');
            var content = $(this).data('content');
            var reset = $(this).data('reset');
            $("." + parent + " li").removeClass('active');
            $(this).parent("li").addClass('active');
            $("."+reset).css({display:"none"});
            $("#"+content).css({display:"block"});
        });
    };

  /*equalHeight*/
   equalHeight($('.boxContact .itemLeft, .boxContact .itemRight'));
    function equalHeight(obj) {
      if($(window).width() > 960 && obj.length>0){
          obj.matchHeight();
          $.fn.matchHeight._update();
      } else {
        obj.removeAttr('style');
      }
    }
  jQuery(document).ready(function() {
    showMenuMobile();
    slideHomepage();
    slideHistory();
    slideProduct();
	tabContent();
  });
})(jQuery);