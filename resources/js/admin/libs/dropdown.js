(function($) {
    "use strict";

    $('body').on('click', function(event) {
        let dropdown = $(event.target).closest('.dropdown')
        if (!$(dropdown).length || ($(event.target).closest('.dropdown-toggle').length && $(dropdown).find('.dropdown-menu').first().hasClass('show'))) {
            $('.dropdown-menu').removeClass('show')
        } else {
            $('.dropdown-menu').removeClass('show')
            $(dropdown).find('.dropdown-menu').first().addClass('show')
        }
    })
})($)
