<?php
include('bd.php');

include('parts/header.php');



?>

<div class="container">
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>CI</th>
                    <th>PRO</th>
                    <th>NOM</th>
                    <th>AP</th>
                    <th>REGUNI</th>
                    <th>CODPRO</th>
                    <th>CORREO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT * FROM estudiante';
                $result_tasks = mysqli_query($conect, $query);
                while ($row = mysqli_fetch_array($result_tasks)) { ?>
                    <tr>
                        <td><?php echo $row['ci'] ?></td>
                        <td><?php echo $row['pro'] ?></td>
                        <td><?php echo $row['nom'] ?></td>
                        <td><?php echo $row['ap'] ?></td>
                        <td><?php echo $row['reguni'] ?></td>
                        <td><?php echo $row['codpro'] ?></td>
                        <td><?php echo $row['correo'] ?></td>
                        <td>
                            <a href="edit.php?ci=<?php echo $row['ci'] ?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i>
                            </a>
                            <a href="delete.php?ci=<?php echo $row['ci'] ?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                            <a href="reporte_notas_estudiante.php?ci=<?php echo $row['ci'] ?>" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </a>
                            
                        </td>
                    </tr>
                <?php }
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php
include('parts/footer.php');
?>