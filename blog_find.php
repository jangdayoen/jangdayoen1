<table class="table table-striped table-hover"
       style="width: 100%; text-align: center; border-top: 1px solid black;border-bottom: 1px solid black; border-collapse: collapse;">
    <thead>
    <tr style="align-content: center; border-bottom: 1px solid black; padding: 10px">
        <td style="width: 10%">
            <?php echo "번호"; ?>
        </td>
        <td style="width: 30%">
            <?php echo "제목"; ?>
        </td>
        <td style="width: 15%">
            <?php echo "작성자"; ?>
        </td>
        <td style="width: 30%">
            <?php echo "날짜"; ?>
        </td>
        <td style="width: 10%">
            <?php echo "조회수"; ?>
        </td>
    </tr>
    </thead>
    <?php foreach ($result as $list) { ?>
        <tr style="align-content: center; cursor:pointer;"
            onclick="location.href = 'http://localhost/index.php/blog/look/<?php echo $list['board_id']; ?>'">
            <td style="width: 10%">
                <?php echo $list['board_id']; ?>
            </td>
            <td style="width: 30%">
                <?php echo $list['subject']; ?>
            </td>
            <td style="width: 15%">
                <?php echo $list['user_name']; ?>
            </td>
            <td style="width: 30%">
                <?php echo $list['reg_date']; ?>
            </td>
            <td style="width: 10%">
                <?php echo $list['hits']; ?>
            </td>
        </tr>
    <?php } ?>
</table>

<table align="center">
    <tr>
        <?php for ($i = $first; $i <= $last; $i++) {
            if ($nowPage == $i) {
                ?>
                <td class="btn btn-default btn-sm" style="cursor:pointer; color: red"
                    onclick="location.href='http://localhost/index.php/blog/search_page/<?php echo $i ?>'"><?php echo $i ?></td>
            <?php } else {
                ?>
                <td class="btn btn-default btn-sm" style="cursor:pointer;"
                    onclick="location.href='http://localhost/index.php/blog/search_page/<?php echo $i ?>'"><?php echo $i ?></td>
            <?php }
        } ?>
    </tr>
</table>
<div align="center" style="margin-top: 5px">
    <?php if (isset($_SESSION['id'])) { ?>
        <input type="button" class="btn btn-default" value="글쓰기" onclick="location.href = 'http://localhost/index.php/blog/write'">
    <?php } else { ?>
        <input type="button" class="btn btn-default" value="글쓰기">
    <?php } ?>
    <input type="button" class="btn btn-default" onclick="location.href='http://localhost/index.php/blog'" value="리스트보기">
</div>

