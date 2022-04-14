
<?php
    include ('connect.php');
    $key = $_POST["id"];
    $sql = "SELECT * FROM quanhuyen WHERE matp = '".$key."'";
    $laytp = mysqli_query($conn, $sql);
    $numtp = mysqli_num_rows($laytp);
    if($numtp > 0) {?>
        <select class="nice-select wide tinh" name="district" id="district" style="position: absolute;width: 690px;left: -3px;top: -1px" >
            <?php
            while ($row = mysqli_fetch_array($laytp)){
                ?>
                <option value="<?php echo $row["maqh"]?>"><?php echo $row["name_quanhuyen"]?></option>
            <?php }?>
        </select>
    <?php }?>
