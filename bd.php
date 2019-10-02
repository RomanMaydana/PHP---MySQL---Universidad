<?php
    $server = 'localhost';
    $user = 'root';
    $pw = '';
    $bd = 'univerdidad';

    $conect = new mysqli($server, $user, $pw, $bd);

    if(mysqli_connect_errno()){
        echo 'Conexion Fallida: ', mysqli_connect_error();
        exit();
    }

?>