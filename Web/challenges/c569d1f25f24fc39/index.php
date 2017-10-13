<?php
    header("Content-Type: text/html;charset=utf-8"); 
    
    $a = 'test';
    $b = 'test2';

    $a = $_GET['a'];
    $b = $_GET['b'];

    $c = is_numeric($a) and is_numeric($b);

    if($c){
    print "flag{Flag_iS_VulnCtf}";
    }
    else{
    print "is_numeric(a) and is_numeric(b) error ！";
    }

    echo '<!--代码片段-->';
    echo '
    <!--
        $c = is_numeric($a) and is_numeric($b);
        if($c){
            print "$flag";
        }
        else{
        print "is_numeric(a) and is_numeric(b) error ！";
        }
    -->';

?>
