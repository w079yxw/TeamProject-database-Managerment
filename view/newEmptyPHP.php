<?php


//Using the 'global' keyword
$a=0;
echo  $_SESSION["num"];
echo $num;
switch($a){
     case 0:
         f(2);
         $_SESSION["num"]=2;
         break;
     case 1:
         $GLOBALS['number'];
         break;
     
 }
function f($num){
    
    
    $GLOBALS['number']=$num;
}
?>
