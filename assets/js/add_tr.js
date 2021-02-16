$('document').ready(function () {

// Add-trick page

    // Generate today date fr format
    toDay();


    // On click add-image btn
    $('.add-image-btn').click(function (e) {
        e.preventDefault();
        let inputImages = $(this).prev().children('div').children('input');
        inputImages.click();
        inputImages.change(function () {
            readURL(this);
        });

    });


    function readURL(input) {
        let files = input.files;
        for (var i = 0; i < files.length; i++) { //for multiple files
            (function (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    // Hide the default image
                    $('#default-img').hide();
                    // Get the img component HTML content
                    let imgComponent = $('#components #img-component').html();
                    // Replace the image source
                    let newImg = imgComponent.replace('my-image', e.target.result);
                    // create the new element image
                    $('.list-tricks-images').append(newImg);
                }
                reader.readAsDataURL(file);
            })(files[i]);
        }

    }

    $('.add-video-btn').click(function (e) {
        e.preventDefault();

        let countInputs = ($('.component:hidden').length) + 1;
        $('.input-video-component_' + (countInputs-1)).hide(1,function () {
            let inputContent = $(this).children('input').val();
            let embedUrl = generateEmbed(inputContent);

            if (embedUrl){

                console.log(countInputs);
                $('.input-videos-block').append('<div class="input-group mb-3 input-video-component_' + countInputs + ' component">\n' +
                    '                <div class="input-group-prepend">\n' +
                    '                    <span class="input-group-text" id="basic-addon3">Url youtube ou Dailymotion</span>\n' +
                    '                </div>\n' +
                    '                <input type="text" class="form-control" id="add_trick_videos_' + countInputs + '"\n' +
                    '                       name="add_trick[videos][' + countInputs + ']">\n' +
                    '                <div class="col-12"></div>\n' +
                    '            </div>');


                $('.view-videos-block').append('<div class="mt-4 col-sm-12 col-md-6 col-lg-6" style="display: inline-block;min-height: 400px">\n' +
                    '                <div class="mt-2 col-12" style="height: 100%;">\n' +
                    '                    <iframe width="100%" height="100%"\n' +
                    '                            src="'+ embedUrl +'">\n' +
                    '                    </iframe>\n' +
                    '                </div>\n' +
                    '                <div class="mt-2 col-12">\n' +
                    '                    <a class="btn btn-primary delete-media-btn delete-media-video-btn" href="javascript:void(0)"\n' +
                    '                       btn-action="" role="button" data-toggle="modal"\n' +
                    '                       data-target="#delete-media" style="margin-top:-70px"><i class="far fa-trash-alt"></i></a>\n' +
                    '                </div>\n' +
                    '            </div>');
            }else{
                $(this).show(1);

            }

        });

    });


    function generateEmbed(videoSrc){
        let regexYoutube = /youtube/g;
        let regexDailymotion = /dailymotion/g;
        let youtube = videoSrc.match(regexYoutube);
        let dailymotion = videoSrc.match(regexDailymotion);


        if (videoSrc && youtube) {

            let finalYoutube = videoSrc.replace("watch?v=", "embed/");
            return finalYoutube;
        } else if (videoSrc && dailymotion) {
            let finalDailymotion = videoSrc.replace("video", "embed/video");
            return finalDailymotion;
        } else {
            alert('erreur video');
            return false;

        }
    }


    function toDay() {
        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1; //January is 0!
        let yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = dd + '/' + mm + '/' + yyyy;
        $('#to-day').html(today);
    }
});