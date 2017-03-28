<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo $global_var; //"Global variable"

//Using the 'global' keyword
function function3() {  
    global $global_var;
    $global_var = $global_var . " modified";
 }

//Using the $GLOBALS superglobal
 function function4() {
   $GLOBALS['global_var'] = $GLOBALS['global_var'] .
   " modified again";
 }

function3();  
echo $global_var; //"Global variable modified"

function4();  
echo $global_var; //"Global variable modified again"
?>
