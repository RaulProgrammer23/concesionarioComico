<?php
require_once "datos.inc";

function addCompra($matricula){
    global $listado2;
    $r = false;
    if(!is_dir('compras')){
        mkdir('compras',0777,true);       
    }
    foreach($listado2 as $value){
        if(($value['matricula'] == $matricula) && !file_exists("compras/".$matricula.".txt")){
                $r = file_put_contents("compras/".$matricula.".txt",implode(";",$value));      
        }
    }
    return $r;
       
}

?>