(function($){
    function render_map($el) {
        var $markers = $el.find('.marker');
        var args = {
            zoom: 14,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map($el[0], args);
        $markers.each(function(){
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map
            });
            map.setCenter(marker.position);
        });
    }
    $(document).ready(function(){
        $('.acf-map').each(function(){
            render_map($(this));
        });
    });
})(jQuery);
