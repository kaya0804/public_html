<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>

    <?php
        //新規投稿
        if(isset($_POST["name"]) && isset($_POST["com"]) && !empty($_POST["name"]) && !empty($_POST["com"]) && empty($_POST["postnumber"])){
            $name=$_POST["name"];
            $com=$_POST["com"];
            $date=date("Y年m月d日 H時i分s秒");
            $filename="mission_3-1.txt";
            $count=count(file($filename))+1;
            $fp = fopen($filename,"a",);
            fwrite($fp,$count."<>".$name."<>".$com."<>".$date."<>"."\n");
            fclose($fp);
            if(file_exists($filename)){
                $li=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($li as $line){
                    echo "<br>";
                    $li_ex=explode("<>",$line);
                    foreach($li_ex as $li_f){
                        echo $li_f." ";
                    }
                }
            }
        }
        if(isset($_POST["name"]) && isset($_POST["com"]) && !empty($_POST["name"]) && !empty($_POST["com"]) && !empty($_POST["postnumber"])){
            $edit_num=$_POST["postnumber"];
            $filename="mission_3-1.txt";
            $li=file($filename,FILE_IGNORE_NEW_LINES);
            $fp = fopen($filename,"w",);
            for($i=0;$i<count($li);$i++){
                $li_ex=explode("<>",$li[$i]);
                $POST_edit=$li_ex[0];
                if($POST_edit!=$edit_num){
                    $li_im=implode("<>",$li_ex);
                    fwrite($fp,$li_im.PHP_EOL);
                }
                if($POST_edit==$edit_num){
                    $li_ex[1]=$_POST["name"];
                    $li_ex[2]=$_POST["com"];
                    $li_im=implode("<>",$li_ex);
                    fwrite($fp,$li_im.PHP_EOL);
                }
            }
            fclose($fp);
            if(file_exists($filename)){
                $li=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($li as $line){
                    echo "<br>";
                    $li_ex=explode("<>",$line);
                    foreach($li_ex as $li_f){
                        echo $li_f." ";
                    }
                }
            }
        }
        
        //削除機能
        if(isset($_POST["dele"]) && !empty($_POST["dele"])){
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
            if(file_exists($filename)){
                $li=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($li as $line){
                    echo "<br>";
                    $li_ex=explode("<>",$line);
                    foreach($li_ex as $li_f){
                        echo $li_f." ";
                    }
                }
            }
        }
        //編集番号を変数に入れる部分
        elseif(isset($_POST["edit"]) && !empty($_POST["edit"])){
            $edit=$_POST["edit"];
            $filename="mission_3-1.txt";
            $li=file($filename,FILE_IGNORE_NEW_LINES);
            $fp = fopen($filename,"a",);
            $count = count(file($filename)) + 1;
            for($i=0;$i<count($li); $i++){
                $li_ex=explode("<>",$li[$i]);
                $POST_edit=$li_ex[0];
                if($edit==$POST_edit){
                    $ex_num=$li_ex[0];
                    $ex_name=$li_ex[1];
                    $ex_com=$li_ex[2];
                }
            }
            if(file_exists($filename)){
                $li=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($li as $line){
                    echo "<br>";
                    $li_ex=explode("<>",$line);
                    foreach($li_ex as $li_f){
                        echo $li_f." ";
                    }
                }
            }
        }
        
        
        
    ?>
    <form action="" method="post" >
        <input type="text" name="name" placeholder="名前" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_name;}?>">
        <input type="text" name="com" placeholder="コメント" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_com;}?>">
        <input type="text" name="dele" placeholder="削除投稿番号">
        <input type="text" name="edit" placeholder="編集対象番号">
        <input type="submit" name="submit">
        <input type="submit" name="submit" value="削除">
        <input type="submit" name="submit" value="編集" >
        <input type="hidden" name="postnumber" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_num;}?>">
        
    </form>
</body>
</html>