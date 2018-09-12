const $ = require('jquery');

require('bootstrap');

$(document).ready(function(){
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        var imgPos = (scrollTop / -2 + 'px');
        $('.main-header').css('transform', 'translateY(' + imgPos + ')');
    });
});