<?php
include('bd.php');
include('parts/header.php');
?>
<div class="container p-4 col-12">
    <div class="row">
        <div class="container">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CI</th>
                            <th>PROCEDENCIA</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>REGISTRO</th>
                            <th>CODPRO</th>
                            <th>CORREO</th>
                            <th>OPCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lp = 'LP';
                        $query = "SELECT * FROM estudiante where pro like $lp ORDER BY ap ";
                        $result_tasks = mysqli_query($conect, $query);
                        while ($row = mysqli_fetch_array($result_tasks)) { ?>
                            <tr>
                                <td class="text-uppercase"><?php echo $row['ci'] ?></td>
                                <td class="text-uppercase"><?php echo $row['pro'] ?></td>
                                <td class="text-uppercase"><?php echo $row['nom'] ?></td>
                                <td class="text-uppercase"><?php echo $row['ap'] ?></td>
                                <td class="text-uppercase"><?php echo $row['reguni'] ?></td>
                                <td class="text-uppercase"><?php echo $row['codpro'] ?></td>
                                <td class="text-uppercase"><?php echo $row['correo'] ?></td>
                                <td>
                                    <a href="edit.php?ci=<?php echo $row['ci'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="delete.php?ci=<?php echo $row['ci'] ?>" class="btn btn-danger" onclick="return Confirmation()">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <a href="reporte_notas_estudiante.php?ci=<?php echo $row['ci'] ?>" class="btn btn-danger">
                                        Reporte
                                    </a>

                                </td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript">
    function Confirmation() {

        if (confirm('Esta seguro de eliminar el registro?') == true) {
            alert('El registro ha sido eliminado correctamente!!!');
            return true;
        } else {
            //alert('Cancelo la eliminacion');
            return false;
        }
    }
</script>


<?php
include('parts/footer.php');
?>