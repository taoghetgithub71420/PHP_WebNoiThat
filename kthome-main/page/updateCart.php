<?php
    session_start();
    include ("connect.php");
    if(isset($_POST["id"]) && isset($_POST["num"])){
    $id=$_POST["id"];
    if(isset($_SESSION["giohang"]))
    {
        $giohang=$_SESSION["giohang"];

        if(array_key_exists($id,$giohang)){
            if($_POST["num"]){
                $giohang[$id]=array(
                    'masp'=>$giohang[$id]["masp"],
                    'name'=>$giohang[$id]["name"],
                    'image'=>$giohang[$id]["image"],
                    'price'=>$giohang[$id]["price"],
                    'number'=>$_POST["num"]
                );
            }else{
                unset($giohang[$id]);
            }
            $_SESSION["giohang"]=$giohang;
        }
    }
}
?>
