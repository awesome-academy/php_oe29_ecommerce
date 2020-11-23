$(document).ready(function() {
    $('.btn-size').click(function() {
        let size = $(this).val();
        $('.btn-size').css({
            'background': '#fff',
            'color': '#000'
        });
        $(this).css({
            'background': '#FE2E2E',
            'color': '#fff'
        });
        $("#quantity").val(1);
        $("#quantity").removeAttr("disabled");
        $(".quantity-right-plus").removeAttr("disabled");
        $(".quantity-left-minus").removeAttr("disabled");

        let url = $(this).attr("data-url");
        $.ajax({
            url : url,
            type : "GET",
            success : function (data) {
                let productDetail = JSON.parse(data);
                $("#quantity-size").text(productDetail.quantity);
                $("#add-size").val(productDetail.size);
            },
            error : function($data) {
                alert('Fail');
            },
            complete : function () {
                $("#btn-add").click(function() {
                    let chooseQuantity = $("#quantity").val();
                    let maxQuantity = $("#quantity-size").text();
                    if (chooseQuantity >= parseInt(maxQuantity)) {
                        $("#btn-add").attr("disabled", true);
                    }
                });

                $("#btn-sub").click(function() {
                    let chooseQuantity = $("#quantity").val();
                    let maxQuantity = $("#quantity-size").text();
                    if (chooseQuantity < maxQuantity) {
                        $("#btn-add").attr("disabled", false);
                    }
                });
            }
        });
    });

    let quantitiy = 0;
    $('.quantity-right-plus').click(function(e) {
        e.preventDefault();
        let quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });

    $('.quantity-left-minus').click(function(e) {
        e.preventDefault();
        let quantity = parseInt($('#quantity').val());
        if (quantity > 0) {
            $('#quantity').val(quantity - 1);
        }
    });

    $(".list-image").click(function() {
        let src = $(this).attr("src");
        $("#image-show").attr("src", src);
    });
});

function trans(key, replace = {}) {
    let translation = key.split('.').reduce((t, i) => t[i] || null, JSON.parse(translations));

    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }

    return translation;
}

$(document).on("submit", ".add-to-cart", function () {
    if (parseInt($("#quantity-size").text()) > 0) {
        return true;
    }
    alert(trans('message_cart'));

    return false;
});
