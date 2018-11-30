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
});