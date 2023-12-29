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
        $filename="mission_2-2.txt";
        $fp = fopen($filename,"a");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
        if($str=="完成！"){
            echo "おめでとう！";
        }
    ?>    
</body>
</html>