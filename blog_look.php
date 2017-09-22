<?php
foreach ($result as $list) {
    $_SESSION['board_id'] = $list['board_id'];
    ?>

    <table style="width: 100%; text-align: center; border-top: 1px solid black; border-collapse: collapse;">
        <tr style="align-content: center; border-bottom: 1px solid black; padding: 10px">
            <td style="width: 60%">
                <?php echo $list['subject'] ?>
            </td>
            <td style="width: 10%">
                <?php echo $list['user_name'] ?>
            </td>
            <td style="width: 20%">
                <?php echo $list['reg_date'] ?>
            </td>
            <td style="width: 5%">
                <?php echo $list['hits'] ?>
            </td>
        </tr>
    </table>

    <div style="align-content: center; width: 100%; height: 450px; border: solid; margin-top: 2%;">
        <?php
        echo $list['contents'];
        ?>
    </div>
    <div align="center" style="margin-top: 10px">
        <?php if (isset($_SESSION['id'])) {
            if ($list['user_id'] == $_SESSION['id']) {
                ?>
                <input type="button" value="수정" class="btn btn-default"
                       onclick="location.href='http://localhost/index.php/blog/update/<?php echo $list['board_id']; ?>'">
                <input type="button" value="삭제" class="btn btn-default"
                       onclick="location.href='http://localhost/index.php/blog/delete/<?php echo $list['board_id']; ?>'">
            <?php }
        } ?>
        <input type="button" class="btn btn-default" value="리스트보기" onclick="location.href='http://localhost/index.php/blog'">
    </div>
    <?php
}
?>
