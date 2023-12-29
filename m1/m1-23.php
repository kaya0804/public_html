<?php
    $name=array("Ken","Alice","Judy","BOSS","Bob");
    foreach($name as $name_1){
        if($name_1=="BOSS"){
            echo "Good　morning".$name_1."!"."<br>";
        }
        else{
            echo "Hi!".$name_1."<br>";
        }
    }