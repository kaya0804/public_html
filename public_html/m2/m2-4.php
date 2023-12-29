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
        $filename="mission_2-4.txt";
        $fp = fopen($filename,"a",);
        fwrite($fp, $str."\n");
        fclose($fp);
        $list=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($list as $line){
            if(!empty($line)){
            echo "おめでとう！ by".$line."<br>";
            }
        }
    ?>    
</body>
</html>