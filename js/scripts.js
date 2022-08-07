/*
Theme Name: Habib
Author: Habib
*/

/* ======= TABLE OF CONTENTS ================================== 

## PRELOADER
## HIGHLIGHT JS
## RANDOMLY PORTFOLIO THUMB
## RANDOMLY PORTFOLIO BACKGROUND
## WRAP EACH MENU CHARACTER WITH SPAN
## DYNAMIC HEIGHT ON MAIN-CONTAINER
## OWL CAROUSEL
## WORK CAROUSEL
## MENU OPEN
## JQUERY PAGE SCROLLING
## MOBILE DROPDOWN MENU
## READMORE HOVER EFFECT
## ADD REMOVE CLASS
## CONTACT FORM
## MOBILE DROPDOWN MENU
## DROPDOWN MENU OFFEST
## PORTFOLIO POPPER SUPPORT
## TOGGLE SIDE MENU
## OFF CANVAS MENU OVERLAY
## STICKY MENU
## TOGGLE SEARCH
## COUNTER
## IMAGE ANIMATION
## MAGNIFIC POPUP
## SOCIAL SHARE POPUP WINDOW
## DETECT IE VERSION
## DETECT IOS MOBILE DEVICE
## DETECT SAFARI VERSION
## BACK TO TOP
## ISOTOP FILTER
## MASONRY GRID
## TT PORTFOLIO CAROUSEL
## PORTFOLIO LOADMORE
## PORTFOLIO INTERACTIVE LINKS
## TICKER
## PRODUCT QUICK VIEW
## STICKY SIDEBAR

========================================================= */

