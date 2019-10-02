<?php 
    include("bd.php");

    if(isset($_GET['ci'])){
        $ci = $_GET['ci'];
        $query = "DELETE FROM estudiante WHERE ci = $ci";
        $result = mysqli_query($conect, $query);
        if(!$result){
            die("Query failed");
        }
        
        header("Location: index.php");
    }
?>