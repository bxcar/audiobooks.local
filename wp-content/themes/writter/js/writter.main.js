var aMenuClicked = false;

function loaded() {

    jQuery('#sidebar-left').perfectScrollbar({
        wheelSpeed: 35,
        wheelPropagation: false,
        minScrollbarLength: 20
    });

    jQuery('#sidebar-right').perfectScrollbar({
        wheelSpeed: 35,
        wheelPropagation: false,
        minScrollbarLength: 20
    });

    var sidebarRight = jQuery("#sidebar-right").height();
    var viewport = jQuery(window).height();

    if (sidebarRight > viewport - 150) {
        jQuery("#sidebar-right").css('bottom', '35px');
        jQuery("#sidebar-right .sidebar-inner").css('padding-bottom', '20px');
    }

    jQuery(".mobile-select-menu").change(function () {
        window.location = jQuery(this).find("option:selected").val();
    });

    if ("ontouchstart" in document.documentElement) {


        jQuery(document).mouseup(function (e) {
            var container = jQuery("#sidebar-left-mobile");
            if (container.has(e.target).length === 0) {
                jQuery('#sidebar-left-mobile').css('z-index', '0').css('display', 'none');
                jQuery('#main-content').removeClass('moved-right');
                aMenuClicked = false;
            }
        });

        jQuery('#a-menu').bind('touchstart touchon', function (event) {
            if (aMenuClicked) {
                jQuery('#main-content').removeClass('moved-right');
                jQuery('#sidebar-left-mobile').css('z-index', '0').css('display', 'none');
                aMenuClicked = false;
            }
            else {
                jQuery('#main-content').addClass('moved-right');
                jQuery('#sidebar-left-mobile').css('z-index', '999').css('display', 'block');
                aMenuClicked = true;
            }
        });


    }
    else {

        jQuery(document).mouseup(function (e) {
            var container = jQuery("#sidebar-left-mobile");
            if (container.has(e.target).length === 0) {
                jQuery('#sidebar-left-mobile').css('z-index', '0').css('display', 'none');
                jQuery('#main-content').removeClass('moved-right');
                aMenuClicked = false;
            }
        });

        jQuery('#a-menu').bind('click', function (event) {
            if (aMenuClicked) {
                jQuery('#main-content').removeClass('moved-right');
                jQuery('#sidebar-left-mobile').css('z-index', '0').css('display', 'none');
                aMenuClicked = false;

            }
            else {
                // $('.menu').addClass('activeState');
                //jQuery('#sidebar-left-mobile').css("z-index", "10");
                jQuery('#main-content').addClass('moved-right');
                jQuery('#sidebar-left-mobile').css('z-index', '999').css('display', 'block');
                aMenuClicked = true;
            }
        });

    }

    jQuery('.main-navigation > ul li.menu-item-has-children .menu-li-arrow').bind('click', function (e) {
        e.preventDefault();
        if(jQuery(this).parent().parent().hasClass('opened')) {
            jQuery(this).parent().parent().removeClass('opened');
            jQuery(this).parent().parent().children("ul.sub-menu").hide(300);

        } else {
            jQuery(this).parent().parent().addClass('opened');
            jQuery(this).parent().parent().children("ul.sub-menu").show(300);

        }
    });

    jQuery('.main-navigation ul li').each(function(i,elem) {
        if (!jQuery(this).hasClass("menu-item-has-children")) {
            jQuery(this).find('.menu-li-arrow').css('display', 'none');
        }
    });


}

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(loaded, 20);
}, false);
