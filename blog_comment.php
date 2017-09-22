<table style="text-align: center">
    <tr style="width: 90%; ">
        <td style="width:8%;">작성자</td>
        <td style="width:68%">내용</td>
    </tr>
    <?php foreach ($result as $list){
        $_SESSION['comment_date'] = $list['date']; ?>
    <tr>
        <td><?php echo $list['user_name']?></td>
        <td><?php echo $list['contents']?></td>
        <td><input class="btn btn-default" type="button" value="삭제" onclick="location.href='http://localhost/index.php/blog/comment_delete/<?php echo $_SESSION['board_id']?>'" </td>
    </tr>
<?php }
if (isset($_SESSION['name'])) {?>


    <tr>
        <td> <?php echo $_SESSION['name'] ?> </td>
<form action="http://localhost/index.php/blog/comment/<?php echo $_SESSION['board_id']; ?>" method="post">
    <td><input type="text" name="comment" style="width: 760px;"></td>
    <td><input class="btn btn-default" type="submit" value="입력"></td>
</form>
</tr>
</table>

<?php
}
?>
