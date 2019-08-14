'use strict';

;(function($, window, document, undefined) {
    
    $(window)
        .resize(function() {
            $('.menu_mobile').hide();
            $('#mainNav #nav ul').hide();
            topNav(); 
            setTopSearch();
            $('#mega-menu-1').dcMegaMenu();
        })
        .load(function(){
            $("head script[src='*/iwd/all/jquery-1.10.2.min.js']").remove();
    
            $('#mega-menu-1').dcMegaMenu();
            
            $('.selectric-select').selectric({
                maxHeight: 200
            });
            
            $('.category-img').parent('.main-container').css('border-top', 'none');
            
            //left value for category description - absolute
            var 
                $categoryTitle = $('.category-title'),
                leftValue = $categoryTitle.outerWidth(),
                cartTableHeight = $('.totals').outerHeight(),
                $tabNavLi = $('ul.tabNav').children('li'),
                $searchLgContainer = $('#search-lg-container'),
                $searchLg = $('#search-lg'),
                $headerWrappHeight = $('.header_wrapp').outerHeight();
                
            $searchLgContainer.find('.fa-search').on('click', function(){
                $searchLg.toggle();
                $(this).toggleClass('blue');
            });
            

            // fix for login forms
            window.scrollTo(0,0);
            
            $categoryTitle.next('.category-description').css('left', leftValue + 10 + 'px');
            // height for cart table
            $('.cart').find('#shopping-cart-table').css('min-height', cartTableHeight + 'px');

            // Product view tabs - add class
            $tabNavLi.eq(0).addClass('tab_active');

            $tabNavLi.on('click', function(){
                $tabNavLi.removeClass('tab_active');
                $(this).addClass('tab_active');
            });
        });
        
        $(document).ready(function() {
            
            var $table = $('.data-table');
            prepareResponsiveTable($table);
            
            // Slider options
            $('#layerslider').layerSlider({
                pauseOnHover: false,
                responsive: true,
                skinsPath: '../skin/frontend/modulesgarden/minimo/js/layerslider/skins/'
                });
                
            $('.fancybox-img').fancybox();
            
            //AW blog
            var $toolbar = $('.toolbar');
            $toolbar.first().children('.pager').hide();
            $toolbar.last().children('.sorter').hide();
            
            //top link icon
            $('a.icon-user').parent('li').addClass('fa fa-user fa-lg');
            $('a.icon-wishlist').parent('li').addClass('fa fa-heart fa-lg');
            $('a.top-link-cart').parent('li').addClass('fa fa-shopping-cart fa-lg');
            $('a.top-link-checkout').parent('li').addClass('fa fa-edit fa-lg');
            $('a.icon-login').parent('li').addClass('fa fa-sign-in fa-lg');
            $('a.icon-logout').parent('li').addClass('fa fa-sign-in fa-lg');
            $('.header ul.links li a[title=Blog]').parent('li').addClass('fa fa-book fa-lg');
            
            $('.qty-container')
            .on('click', '.fa-angle-up', function() {
                var 
                    $qty = $(this).siblings('input'),
                    qty = parseInt( $qty.val(), 10) + 1;
                    
                if( isValidQty(qty) ) {
                    $qty.val(qty);
                }
            })
            .on('click', '.fa-angle-down', function() {
                var 
                    $qty = $(this).siblings('input'),
                    qty = parseInt( $qty.val(), 10) - 1;
                    
                if( isValidQty(qty) ) {
                    $qty.val(qty);
                }
            });
            
            // tag reviews
            $('body.review-product-list').find('.tabNav').remove();
            
            //owl carusel
            var owlFeatures = $('.owl-carousel-features');
                owlFeatures.owlCarousel({
                    loop:false,
                    margin:28,
                    nav:false,
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        800:{
                            items:3
                        },
                        1200:{
                            items:4
                        }
                    }
                });

                // Go to the next item
                $('.prev1').click(function() {
                    owlFeatures.trigger('prev.owl.carousel');
                });

                $('.next1').click(function() {
                    owlFeatures.trigger('next.owl.carousel');
                });
 
            
            

            var owlBestsellers = $('.owl-carousel-bestsellers');
            owlBestsellers.owlCarousel({
                loop:false,
                nav:false,
                responsive:{
                    1200:{
                        items:1
                    }
                }       
            });

            // Go to the next item
            $('.prev2').click(function() {
                owlBestsellers.trigger('prev.owl.carousel');
            });

            $('.next2').click(function() {
                owlBestsellers.trigger('next.owl.carousel');
            });

            var owlBrands = $('.owl-carousel-brands');
            owlBrands.owlCarousel({
                rtl:true,
                loop:true,
                margin:12,
                nav:false,
                autoplay:true,
                responsive:{
                    0:{
                        items:1
                    },
                    330:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    900:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });

            // Go to the next item
            $('.prev-brands').click(function() {
                owlBrands.trigger('prev.owl.carousel');
            });

            $('.next-brands').click(function() {
                owlBrands.trigger('next.owl.carousel');
            });

           var owlMedia = $('.owl-carousel-media');
            owlMedia.owlCarousel({
                loop:false,
                margin:10,
                nav:false,
                autoplay:true,
                responsive:{
                    0:{
                        items:2
                    },
                    600:{
                        items:2
                    },
                    1200:{
                        items:3
                    }
                }
            });

            // Go to the next item
            $('.media-prev').click(function() {
                owlMedia.trigger('prev.owl.carousel');
            });

            $('.media-next').click(function() {
                owlMedia.trigger('next.owl.carousel');
            });
            
            // Menu toggle - RWD
            var $menuMobile = $('.menu_mobile');

            $( '.menu_icon' ).css( 'cursor', 'pointer' ).click(function() {
                $menuMobile.slideToggle( 'slow', function() {
                });
                $(this).toggleClass('clicked');
            });

            $( '.search_icon' ).css( 'cursor', 'pointer' ).click(function() {
                $('.search_mobile').toggle();
                $(this).toggleClass('clicked');
            });

            $menuMobile.find('#nav li.parent').children('a').on('click', function(e){
                $(this).siblings('ul').slideToggle('slow');
                e.preventDefault();
            });
            
            // Img in catalog from CMS
            $('.page-title')
                .next('a')
                .css({
                    'display': 'block',
                    'padding-top': '17px',
                    'padding-bottom': '17px',
                    'text-align': 'center'
                })
                .addClass('clear');
            
            var
                $boxCollateral = $('.box-collateral'),
                $boxUpSell = $('.box-up-sell'),
                $tabNav = $('ul.tabNav');

            // Product view tabs - add class
            $tabNav.find('li:first-child').addClass('tab_active');

            $tabNav.on('click', 'li', function(){
                var 
                    $this = $(this),
                    currentTab = $this.data('tab');

                $tabNav.find('li').removeClass('tab_active');
                $this.addClass('tab_active');

                $boxCollateral.each(function() {
                    var $item = $(this);

                    if( $item.data('tab') === currentTab ) {
                        $boxCollateral.hide();
                        $item.show();
                        $boxUpSell.show();
                    }
                });
            });
            
            //whislist rwd 
            var $wishlistTtable = $('#wishlist-table');

            $wishlistTtable.find('td:nth-child(1)').addClass('width-26prer');
            $wishlistTtable.find('td:nth-child(2)').addClass('width-74prer');
            $wishlistTtable.find('td:nth-child(3)').addClass('width-85prer');
        
            /* Hover product */
            $(".products-grid .item").hover(function(){
                $(this).find('.hover').stop().fadeIn(200,function(){});
                }, function(){
                    $(this).find('.hover').stop().fadeOut(200,function(){});
                });
                
            topNav();
        });
        
        function topNav(){
            var
                $nav = topNavCalculations(),
                $children = $nav.children('li.parent');

            $children.find('ul').hide();

            $nav
                .on('mouseenter', 'li.parent', function(){ 
                    var $this = $(this);

                    $this.siblings('li.parent').find('ul').hide();
                    $this.children('ul').toggle();
                })
                .on('mouseleave', 'li.parent', function() {
                    $(this).children('ul').hide();
                })
                .on('mouseenter mouseleave', ' > li > ul li', function() {
                    $(this).children('ul').toggle(); 
                });
        }

        function topNavCalculations(){
            var
                $nav = $('#nav', '#mainNav'),
                topNavWidth = $nav.width(),
                topNavHeight = $nav.outerHeight() - 4;

            $nav.find('li').find('ul')
                .width(topNavWidth)
                .css({
                    'top': topNavHeight + 'px',
                    'box-sizing': 'border-box',
                    'left': 0
                });

            return $nav;
        }
        function setTopSearch(){
            var $heightHeader = $('.search_icon').outerHeight();
            $('.form-search').css('top', $heightHeader + 'px');
        };
        
        function isValidQty(qty) {
            return qty > 0 && qty <= 10000;
        }
        
        function prepareResponsiveTable($table){
            var tableLabsls = [];

            $table.find('thead').find('th').each(function() {
                tableLabsls.push( $(this).text() );
            });

            $table.find('tbody').each(function() {
                
                $(this).find('tr').each(function() {
                    var rowIndex = 0;
                    $(this).find('td').each(function() {
                        $(this).attr('data-th', tableLabsls[rowIndex++]);
                    });
                });
                
            });
        };
    
})(jQuery, window, document);






