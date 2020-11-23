$(document).ready(function () {
    let modal = $(".show_modal").data('modal');
    if (modal == "information") {
        $("#modal-information").modal("show");
    }
    if (modal == "password") {
        $("#modal-password").modal("show");
    }
});
