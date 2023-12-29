<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>
    <form action="" method="post" >
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="com" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        $date=date("Y年m月d日 H時i分s秒");
        $filename="mission_3-1.txt";
        if(!empty($_POST["name"]) && !empty($_POST["com"])){
            $name=$_POST["name"];
            $com=$_POST["com"];
            $count=count(file($filename))+1;
            $fp = fopen($filename,"a",);
            fwrite($fp,$count."<>".$name."<>".$com."<>".$date."<>"."\n");
            fclose($fp);
            $li=file($filename,FILE_IGNORE_NEW_LINES);
            for($i=0; $i<count($li);$i++){
                $li_ex=explode("<>",$li[$i]);
                foreach($li_ex as $li_f){
                    echo $li_f."<br>";
                }
            }
        }
        else{
            $li=file($filename,FILE_IGNORE_NEW_LINES);
            for($i=0; $i<count($li);$i++){
                $li_ex=explode("<>",$li[$i]);
                foreach($li_ex as $li_f){
                    echo $li_f."<br>";
                }
            }
        }
        
        
        
    ?>    
</body>
</html>