const $ = require('jquery');
require('bootstrap');
$('document').ready(function () {
    if ($('#notification-badge').is(':visible')){
        $('#notification-badge').click(function () {
            $(this).hide();
        });
        setTimeout(function () {
            $('#notification-badge').fadeOut(3000);
        },3000);
    }
});



