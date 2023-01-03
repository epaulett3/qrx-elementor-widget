(function ($) {
    // SCRIPT FOR QRX NAV MENU WIDGET
    const QRxNavMenu = function ($scope, $) {
        // js code where $scope is your element from widget above
        // console.log($scope.find('.elementor-menu-toggle'));
        $scope.find('.elementor-menu-toggle').on('click', function(){
            // console.log('testing on elementor edit');
            if($(this).hasClass('elementor-active')) {
                $(this).removeClass('elementor-active');
            }else{
                $(this).addClass('elementor-active');
            }
        });
        
    };

    // initialize custom function to elementor frontend
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/qrx-nav-menu.default', QRxNavMenu);
    })
})(jQuery);