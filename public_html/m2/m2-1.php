<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>
    <form action="" method="post" >
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        $str=$_POST["str"];
        echo $str."を受け付けました";
    ?>    
</body>
</html>