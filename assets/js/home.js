$('document').ready(function () {

    let deleteTrickBtn = $('.trick-card #del-trick-btn');

    // On click delete trick button, message to confirm.
    deleteTrickBtn.click(function (e) {
        e.preventDefault();
        let bta = $(this).attr('btn-action');
        $('#popin-delete-trick-btn').attr('href', bta);
        $('#delete-trick').modal('show');
    });

    $('[data-toggle="tooltip"]').tooltip();

    // On window scroll animate parallax bg image & animate title page.
    window.addEventListener('scroll', function (e) {
        let windowScrollTop = this.scrollY;
        let imgPos = (windowScrollTop / -2 + 'px');
        let titlePos = (windowScrollTop / -1 + 'px');

        document.getElementById('main-header').style.transform = "translate(0, " + imgPos + ")";
        document.getElementById('header-title').style.transform = "translate(" + titlePos + " ,0)";

    });

    $(".trick-card").slice(0, 8).css({'display': 'inline-block'});

    $(".load-more-btn").on('click', function (e) {
        e.preventDefault();
        $('#load-more-loading').show();
        $('#load-more-plus').hide();
        setTimeout(function(){
        $(".trick-card:hidden").slice(0, 4).css({'display': 'inline-block'});
            $('#load-more-loading').hide();
            $('#load-more-plus').show();


        }, 600);
        if ($(".trick-card:hidden").length == 0) {
            $(".load-more-btn").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 600);


    });

    $('#scroll-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 200);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $('#scroll-top').fadeIn();
        } else {
            $('#scroll-top').fadeOut();
        }
    });
});
