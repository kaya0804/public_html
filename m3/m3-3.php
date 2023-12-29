<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>
    <form action="" method="post" >
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="com" placeholder="コメント">
        <input type="text" name="dele" placeholder="削除投稿番号">
        <input type="submit" name="submit">
        <input type="submit" name="delete" value="削除">
    </form>
    <?php
        $filename="mission_3-1.txt";
        if(isset($_POST["name"]) && isset($_POST["com"]) && !empty($_POST["name"]) && !empty($_POST["com"])){
            $name=$_POST["name"];
            $com=$_POST["com"];
            $date=date("Y年m月d日 H時i分s秒");
            $filename="mission_3-1.txt";
            $count=count(file($filename));
            $fp = fopen($filename,"a",);
            fwrite($fp,$count."<>".$name."<>".$com."<>".$date."<>"."\n");
            fclose($fp);
            if(file_exists($filename)){
                $li=file($filename,FILE_IGNORE_NEW_LINES);
                for($i=0; $i<count($li);$i++){
                    $li_ex=explode("<>",$li[$i]);
                    foreach($li_ex as $li_f){
                        echo $li_f." ";
                    }
                echo "<br>";
                }
            }
        }
        elseif(isset($_POST["dele"]) && !empty($_POST["dele"])){
            $dele=$_POST["dele"];
            $filename="mission_3-1.txt";
            $count=count(file($filename))+1;
            $li=file($filename,FILE_IGNORE_NEW_LINES);
            $fp = fopen($filename,"w",);
            for($i=0;$i<count($li);$i++){
                $li_ex=explode("<>",$li[$i]);
                $POST_dele=$li_ex[0];
                if($POST_dele!=$dele){
                    if($POST_dele>$dele){
                        $li_ex[0]=$li_ex[0]-1;
                        $li_im=implode("<>",$li_ex);
                        fwrite($fp,$li_im.PHP_EOL);
                    }
                    elseif($POST_dele<$dele){
                        $li_im=implode("<>",$li_ex);
                        fwrite($fp,$li_im.PHP_EOL);
                    }
                }
            }
            fclose($fp);
        }
        elseif(file_exists($filename)){
            $li=file($filename,FILE_IGNORE_NEW_LINES);
            $count=count(file($filename));
            for($i=0; $i<count($li);$i++){
                $li_ex=explode("<>",$li[$i]);
                foreach($li_ex as $li_f){
                    echo $li_f." ";
                }
            echo "<br>";
            }
        }
    ?>
</body>
</html>