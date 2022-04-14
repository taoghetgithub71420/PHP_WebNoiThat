//==================Select Box quận huyện===================
$(document).ready(function () {
    $(".city").change(function () {
        var id=$(".city").val();
        $.post("tinhthanhpho.php",{id: id},function (data) {
            $(".tinh").html(data);
        })
    });
});


//===================Tiền ship=============================
$(document).ready(function () {
    $(".city").change(function () {
        var id=$(".city").val();
        $.post("phiship.php",{id: id},function (data) {
            $(".ship").html(data);

        })

    });

});


//===================Tổng tiền=============================
$(document).ready(function () {
    $(".city").change(function () {
        var id=$(".city").val();
        $.post("tongtiensauship.php",{id: id},function (data) {
            $(".tongtiensauship").html(data);

        })

    });

});
