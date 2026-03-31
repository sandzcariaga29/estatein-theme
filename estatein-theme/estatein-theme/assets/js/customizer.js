(function($){
    wp.customize('theme_color', function(value){
        value.bind(function(to){
            document.documentElement.style.setProperty('--primary-color', to);
        });
    });
})(jQuery);
