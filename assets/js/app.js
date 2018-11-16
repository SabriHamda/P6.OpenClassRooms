//const $ = require('jquery');

require('bootstrap');

$('document').ready(function () {

    let message =  $('.custom-error .invalid-feedback .form-error-message').html();
    if(message){
        $('.custom-error').append('<span class="invalid-feedback d-block"><span class="d-block">\n' +
            '                    <span class="form-error-icon badge badge-danger text-uppercase">Erreur</span> <span class="form-error-message">'+ message +'</span>\n' +
            '                </span></span>')
    }



//Page add-trick,detect origin of embed videos, show preview of video
    $('.view-video-btn').click(function () {
        let videoAttr = $(this).attr('data-video');
        let videoSrc = $(this).parent('div').children('input').val();

        let regexYoutube = /youtube/g;
        let regexDailymotion = /dailymotion/g;
        let youtube = videoSrc.match(regexYoutube);
        let dailymotion = videoSrc.match(regexDailymotion);


        if (videoSrc && youtube) {

            let finalYoutube = videoSrc.replace("watch?v=", "embed/");
            $('.preview-video-' + videoAttr).attr('src', finalYoutube);
        } else if (videoSrc && dailymotion) {
            let finalDailymotion = videoSrc.replace("video", "embed/video");
            $('.preview-video-' + videoAttr).attr('src', finalDailymotion);
        } else {
            $('.preview-video-' + videoAttr).attr('src', 'img/default/default-video.jpg');

        }

    });


//Close message popin on click close btn
    function hide(elements) {
        elements = elements.length ? elements : [elements];
        for (let index = 0; index < elements.length; index++) {
            elements[index].style.display = 'none';
        }
    }

    $('[data-toggle="tooltip"]').tooltip();


});