jQuery(function($) {

    'use strict';

    /* ======= PRELOADER ======= */
    (function() {
        var $preloader = $('#preloader');
        if (!$preloader.length) {
            return;
        }
        $(window).on('beforeunload', function() {
            $preloader.fadeIn('slow');
        });
        $preloader.delay(200).fadeOut('slow');
    }());


    /* ======= HIGHLIGHT JS ======= */
    (function() {
        hljs.initHighlightingOnLoad();
    }());


    /* ======= RANDOMLY PORTFOLIO THUMB ======= */
    (function() {
        $("ul.fullscreen-menu li").mouseenter(function() {
            var randomNumberTop = Math.floor((Math.random() * 300) + 1);
            var randomNumberRight = Math.floor((Math.random() * 600) + 1);
            if($('body').hasClass('is-rtl')){
                $("ul.fullscreen-menu li .thumb").each(function() {
                    $(this).css({ 'top': randomNumberTop + 'px', 'left': randomNumberRight + 'px', 'right':'auto' });
                });
            } else{
                $("ul.fullscreen-menu li .thumb").each(function() {
                    $(this).css({ 'top': randomNumberTop + 'px', 'right': randomNumberRight + 'px' });
                });
            }
        });

         $("ul.fullscreen-menu li a span").on("mouseenter touchstart", function() {
            var portfoliTitle = $(this).html();
            $(".glitch::before", ".glitch::after").css("content", portfoliTitle)
        });

        if ($(".portfolio-menu").length > 0) {
            $(".portfolio-menu ul li:first-child").addClass("active");

            var isMenuActive = $("ul.fullscreen-menu li.active a span");
            var portfoliTitle = isMenuActive.html();
            $(".glitch::before", ".glitch::after").css("content", portfoliTitle);

            $(".portfolio-menu ul li").on("mouseenter touchstart", function() {

                $(".portfolio-menu ul li").removeClass("active");

                $(this).addClass("active");
            });
        }

    }());


    /* ======= RANDOMLY PORTFOLIO BACKGROUND ======= */
    (function() {
        $(".tt-portfolio.portfolio-menu ul li").each(function() {
            var bgColor = $(this).attr('data-bg-color');
            $(this).mouseenter(function(){
                $('.tt-portfolio.portfolio-menu').css({ 'background-color': bgColor});
            })
        });
    }());


    /* ======= WRAP EACH MENU CHARACTER WITH SPAN ======= */
    (function() {
        $('.menu-text').html(function(i, html) {
            var chars = $.trim(html).split("");
            return '<span>' + chars.join('</span><span>') + '</span>';
        });
    }());


    /* ======= OWL CAROUSEL ======= */
    (function() {

        if ($('.testimonial-wrapper').length > 0) {
            $('.testimonial-wrapper').each(function() {
                var testimonialItem = $(this).find('.testimonial-carousel');
                testimonialItem.owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: false,
                    lazyLoad: true,
                    autoplayTimeout: 5000,
                    margin: 10,
                    dots: false,
                    autoplayHoverPause: true,
                    nav: true,
                    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
                    onInitialized: counter, //When the plugin has initialized.
                    onTranslated: counter, //When the translation of the stage has finished.
                });


                function counter(event) {
                    var element = event.target; // DOM element, in this example .owl-carousel
                    var items = event.item.count; // Number of items
                    var item = event.item.index + 1; // Position of the current item
                    // it loop is true then reset counter from 1
                    if (item > items) {
                        item = item - items;
                    }
                    $('.testimonial-counter').html(item + " / " + items);
                }
            })
        }

    }());


    /* ======= WORK CAROUSEL ======= */
    (function() {

        if ($('.work-wrapper').length > 0) {
            $('.work-wrapper').each(function() {
                var workItem = $(this).find('.work-carousel');
                workItem.owlCarousel({
                    items: 5,
                    lazyLoad: true,
                    margin: 0,
                    dots: false,
                    nav: true,
                    navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
                    responsive: {
                        0: {
                            items: 1
                        },
                        580: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        1000: {
                            items: 4
                        },
                        1400: {
                            items: 5
                        }
                    }
                });
            });

            var ttFullWide = $('.tt-work-full i');

            ttFullWide.on('click', function() {
                $('.work-wrapper').toggleClass('work-fluid');
            });
        }

    }());


    /* ======= MENU OPEN ======= */
    (function() {
        $(".menu-trigger").on('click', function() {

            var menuWrapper = $('.menu-wrapper');

            $('body').toggleClass('is-menu-open');

            menuWrapper.hasClass("menu-visible") ? menuWrapper.removeClass("menu-visible") : setTimeout(function() {
                menuWrapper.addClass("menu-visible");
            }, 640);

            menuWrapper.hasClass("overflow-visible") ? menuWrapper.removeClass("overflow-visible") : setTimeout(function() {
                menuWrapper.addClass("overflow-visible");
            }, 2000);

        });
    }());


    /* === JQUERY PAGE SCROLLING  === */
    (function() {

        $('[data-toggle="tooltip"]').tooltip();

        $('.navbar-nav a[href^="#"], .tt-scroll, .tt-scroll a').on('click', function(e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);
            var headerHeight = $('.navbar, .navbar.sticky').outerHeight();

            if (target) {
                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top - headerHeight + "px"
                }, 1200);
            }
        });
    }());


    /* === MOBILE DROPDOWN MENU === */
    (function() {
        $('.dropdown-menu-trigger').each(function() {
            $(this).on('click', function(e) {
                $(this).toggleClass('menu-collapsed');
            });
        });
    }());


    /* === READMORE HOVER EFFECT === */
    (function() {
        $('.entry-content .more-link, .press-release-wrapper .readmore')
            .on('mouseenter', function(e) {
                $(this).addClass('tt-mouseover');
                $(this).removeClass('tt-mouseout');
            })

        .on('mouseleave', function(e) {
            var self = $(this);
            $(this).addClass('tt-mouseout');
            $(this).removeClass('tt-mouseover');

            setTimeout(function() {
                self.removeClass('tt-mouseout');
            }, 400);
        });
    }());


    /* === ADD REMOVE CLASS === */
    (function() {
        $('.comment-respond .comment-form input[type="text"], .comment-respond .comment-form input[type="url"], .comment-respond .comment-form input[type="email"], .comment-respond .comment-form textarea, .charitable-donation-form input, .charitable-donation-form select').addClass('form-control');

        $('.tt-promotions .promo-text-item [class*="col"]:last-child .promo-inner').addClass('active');

        $('.tt-promotions .promo-text-item .promo-inner').on('mouseenter', function() {
            $('.tt-promotions .promo-text-item .promo-inner').removeClass('active');
        }).on('mouseleave', function() {
            $('.tt-promotions .promo-text-item [class*="col"]:last-child .promo-inner').addClass('active');
        })

        var vid = document.getElementById("ttVideo");

        $('.tt-promotions .video-popup video').on('click', function() {
            $('.tt-promotions .video-popup').addClass('pause');
            vid.pause();
        })

        $('.tt-promotions .video-popup a.video-link').on('click', function(e) {
            e.preventDefault();
            vid.play();
            $('.tt-promotions .video-popup').removeClass('pause');

            $(this).toggleClass('pause');
        })


        $(document).load($(window).on("resize", checkPosition));

        function checkPosition() {
            if (window.matchMedia('(min-width: 767px) and (max-width: 991px)').matches) {
                var promoHeight = $('.tt-promotions .promo-text-item .promo-inner').height();
                
            }
        }

        $('#carouselExampleControls .carousel-inner .carousel-item:first-child').addClass('active');

       $(window).on("load resize", function(){
            var workCarouse = $('.work-wrapper .owl-carousel .item').height();
            $('.work-wrapper .work-description').css("height", workCarouse + 'px');
        });

        $('.tt-promotions .promo-text-item [class*="col"]:last-child .promo-inner').addClass('active');
    }());


    /* === CONTACT FORM === */
    (function() {

        $(".tt-contact-popup a.contact-us").on('click', function (e) {
            e.preventDefault();
            $(".tt-contact-popup .contact-form").toggleClass("show");
            $(this).toggleClass('times');
        });

        var ttCursorColor = "";
        if ($(".tt-contact-popup").hasClass("white")) {
            ttCursorColor = "#093a57";
        } else if($(".tt-contact-popup").hasClass("blue")){
            ttCursorColor = "#2b82b6";
        } else {
            ttCursorColor = "#e72a00";
        }
        
        $("#maacuni-quick-contact").niceScroll(".wpcf7",{
            cursorcolor: ttCursorColor,
            cursoropacitymax: .7,
            cursorborder: 'none',
            zindex: 5,
            autohidemode: false,
        });
        
        $(".wp-block-gallery figcaption").niceScroll({
            cursoropacitymax: 0,
        });
        $(".menu-wrapper").niceScroll({
            cursoropacitymax: 0,
        });


        if($('.tt-contact-popup').length > 0){
            $('body').addClass('is-contact-popup');
        }
    }());


    /* === MOBILE DROPDOWN MENU === */
    (function() {
        $('li.dropdown > a > span').each(function() {
            var toggleClick = 0;

            $(this).on('click', function(e) {
                e.preventDefault();
                $(this).closest('li.dropdown').toggleClass('menu-collapsed');
            });
        });
    }());


    /* ======= DROPDOWN MENU OFFEST ======= */
    $(window).on('load resize', function() {
        $(".dropdown-wrapper > ul > li").each(function() {
            var $this = $(this),
                $win = $(window);

            if ($this.offset().left + 215 > $win.width() + $win.scrollLeft() - $this.width()) {
                $this.addClass("dropdown-inverse");
            } else if($this.offset().left < 250) {
                $this.addClass("dropdown-inverse-left");
            } else if($this.offset().left < 400){
                $this.removeClass("dropdown-inverse-left");
            } else {
                $this.removeClass("dropdown-inverse");
            }
        });
    });


    /* ======= PORTFOLIO POPPER SUPPORT ======= */
    (function() {
        var popupWrapper = $('.tt-code-block .previous-work .prev-portfolio-item');

        popupWrapper.each(function() {

            var ref = $(this).find('h3');
            var popup = $(this).find('img');

            var popper = new Popper(ref, popup, {
                placement: 'top',
                modifiers: {
                    flip: {
                        behavior: ['left', 'right']
                    },
                }
            });

        });

        $(popupWrapper).mouseover(function() {
                $('.code-block-overlay').addClass('active');
            })
            .mouseout(function() {
                $('.code-block-overlay').removeClass('active');
            });

    }());


    /* ======= TOGGLE SIDE MENU ======= */
    (function() {

        $(".side-menu > a").on("click", function(e) {
            e.preventDefault();
            $("nav.navbar > .side").toggleClass("on");
            $("body").toggleClass("on-side");
            $('.body-overlay').addClass('active');
        });

        $(".side .close-side").on("click", function(e) {
            e.preventDefault();
            $("nav.navbar > .side").removeClass("on");
            $("body").removeClass("on-side");
        });
    }());


    /* ======= OFF CANVAS MENU OVERLAY ======= */
    (function() {
        $('.body-overlay').on('click', function() {
            $(this).removeClass('active');
            $('.side').removeClass('on');
            $('body').removeClass('on-side');
        });
        $('.side .close-side').on('click', function() {
            $('.body-overlay').removeClass('active');
        });
    }());


    /* ======= TOGGLE SEARCH ======= */
    (function() {
        $(".header-search").each(function() {
            $(".header-search > a").on("click", function(e) {
                e.preventDefault();
                $(".top-search form").slideToggle();
                $(this).toggleClass('is-visible');
                $(".top-search input.form-control").focus();
            });
        });
        $(".input-group-addon.close-search").on("click", function() {
            $(".top-search form").slideUp();
        });
    }());


    /* === COUNTER === */
    if ($('.fact-wrap').length > 0) {
        $('.fact-wrap').on('inview', function(event, visible, visiblePartX, visiblePartY) {
            if (visible) {
                $(this).find('.timer').each(function() {
                    var $this = $(this);
                    $({ Counter: 0 }).animate({ Counter: $this.text() }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
                $(this).off('inview');
            }
        });
    }

    /* === IMAGE ANIMATION === */

    (function() {
        $('.tt-animation').append('<div class="img-overlay"></div>');
    }());
    

    $('.tt-load-animation, .tt-load-animation-wrapper').each(function() {
        $(this).on('inview', function(event, visible) {
            if (visible) {
                $(this).addClass('tt-animated');
            }
        });
    });
    
    setTimeout(function(){
        $('.tt-animation').each(function() {
            $(this).on('inview', function(event, visible) {
                if (visible) {
                    $(this).addClass('tt-animated'); 
                }
            });
        });
    }, 1200);


    /* ======= MAGNIFIC POPUP ======= */
    $(window).on('load', function() {
        $(".image-link").magnificPopup({
            type: 'image',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            fixedContentPos: false,
            gallery: {
                enabled: true
            }
        });

        $(".woocommerce-product-gallery__image > a").magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            gallery: {
                enabled: true
            },
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            },
            removalDelay: 300, // Delay in milliseconds before popup is removed
            mainClass: 'mfp-no-margins mfp-with-zoom', // this class is for CSS animation below

        });

        $('.tt-popup, .popup-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: true,
            fixedContentPos: false
        });


        $('.popup-video .popup-youtube, .popup-vimeo, .popup-play').magnificPopup({
            disableOn: 200,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });


    /* ======= SOCIAL SHARE POPUP WINDOW ======= */
    (function() {
        $('.post-share ul li a').on('click', function() {
            var newwindow = window.open($(this).attr('href'), '', 'height=450,width=700');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        });
    }());


    /* === DETECT IE VERSION === */
    (function() {
        function getIEVersion() {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
            return match ? parseInt(match[1], 10) : false;
        }

        if (getIEVersion()) {
            $('html').addClass('ie' + getIEVersion());
            $('html').addClass('ie');
        }
    }());

    /* === DETECT IOS MOBILE DEVICE === */
    (function() {
        if (navigator.userAgent.match(/iP(hone|od|ad)/i)) {
            jQuery('html').addClass('ios-browser');
        }
    }());


    /* === DETECT SAFARI VERSION === */
    (function() {
        var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
        if (isSafari) {
            $('html').addClass('isSafari');
        };
    }());


    /* ======= BACK TO TOP ======= */
    (function() {
        $('.footer-section').append('<div id="toTop"><i class="fas fa-angle-up"></i></div>');

        $(window).on('scroll', function() {
            if ($(this).scrollTop() !== 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });

        $('#toTop, .to-top').on('click', function() {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    }());


    /* === ISOTOP FILTER  === */
    if ($('.isotope-wrap').length > 0) {
        $(window).on('load', function() {

            $('.isotope-wrap').each(function(i, e) {

                var buttonFilter;
                var ttGrid = $(this).find('.tt-grid');

                //var dataNumber = $(this).find('.tt-item').attr('data-number');

                var $grid = ttGrid.isotope({
                    itemSelector: '.tt-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.tt-item'
                    },
                    // layoutMode: 'fitRows',

                    getSortData: {
                        number: '.numbers parseInt'
                    },
                    // sort by color then number
                    sortBy: ['number'],

                    filter: function() {
                        var $this = $(this);
                        var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                        return buttonResult;
                    }

                });

                $(this).find('.tt-filter-wrap ul li').on('click', function() {
                    buttonFilter = $(this).attr('data-filter');
                    $grid.isotope();
                });
            });

            $('.tt-filter-wrap').each(function(i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'li', function() {
                    $buttonGroup.find('.active').removeClass('active');
                    $(this).addClass('active');
                });
            });
        });
    }


    /* === MASONRY GRID  === */
    $(window).on('load', function() {
        $('.masonry-wrap').masonry({
            "columnWidth": ".masonry-column"
        });
    });
   

    /* === TT PORTFOLIO CAROUSEL  === */
    (function() {
        if($('.swiper-container').length > 0 ){

            var swiper = new Swiper('.swiper-container', {
                // Optional parameters
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },

            });

            swiper.mousewheel.enable();


            swiper.on('reachEnd', function() {
                setTimeout(function() { swiper.mousewheel.disable() }, 600);
            });

            var checkFalse = true;

            var sliderHeight = $(window).height() - 50;

            $(window).on('scroll', function() {
                var sliderOffset = $('#portfolio-slider').offset();
                var topOffset = $(this).scrollTop();

                if (topOffset > (sliderOffset.top - sliderHeight)) {

                    if (checkFalse) {

                        // .admin-bar .tt-menu-sticky
                        if($('body').hasClass('admin-bar') && $('body').hasClass('tt-menu-sticky') && $('body').hasClass('header-left-menu')){
                            $('html,body').animate({
                                scrollTop: sliderOffset.top-32
                            }, 1000);
                        } 
                        else if ($('body').hasClass('admin-bar') && $('body').hasClass('tt-menu-sticky')) {
                            $('html,body').animate({
                                scrollTop: sliderOffset.top-112
                            }, 1000);
                        } else if ($('body').hasClass('admin-bar')) {
                            $('html,body').animate({
                                scrollTop: sliderOffset.top-32
                            }, 1000);
                        } else if ($('body').hasClass('tt-menu-sticky') && ! $('body').hasClass('header-left-menu')) {
                            $('html,body').animate({
                                scrollTop: sliderOffset.top-80
                            }, 1000);
                        } else {
                            $('html,body').animate({
                                scrollTop: sliderOffset.top
                            }, 1000);
                        }

                    }
                    checkFalse = false;
                }

                return false;

            })

        
            $('.slider-thumb .small-image').removeClass('img-two');
            
            swiper.on('slideChange', function () {
                $('.slider-thumb .small-image').addClass('img-two');
                setTimeout(function() { 
                    $('.swiper-slide-active .slider-thumb .small-image').removeClass('img-two');
                }, 600);
            });
            
        }

    }());


    /* === PORTFOLIO LOADMORE === */
    $('.tt-portfolio-grid').each(function() {


        $(window).on('load', function() {

            var $content = $('.portfolio-loadmore'),
                $loader = $('.loadmore-btn'),
                perpage = $loader.data('postlimit'),
                allPosts = $loader.data('allposts'),
                ajaxUrl = $loader.data('url'),
                offset = $content.find('.portfolio-item').length,

                taxonomies = $loader.data('taxonomies'),
                font_color = $loader.data('font_color'),
                portfolio_overlay = $loader.data('portfolio_overlay'),
                link_btn_color = $loader.data('link_btn_color'),
                portfolio_layout = $loader.data('portfolio_layout'),
                grid_column = $loader.data('grid_column'),
                layout_style = $loader.data('layout_style'),
                filter_visibility = $loader.data('filter_visibility'),
                filter_text = $loader.data('filter_text'),
                content_limit = $loader.data('content_limit'),
                spacing = $loader.data('spacing'),
                thumb_size = $loader.data('thumb_size'),
                animation_bg_opt = $loader.data('animation_bg_opt'),
                animation_bg = $loader.data('animation_bg'),
                title_border = $loader.data('title_border'),
                description_show_hide = $loader.data('description_show_hide'),
                category_show_hide = $loader.data('category_show_hide'),
                title_show_hide = $loader.data('title_show_hide'),
                single_show_hide = $loader.data('single_show_hide'),

                portfolio_count = $loader.data('portfolio_count'),
                
                link_show_hide = $loader.data('link_show_hide');

            $loader.on('click', load_ajax_posts);

            function load_ajax_posts() {
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: maacuniJSObject.ajaxurl,
                    data: {
                        'perpage': perpage,
                        'offset': offset,
                        'taxonomies': taxonomies,
                        'font_color': font_color,
                        'portfolio_overlay': portfolio_overlay,
                        'link_btn_color': link_btn_color,
                        'portfolio_layout': portfolio_layout,
                        'grid_column': grid_column,
                        'layout_style': layout_style,
                        'filter_visibility': filter_visibility,
                        'filter_text': filter_text,
                        'content_limit': content_limit,
                        'spacing': spacing,
                        'thumb_size': thumb_size,
                        'animation_bg_opt': animation_bg_opt,
                        'animation_bg': animation_bg,
                        'title_border': title_border,
                        'description_show_hide': description_show_hide,
                        'category_show_hide': category_show_hide,
                        'title_show_hide': title_show_hide,
                        'single_show_hide': single_show_hide,
                        'link_show_hide': link_show_hide,
                        'portfolio_count': portfolio_count,
                        'action': 'habib_portfolio_ajax'
                    },
                    beforeSend: function() {
                        $('<i class="fa fa-spinner fa-spin"></i>').appendTo(".loadmore-btn").fadeIn(100);
                    },
                    complete: function() {
                        $('.loadmore-btn .fa-spinner ').remove();
                    }
                })

                .done(function(data) {
                    var $newItems = $(data);

                    $content.isotope('insert', $newItems, function() {
                        $content.isotope('reLayout', {
                            animationEngine: 'jquery',
                            animationOptions: {
                                duration: 400,
                                queue: false
                            }
                        });
                    });

                    $(".image-link").magnificPopup({
                        type: 'image',
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        fixedContentPos: false,
                        gallery: {
                            enabled: true
                        }
                    });

                    var $gridWrap = $('.tt-grid');
                    $gridWrap.imagesLoaded().progress(function() {
                        $gridWrap.isotope('layout');
                    });


                    var newLenght = $content.find('.portfolio-item').length;

                    if (allPosts <= newLenght) {
                        $('.loadmore-btn-wrap').fadeOut(400, function() {
                            $('.loadmore-btn-wrap').remove();
                        });
                    }
                })

                .fail(function() {
                    alert('failed');
                    console.log("error");
                });

                offset += perpage;
                return false;
            }
        });

    });


    /* === TICKER  === */
    $(window).on('load', function() {
        $('.news-ticker-wrapper').fadeIn();
        if (maacuniJSObject.habib_news_ticker == true) {
            $('.news-ticker').newsTicker({
                row_height: 40,
                max_rows: 1,
                speed: 600,
                direction: 'up',
                duration: 4000,
                autostart: 1,
                pauseOnHover: 1
            });
        }
    }());


    /* === PRODUCT QUICK VIEW === */
    (function() {
        $(document.body).on('click', '.tt-quick-view', (function(e) {

            e.preventDefault();

            var $thisbutton = $(this);
            var $productCont = $(this).parent().parent().parent();
            var prodid = $thisbutton.data('prodid');
            var magnificPopup;
            $.ajax({
                url: maacuniJSObject.ajaxurl,
                method: 'POST',
                data: {
                    'action': 'habib_product_quick_view',
                    'prodid': prodid
                },
                dataType: 'html',
                beforeSend: function() {
                    $productCont.addClass('loading');
                    $productCont.append('<span class="fas fa-spinner fa-pulse fa-3x fa-fw"></span>');
                },
                complete: function() {
                    $productCont.find('.fa-spinner').remove();
                    $productCont.removeClass('loading');
                },
                success: function(response) {
                    $.magnificPopup.open({
                        items: { src: '<div class="quick-view-popup mfp-with-anim">' + response + '</div>' },
                        type: 'inline',
                        fixedContentPos: false,
                        removalDelay: 500,
                        callbacks: {
                            beforeOpen: function() {
                                // just a hack that adds mfp-anim class to markup
                                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                                this.st.mainClass = 'mfp-zoom-out';
                                $('body').addClass('quick-view-open');
                            },
                            afterClose: function() {
                                $('body').removeClass('quick-view-open');
                            }
                        },
                    }, 0);

                    $('.images').addClass('shown');


                },
                error: function() {
                    $.magnificPopup.open({
                        items: {
                            src: '<div class="quick-view-popup mfp-with-anim">Error with AJAX request</div>'
                        },
                        type: 'inline',
                        removalDelay: 500,
                        callbacks: {
                            beforeOpen: function() {
                                this.st.mainClass = 'mfp-zoom-in-to-left-out';
                            }
                        }
                    }, 0);
                }
            });

        }));

        $('body').on('click', '.quick-view-popup .woocommerce-product-gallery__image > a', function(e) {
            e.preventDefault();
        });

    }());



    /* ======= STICKY SIDEBAR ======= */
    (function() {
        $('.sidebar-sticky').ttStickySidebar({
            additionalMarginTop: 0
        });
        $('.sticky-item').ttStickySidebar({
            additionalMarginTop: 80
        });
    }());

});