<form action="http://localhost/index.php/blog/list_update/<?php echo $id?>" method="post">
    <input type="text" style="width: 800px;margin-left: 10%; margin-top: 10px" name="subject" value="<?php echo $subject?>">
    <textarea style="width: 800px; height: 500px; margin-top: 20px; margin-left: 10%" name="contents" ><?php echo $contents?></textarea><br>
    <input type="submit" class="btn btn-default" value="확인" style="margin-left: 50%">
    <input type="button" class="btn btn-default" value="취소"  onclick="location.href='http://localhost/index.php/blog'">
</form>
