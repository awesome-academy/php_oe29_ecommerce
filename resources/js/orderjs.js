$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
})

$(document).on("click", ".order", function () {
    $(".loader").show();
    let td = $(this);
    let url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        url : url,
        type : "GET",
        success : function (data) {
            $(".loader").hide();
            $("#detail-Order").html(data);
            $("#detail-Order").modal("show");
        },
        error : function (data) {
            $(".loader").hide();
            alert("Product not exists");
        },
        complete : function () {
            $(".approved-order").click(function () {
                let url = this.getAttribute('data-url');
                $.ajax({
                    url : url,
                    type: "PATCH",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function (response) {
                        let data = JSON.parse(response);
                        alert(data.message);
                        $(".status-order div").each(function (){
                            if ($(this).data('id') == data.id) {
                                $(this).removeClass();
                                $(this).addClass("alert alert-info");
                                $(this).text(data.approved);
                            }
                        });
                        $("#detail-Order").modal('hide');
                       },
                       error : function (data) {
                           alert("not working");
                           $("#detail-Order").modal('hide');
                       }
                    });
                });

            $(".rejected-order").click(function () {
                let check = confirm("rejected ???");
                if (check == true) {
                    let url = this.getAttribute('data-url');
                    $.ajax({
                        url : url,
                        type : "PATCH",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function (response) {
                            let data = JSON.parse(response);
                            alert(data.message);
                            $(".status-order div").each(function (){
                                if ($(this).data('id') == data.id) {
                                    $(this).removeClass();
                                    $(this).addClass("alert alert-danger");
                                    $(this).text(data.rejected);
                                    $("#detail-Order").modal('hide');
                                }
                            });
                        },
                        error : function (data) {
                            alert('not working');
                            $("#detail-Order").modal('hide');
                        }
                    });
                }
            });
        }
    });
});

$(document).ready(function () {
    var audio = new Audio('http://localhost:8000/bower_components/bower_project1/admin/sound/thongbao.mp3 ');
    audio.play();
});
