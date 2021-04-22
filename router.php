<?php

$matches=[];

//Excepcion para que la URL principal sea index.html
if (in_array($_SERVER["REQUEST_URI"], ['/index.html', '/', ''])){
    echo file_get_contents('index.html');
    
    die;
}

if(preg_match('/\/([^\/]+)\/([^\/]+)/',$_SERVER["REQUEST_URI"],$matches))
{
    // Es una URL tipo /recurso/id
    $_GET['resource_type']=$matches[1]; //Tomamos la primera coincidencia   
    $_GET['resource_id']=$matches[2]; //Tomamos la segunda coincidencia como id
    error_log(print_r($matches,1));

    require 'server.php'; //Delegamos la respuesta en server.php
}elseif(preg_match('/\/([^\/]+)\/?/',$_SERVER["REQUEST_URI"],$matches))
{
    //Es una URL tipo /recurso
    $_GET['resource_type']=$matches[1];   //Tomamos la primera coincidencia
    error_log(print_r($matches,1));
    require 'server.php'; //Delegamos la respuesta en server.php
}else
{
    error_log('No matches');
    http_response_code(404);
}

?>