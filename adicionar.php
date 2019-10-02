<?php
include('bd.php');
include('parts/header.php');
?>

<div class=" col-12">
    <div class="row justify-content-center">

        <div class="col-md-5">
            <div class="card card-body">
                <form action="guardar_estudiante.php" method="POST">
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">CI</label>
                                <div class="col-md-9"><input type="number" id="ci" name="ci" class="form-control" placeholder="CI" min="999999"  autofocus  required></div>
                            </div>
                        </div>


                    </div>
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3 control-label">Procedencia</label>
                                <div class="col-md-9">
                                    <select name="pro" id="pro" class="form-control ">
                                        <option value="LP">La Paz</option>
                                        <option value="OR">URURO</option>
                                        <option value="PT">POTOSI</option>
                                        <option value="CB">COCHABAMBA</option>
                                        <option value="SC">SANTA CRUZ</option>
                                        <option value="BN">BENI</option>
                                        <option value="PA">PANDO</option>
                                        <option value="TJ">TARIJA</option>
                                        <option value="CH">CHUQUISACA</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Nombres</label>
                                <div class="col-md-9">
                                    <input type="text" name="nombre" class="form-control" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" placeholder="Nombres" autofocus required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Apellidos</label>
                                <div class="col-md-9"><input type="text" name="apellido" class="form-control" placeholder="apellido" autofocus pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Registro</label>
                                <div class="col-md-9"><input type="number" name="reguni" class="form-control" placeholder="Registro Universitario" autofocus min="999999" max="99999999" required></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Programa</label>
                                <div class="col-md-9">
                                    <?php
                                    $query = "SELECT * FROM programa";
                                    $resp = mysqli_query($conect, $query); ?>
                                    <select name="programa" class="form-control">
                                        <?php
                                        if ($row = mysqli_fetch_array($resp)) {
                                            do {
                                                ?>
                                                <option value="<?php echo $row['digo']; ?>">
                                                    <?php echo utf8_encode($row['programa']) . " version " . $row['version']; ?>
                                                </option>
                                        <?php
                                            } while ($row = mysqli_fetch_array($resp));
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Correo</label>
                                <div class="col-md-9"> <input type="email"  name="correo" class="form-control" placeholder="Correo" autofocus pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required></div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" name="guardar_est" value="Agregar Estudiante">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('parts/footer.php');
?>