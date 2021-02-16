$('document').ready(function () {

// Update-trick page

    const uploadViedoIcon = $('#upload-video-plus');
    const loadingVideoIcon = $('#upload-video-loading');
    const uploadImgIcon = $('#upload-img-plus')
    const loadingImgIcon = $('#upload-img-loading');

    $('#close-form-errors-popin').click(function (e) {
        location.reload();
    });

    $('[data-toggle="tooltip"]').tooltip();


    // Popin onclick delete media button
    $('#delete-media #popin-delete-media-btn').click(function () {
        let rmPath = ($(this).attr('data-img-id'));
        $.ajax({
            type: "POST",
            url: rmPath,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                $('.modal,.modal-backdrop').hide();
                location.reload();

            }
        });
    });

    // Add btn action to popin delete-media
    $('.delete-media-btn').click(function (e) {
        e.preventDefault();
        let bta = $(this).attr('btn-action');
        $('#delete-media #popin-delete-media-btn').attr('data-img-id', bta);
    });

    // On click add-image btn
    $('#add-image-btn').click(function (e) {
        e.preventDefault();
        $('#update_trick_image').click();
    });

    // Onload files -> submit form
    $('#update_trick_image').change(function () {
        uploadImgIcon.hide();
        loadingImgIcon.show();
        let form = $('form')[0];
        let data = new FormData(form);
        let path = window.location.pathname;
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: path,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                let obj = jQuery.parseJSON(response);
                let errors = obj.error;
                let jsonErrors = jQuery.parseJSON(errors);
                if (jsonErrors[0]) {
                    uploadImgIcon.show();
                    loadingImgIcon.hide();
                    $('#form-errors-popin').modal('show');
                    errorsTable = jQuery.parseJSON(errors);
                    let i;
                    for (i = 0; i < errorsTable.length; i++) {
                        //console.log(errorsTable[i].message);
                        $('#form-errors-popin #error-message').append('<span class="badge badge-danger">erreur</span><p>' + errorsTable[i].message + '</p>');
                    }
                    $('#close-form-errors-popin').click(function (e) {
                        location.reload();
                    })

                } else {
                    let newPath = '/update-trick/' + obj.slug;
                    if (path === newPath) {
                        location.reload();
                    } else {
                        location.href = newPath;
                    }
                }
            }
        }, 'JSON');
    });

    // On click add video
    $('#add-video-btn').click(function (e) {
        e.preventDefault();
        uploadViedoIcon.hide();
        loadingVideoIcon.show();
        let videoContent = $(this).parent('div').children('input').val();
        if (videoContent) {
            let form = $('form')[0];
            let data = new FormData(form);
            let path = window.location.pathname;
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: path,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (response) {
                    let obj = jQuery.parseJSON(response);
                    let errors = obj.error;
                    let jsonErrors = jQuery.parseJSON(errors);
                    if (jsonErrors[0]) {
                        uploadImgIcon.show();
                        loadingImgIcon.hide();
                        $('#form-errors-popin').modal('show');
                        errorsTable = jQuery.parseJSON(errors);
                        let i;
                        for (i = 0; i < errorsTable.length; i++) {
                            //console.log(errorsTable[i].message);
                            $('#form-errors-popin #error-message').append('<span class="badge badge-danger">erreur</span><p>' + errorsTable[i].message + '</p>');
                        }
                        $('#close-form-errors-popin').click(function (e) {
                            location.reload();
                        });
                    } else {
                        let newPath = '/update-trick/' + obj.slug;
                        if (path === newPath) {
                            location.reload();
                        } else {
                            location.href = newPath;
                        }
                    }
                }
            }, 'JSON');
        } else {
            uploadViedoIcon.show();
            loadingVideoIcon.hide();
            $('#form-errors-popin').modal('show');
            $('#form-errors-popin #error-message').append('<span class="badge badge-danger">erreur</span><p>Veuillez saisir l\'url de votre video.</p>');
        }
    });



});