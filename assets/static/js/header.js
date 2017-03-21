$(document).ready(function () {









var start_on_small = false;
if ($('body').width() + 17 < 992){
    start_on_small = true;
}


$('.header_menu .header_button').each(function(){
    var temp = $(this).attr('href').split('/');
    temp = new RegExp(temp[1] + '/' + temp[2] + '/' + temp[3]);
    if ( temp.test(address1) ) {
        $(this).addClass('active');
    } else {
        $(this).removeClass('active');
    }
});










/*
 *   Create Header_Menu Dropdown
 *
 *   @var header_menu_nav_items
 */

function header_menu_fun() {

    if ( $('body').width() + 17 > 992 && start_on_small == true){
        start_on_small = false;
        var count = 0;
        for (var i = 0; i < header_menu_nav_items.length; i++) {
            if ( header_menu_nav_items[i].class == "header_button dropdown-button") {
                count += 1;
            }
        }
        header_menu_nav_items.splice(0,count);
    }

    /*
     *  Show header_menu block
     */

    $('.header_menu').animateCss('fadeIn');
    $('.header_menu').css('opacity','1');


    /*
     *  Call 'header_menu_fun' for creating header_menu and navleft elements
     */
    var header_menu_nav_items = create_header_menu_elements();
    header_menu_fun();



    /*
     *  Window Resize Function
     *
     *  Call 'header_menu_fun' for updating elements in header_menu and navleft
     */

    $(window).resize(function(){

        header_menu_fun();

    });

    /*
     *  Open header_menu on tablet and mobile versions
     */

    $('#open_header_menu').click(function(){
        if ( ! $('.jumbotron_nav').hasClass('open') && ! $('.header_menu').hasClass('open') ) {
            $('body').addClass('hidden').append('<div class="backdrop"></div>');
        }
        $('.jumbotron_nav').removeClass('open');
        $('.header_menu').addClass('open');
    });



    /*
     *  Open jumbotron_nav on mobile versions
     */

    $('#open_jumbotron_nav').click(function(){
        if ( ! $('.jumbotron_nav').hasClass('open') && ! $('.header_menu').hasClass('open') ) {
            $('body').addClass('hidden').append('<div class="backdrop"></div>');
        }
        $('.header_menu').removeClass('open');
        $('.jumbotron_nav').addClass('open');
    });


    /*
     *  Close header_menu && jumbotron_nav
     */

    $('body').on('click', '.backdrop', function(){
        $('body').removeClass('hidden').removeClass('mobile-open');
        $('.header_menu').removeClass('open');
        $('.jumbotron_nav').removeClass('open');
        $(this).remove();
    });


    /*
     *  Header On hover open/close
     */
    $('.header_menu-dropdown').mouseover(function () {
        $(this).addClass('open');
    });
    $('.header_menu-dropdown').mouseout(function () {
        $(this).removeClass('open');
    });



    /*
     *  Vars
     */
    var
        header_menu_width = $('.header_menu').width(), // curent width of header_menu
        header_menu_nav_width = 80,  // width of header_menu_elements,  65 - min width for last element
        header_menu_elements = '',  // elements which shows in header_menu
        header_menu_dropdown = '',  // header_dropdown block
        header_menu_dropdown_elements = '', // elements which shows in header_dropdown block
        header_menu_dropdown_pull_right,  // for style - right: __px
        seperator = '',
        temp = true;  // temp - boolean for seperate elements from header_menu_nav_items to header_menu_elements and header_menu_dropdown_elements


    $('.header_menu').empty();

    /*
     * Add quick navigation on mobile vetsion
     */
    if ( $('body').width() + 17 < 681 ){
        var
            dropdown_global = '',
            temp;

        $('.header_menu-dropdown .dropdown-menu .header_button').each(function(){
            dropdown_global = dropdown_global +'<a href="' + $(this)[0]['href'] + '" class="' + $(this)[0]['className'] + '">' + $(this).html() + '</a>';
        });

        if (dropdown_global != "") {
            $('.header_menu').append('<p class="header_text header_text-title">Быстрая навигация</p><div class="divider"></div>' + dropdown_global);
        } else {
            $('.header_menu').append('<p class="header_text header_text-title">Быстрая навигация</p><div class="divider"></div>');
            $('.header_menu').append($('.header_menu-dropdown > .header_button')[0]);
        }

    }


    /*
     *  Creating header_menu_elements and header_menu_dropdown_elements
     */

    for (var i = 0; i < header_menu_nav_items.length; i++) {

        if ( temp && (header_menu_nav_width + header_menu_nav_items[i].width) < header_menu_width) {
            header_menu_nav_width = header_menu_nav_width + header_menu_nav_items[i].width;
            header_menu_elements = header_menu_elements + '<a href="' + header_menu_nav_items[i].href + '" class="' + header_menu_nav_items[i].class + '">' + header_menu_nav_items[i].html + '</a>';
        }

        else{
            temp = false;
            var temp_span = $.trim(header_menu_nav_items[i].html);
            header_menu_dropdown_elements = header_menu_dropdown_elements + '<a href="' + header_menu_nav_items[i].href + '" class="' + header_menu_nav_items[i].class + ' dropdown-button">' + temp_span.substr(0,24) + ' dropdown-text' + temp_span.substr(24,temp_span.length) + '</a>';
        }

    }

    if ($('body').width() + 17 > 992){
        /*
         *  Add pull-right width for header_menu_dropdown_pull_right
         *
         *  @var header_menu_width
         *  @var header_menu_nav_width
         */

        header_menu_dropdown_pull_right = header_menu_width - header_menu_nav_width;


        /*
         *  Checking header_menu_dropdown_elements for empty
         *
         *  @var header_menu_dropdown_elements
         */

        if (header_menu_dropdown_elements != '') {

            header_menu_dropdown = '<div class="dropdown"><a id="header_menu_dropdown" class="header_button dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="header_text">Ещё</span><i class="fa fa-caret-down header_icon" aria-hidden="true"></i></a><div class="dropdown-menu pull-right" style="right:' + header_menu_dropdown_pull_right + 'px" aria-labelledby="header_menu_dropdown">' + header_menu_dropdown_elements + '</div></div>';

        }

        $('.header_menu').append(header_menu_elements + header_menu_dropdown);

    } else {

        if ( header_menu_elements != "" || header_menu_dropdown_elements != "") {
            $('.header_menu').append('<p class="header_text header_text-title">Навигация</p><div class="divider"></div>' + header_menu_elements + header_menu_dropdown_elements);
        }

        if ( $('.header_menu-dropdown .header_auth').hasClass('header_auth') && $('body').width() + 17 < 992 ) {
            $('.header_menu').append('<a class="header_global header_button" data-toggle="modal" data-target="#auth_modal"">Авторизация</a>');
        }

    }

}



/*
 *  Create Header Menu Elements
 *
 *  @var header_menu_nav_items  -  array of header_menu elements
 *  @var temp
 */
function create_header_menu_elements() {

    var
        temp_header_menu_nav_items = [],
        temp;


    /*
     *  Create header_menu_nav_items array
     */

    $('.header_menu .header_button').each(function(){

        temp = {
            html: $(this).html(),
            href: $(this)[0]['href'],
            class: $(this)[0]['className'],
            width: $(this).width() + 36
        }

        temp_header_menu_nav_items.push(temp);

    });

    return temp_header_menu_nav_items;

}

});