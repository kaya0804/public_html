<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-20</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str">
        <input type="submit"value="送信">
    </form>
    <?php
        $str=$_POST["str"];
        echo $str;
    ?>
</body>
</html>
