<?php
    $str = "こんにちは";
    $filename="mission_1-25.txt";
    $fp = fopen($filename,"a");
    fwrite($fp, $str.PHP_EOL);
    fclose($fp);
    echo "書き込み成功！"."<br>";
    if(file_exists($filename)){
        $li=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($li as $line){
            echo $line."<br>";
        }
    }

?>