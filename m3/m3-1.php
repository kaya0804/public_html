<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>
    <form action="" method="post" >
        <input type="text" name="name" placeholder="名前"required="required">
        <input type="text" name="com" placeholder="コメント"required="required">
        <input type="submit" name="submit">
    </form>
    <?php
        $date=date("Y年m月d日 H時i分s秒");
        
        $name=$_POST["name"];
        $com=$_POST["com"];
        $filename="mission_3-1.txt";
        if(isset($name) && isset($com)){
            $count=count(file($filename));
            $fp = fopen($filename,"a",);
            fwrite($fp,$count."<>".$name."<>".$com."<>".$date."<>"."\n");
            fclose($fp);
        }
        
    ?>    
</body>
</html>