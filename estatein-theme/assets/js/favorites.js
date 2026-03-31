jQuery(document).ready(function($){
    $('.favorite-toggle').click(function(e){
        e.preventDefault();
        var postId = $(this).data('id');
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        if (favorites.includes(postId)) {
            favorites = favorites.filter(id => id !== postId);
        } else {
            favorites.push(postId);
        }
        localStorage.setItem('favorites', JSON.stringify(favorites));
        $(this).toggleClass('active');
    });

    // On load, highlight favorites
    $('.favorite-toggle').each(function(){
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        if (favorites.includes($(this).data('id'))) {
            $(this).addClass('active');
        }
    });
});
// JS for saving favorite properties
