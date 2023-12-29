<?php
    $dsn = 'mysql:dbname=tb250567db;host=localhost';
    $user = 'tb-250567';
    $password = 'zAapXKE6X7';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $sql ='SHOW CREATE TABLE tbtest';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[1];
    }
    echo "<hr>";
?>