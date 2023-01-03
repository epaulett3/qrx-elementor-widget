jQuery(document).ready(function($){

    
    // FOR QRX NAV MENU SCRIPT
    $('.elementor-widget-qrx-nav-menu .elementor-menu-toggle').on('click', function(){
        console.log('testing on elementor edit');
        if($(this).hasClass('elementor-active')) {
            $(this).removeClass('elementor-active');
        }else{
            $(this).addClass('elementor-active');
        }
    });
});