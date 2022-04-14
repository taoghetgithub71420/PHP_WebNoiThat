<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        <?php
            $get_pa = "";
            if($search) {
                $get_pa = "city=".$search."&";
            }
        ?>
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <?php for($num = 1 ; $num <= $totalpage; $num++){ ?>
            <?php if($num != $current_page){?>
                <?php if($num > $current_page - 3 && $num < $current_page + 3){?>
                    <li class="page-item"><a class="page-link" href="?<?=$get_pa?>per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
                <?php }?>
            <?php }else{?>
                <li class="page-item active"><a class="page-link" href=""><?=$num?></a></li>
            <?php }?>
         <?php } ?>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
</div>
