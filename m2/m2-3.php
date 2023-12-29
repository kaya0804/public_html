<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>
    <form action="" method="post" >
        <input type="text" name="str" placeholder="コメント"required="required">
        <input type="submit" name="submit">
    </form>
    <?php
        $str=$_POST["str"];
        $filename="mission_2-3.txt";
        $fp = fopen($filename,"a","¥n");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
    ?>    
</body>
</html>