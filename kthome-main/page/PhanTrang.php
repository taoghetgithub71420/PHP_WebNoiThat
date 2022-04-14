<!-- Start Pagination -->
<div class="page-pagination text-center" data-aos="fade-up"  data-aos-delay="0">
    <ul>
        <?php
            $get_pa = "";
            if($search) {
                $get_pa = "timkiemtensp=".$search."&";
            }
        ?>
        <?php for($num =1 ; $num<= $totalpage; $num++){?>
            <?php if($num != $current_page){?>
                    <?php if($num > $current_page - 3 && $num < $current_page + 3){?>
                        <li><a style="color: black; background-color: white" class="active" href="?<?=$get_pa?>per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
                    <?php }?>
            <?php }else{?>
                <li><a class="active" href="" style="background-color: #b19361"><?=$num?></a></li>
            <?php }?>
        <?php } ?>
    </ul>
</div>
<!-- End Pagination -->

<!--<div class="page-pagination text-center" data-aos="fade-up"  data-aos-delay="0">-->
<!--    <ul>-->
<!--        --><?php
//            $get_pa = "";
//            if($search) {
//                $get_pa = "timkiemtensp=".$search."&";
//        }
//        if($current_page > 3){
//            $firs_page=1;
//            ?>
<!--                <li><a style="color: black; background-color: white" class="active" href="?--><?//=$get_pa?><!--per_page=--><?//=$item_per_page?><!--&page=--><?//=$firs_page?><!--">First</a></li>-->
<!--            --><?php
//        }
//        if($current_page > 1){
//            $prev_page = $current_page - 1;
//            ?>
<!--                <li><a style="color: black; background-color: white" class="active" href="?--><?//=$get_pa?><!--per_page=--><?//=$item_per_page?><!--&page=--><?//=$prev_page?><!--">Prev</a></li>-->
<!--        --><?php //}
//        ?>
<!--        --><?php //for($num=1;$num<=$totalpage;$num++){ ?>
<!--            --><?php //if($num != $current_page){ ?>
<!--                --><?php //if($num > $current_page -3 && $num < $current_page +3){ ?>
<!--                    <li><a style="color: black; background-color: white" class="active" href="?--><?//=$get_pa?><!--per_page=--><?//=$item_per_page?><!--&page=--><?//=$num?><!--">--><?//=$num?><!--</a></li>-->
<!--                --><?php //} ?>
<!--            --><?php //} else{ ?>
<!--                    <li><a class="active" href="" style="background-color: #b19361">--><?//=$num?><!--</a></li>-->
<!--            --><?php //} ?>
<!--        --><?php //} ?>
<!--        --><?php
//        if($current_page < $totalpage -1){
//            $next_page = $current_page + 1;?>
<!--            <li><a style="color: black; background-color: white" class="active" href="?--><?//=$get_pa?><!--per_page=--><?//=$item_per_page?><!--&page=--><?//=$next_page?><!--">Next</a></li>-->
<!--        --><?php //}
//        if($current_page < $totalpage -3){
//            $end_page = $totalpage;
//            ?>
<!--            <li><a style="color: black; background-color: white" class="active" href="?--><?//=$get_pa?><!--per_page=--><?//=$item_per_page?><!--&page=--><?//=$end_page?><!--">Last</a></li>-->
<!--        --><?php //} ?>
<!--    </ul>-->
<!--</div>-->

