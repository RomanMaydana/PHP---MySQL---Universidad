<?php 
include("bd.php");
if(isset($_POST['guardar_est'])){
    $ci = $_POST['ci'];
    $pro = $_POST['pro'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $reguni = $_POST['reguni'];
    $codpro =  $_POST['programa'];
    $correo = $_POST['correo'];

    $query = "INSERT INTO estudiante VALUES ('$ci','$pro','$nombre','$apellido','$reguni', '$codpro','$correo')";
    $result = mysqli_query($conect,$query);

    if(!$result){
        die("Query Failed");
        echo 'fallo';
    }
    header("Location: index.php");
    
    
}
?>