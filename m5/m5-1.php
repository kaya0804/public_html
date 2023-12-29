<!DOCTYPE html>
<html lang="ja">
<head> 
</head>
<body>

    <?php
    //DB作成
        $dsn = 'mysql:dbname=tbformDB;host=localhost';
        $user = '*******';
        $password = '*********';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = "CREATE TABLE IF NOT EXISTS tbform"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name CHAR(32),"
        . "comment TEXT,"
        . "time TEXT,"
        . "password TEXT"
        .");";
        $stmt = $pdo->query($sql);
        //新規投稿
        if(isset($_POST["name"]) && isset($_POST["com"]) && !empty($_POST["name"]) && !empty($_POST["com"]) && empty($_POST["postnumber"])){
            $name=$_POST["name"];
            $comment=$_POST["com"];
            $time=date("Y/m/d  H:i:s");
            $password=$_POST["password"];
            //DBにポストしたデータを入力
            $sql = "INSERT INTO tbform (name, comment,time,password) VALUES (:name, :comment,:time,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            //dbを表示
            $sql = 'SELECT * FROM tbform';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].',';
                echo $row['time'].',';
                echo $row['password'].'<br>';
            echo "<hr>";
            }
        }//編集
        if(isset($_POST["name"]) && isset($_POST["com"]) && !empty($_POST["name"]) && !empty($_POST["com"]) && !empty($_POST["postnumber"])){
            $id=$_POST["postnumber"];
            $sql = 'SELECT * FROM tbform';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                if($id==$row['id']){
                    $name = $_POST["name"];
                    $comment = $_POST["com"];
                    $sql = 'UPDATE tbform SET name=:name,comment=:comment WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                }
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].',';
                echo $row['time'].',';
                echo $row['password'].'<br>';
            echo "<hr>";
            }
        }
        
        //削除機能
        if(isset($_POST["dele"]) && !empty($_POST["dele"]) && isset($_POST["pass_dele"]) && !empty($_POST["pass_dele"])){
            $id=$_POST["dele"];
            $pass_dele=$_POST["pass_dele"];
            $sql = 'SELECT * FROM tbform';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                if($pass_dele==$row['password']){
                    $sql = 'delete from tbform where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $sql = 'set @n:=0';
                    $stmt = $pdo->prepare($sql);                
                    $stmt->execute();
                    $sql1 = 'update tbform set id=@n:=@n+1';
                    $stmt = $pdo->prepare($sql1);
                    $stmt->execute();
                    $sql2 = 'ALTER TABLE tbform AUTO_INCREMENT = 1';
                    $stmt = $pdo->prepare($sql2);
                    $stmt->execute();
                }
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].',';
                echo $row['time'].',';
                echo $row['password'].'<br>';
            echo "<hr>";
            }

            
        }
        //編集番号を変数に入れる部分
        elseif(isset($_POST["edit"]) && !empty($_POST["edit"]) && isset($_POST["pass_edit"]) && !empty($_POST["pass_edit"])){
            $edit=$_POST["edit"];
            $pass_edit=$_POST["pass_edit"];
            $sql = 'SELECT * FROM tbform';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                $pass_num=$row['password'];
                $id=$row['id'];
                if($pass_num==$pass_edit){
                    if($edit==$id){
                        $ex_num=$row['id'];
                        $ex_name=$row['name'];
                        $ex_com=$row['comment'];
                        $ex_pass=$row['password'];
                    }
                }
            }
        }

        
        
        
    ?>
    <form action="" method="post" >
        <input type="text" name="name" placeholder="名前" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_name;}?>">
        <input type="text" name="com" placeholder="コメント" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_com;}?>">
        <input type="password" name="password" placeholder="パスワード" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_pass;}?>">
        <input type="submit" name="submit"><br>
        <input type="text" name="dele" placeholder="削除投稿番号">
        <input type="password" name="pass_dele" placeholder="パスワード">
        <input type="submit" name="submit" value="削除"><br>
        <input type="text" name="edit" placeholder="編集対象番号">
        <input type="password" name="pass_edit" placeholder="パスワード">
        <input type="submit" name="submit" value="編集" >
        <input type="hidden" name="postnumber" value="<?php if(isset($_POST["edit"]) && !empty($_POST["edit"])){echo $ex_num;}?>">
        
    </form>
</body>
</html>
