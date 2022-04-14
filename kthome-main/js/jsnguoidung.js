function DoiMatKhau(tendangnhap, matkhaucu, matkhaumoi) {
    $.ajax({
        url:"ajax/doimatkhauajax.php",
        type:"POST",
        data:{
            tendangnhap: tendangnhap,
            matkhaucu: matkhaucu,
            matkhaumoi: matkhaumoi
        },
        success:function (giatri) {
            $('#mk_thongbao').text(giatri);
        }
    });
}

function addCart(id) {
    num = parseInt($("#quanlity").val());
    $.post("addCart.php",{'id':id,'num':num},function (data,status) {
        //location.reload();
        item = data.split("-");
        $("#soluongcart").text(item[0]);

        //$("#listcart").load("cart.php #listcart");
    });
}

function updateCart(id){
    num = $("#quantityGH_" + id).val();
    $.post("updateCart.php",{'id':id,'num':num},function (data){
       location.reload();
    });
}

function deleteCart(id){
    $.post("updateCart.php",{'id':id,'num': 0},function (data){
        location.reload();
    });
}

function XoaBinhLuan(mabinhluan, masanpham) {
    $.ajax({
        url:"ajax/xoabinhluanajax.php",
        type:"POST",
        data:{
           mabinhluan: mabinhluan,
        },
        success:function (giatri) {
           alert(giatri);
           window.location='product-details-default.php?Masp='+masanpham;
        }
    });
}

function XoaBinhLuanBlog(mabinhluan, mablog) {
    $.ajax({
        url:"ajax/xoabinhluanblogajax.php",
        type:"POST",
        data:{
            mabinhluan: mabinhluan,
        },
        success:function (giatri) {
            alert(giatri);
            window.location='blog-single-sidebar-left.php?Mablog='+mablog;
        }
    });
}

function EditCommnent(mabinhluan,masanpham,noidung) {
    $.ajax({
        url:"ajax/EditComment.php",
        type:"POST",
        data:{
            mabinhluan:mabinhluan,
            noidung:noidung
        },
        success:function (giatri) {
            alert(giatri);
            window.location="product-details-default.php?Masp="+masanpham;
        }
    });

}


function DanhGiaSao(masanpham, tendangnhap, noidung) {
    $.ajax({
        url:"ajax/danhgiasaoajax.php",
        type:"POST",
        data:{
            masanpham: masanpham,
            tendangnhap: tendangnhap,
            noidung: noidung
        },
        success:function (giatri) {
            alert(giatri);
            window.location='product-details-default.php?Masp='+masanpham;
        }
    });
}