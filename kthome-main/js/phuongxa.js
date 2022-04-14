//==================Select Box phường xã===================
$(document).ready(function () {
    $(".tinh").change(function () {
        var id=$(".tinh").val();
        $.post("phuongxa.php",{id: id},function (data) {
            $(".quan").html(data);
        })
    });
});
