const $ = require('jquery');

require('bootstrap');

$(document).ready(function(){
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        var imgPos = (scrollTop / -2 + 'px');
        var titlePos = (scrollTop / -1 + 'px');

        $('.main-header').css('transform', 'translateY(' + imgPos + ')');
        $('.header-title').css('transform', 'translateX(' + titlePos + ')');

    });
});