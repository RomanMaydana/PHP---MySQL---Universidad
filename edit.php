<?php
include("bd.php");

if (isset($_GET['ci'])) {
    $ci = $_GET['ci'];
    $query = "SELECT * FROM estudiante WHERE ci = $ci";
    $result = mysqli_query($conect, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $pro = $row['pro'];
        $nombre = $row['nom'];
        $apellido = $row['ap'];
        $reguni = $row['reguni'];
        $codpro = $row['codpro'];
        $correo = $row['correo'];
    }
}
if (isset($_POST['update'])) {
    $ci = $_GET['ci'];
    $pro = $_POST['pro'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $reguni = $_POST['reguni'];
    $codpro = $_POST['programa'];;
    $correo = $_POST['correo'];
    $description = $_POST['description'];

    $query = "UPDATE estudiante set pro = '$pro', nom = '$nombre', ap ='$apellido', reguni = '$reguni', codpro = '$codpro', correo = '$correo'  WHERE ci = $ci";
    mysqli_query($conect, $query);

    header("Location: index.php");
}
?>
<?php
include("parts/header.php");
?>

<div class="container p-4 col-12">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-body">
                <form action="edit.php?ci=<?php echo $_GET['ci']; ?>" method="POST">

                <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3 control-label">Procedencia</label>
                                <div class="col-md-9">
                                    <select name="pro" id="pro" class="form-control"  value="<?php echo $pro?>">
                                        <option value="LP" <?php if($pro == 'LP') echo "selected" ?>>La Paz</option>
                                        <option value="OR" <?php if($pro == 'OR') echo "selected" ?>>ORURO</option>
                                        <option value="PT" <?php if($pro == 'PT') echo "selected" ?>>POTOSI</option>
                                        <option value="CB" <?php if($pro == 'CB') echo "selected" ?>>COCHABAMBA</option>
                                        <option value="SC" <?php if($pro == 'SC') echo "selected" ?>>SANTA CRUZ</option>
                                        <option value="BN" <?php if($pro == 'BN') echo "selected" ?>>BENI</option>
                                        <option value="PA" <?php if($pro == 'PA') echo "selected" ?>>PANDO</option>
                                        <option value="TJ" <?php if($pro == 'TJ') echo "selected" ?>>TARIJA</option>
                                        <option value="CH" <?php if($pro == 'CH') echo "selected" ?>>CHUQUISACA</option>

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
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombres" autofocus value="<?php echo $nombre?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Apellidos</label>
                                <div class="col-md-9"><input type="text" name="apellido" class="form-control" placeholder="apellido" value="<?php echo $nombre?>" autofocus></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="container">
                            <div class="row">
                                <label for="ci" class="col-md-3">Registro</label>
                                <div class="col-md-9"><input type="number" name="reguni" class="form-control" placeholder="Registro Universitario" value="<?php echo $reguni?>" autofocus></div>
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
                                    <select name="programa" class="form-control" value="<?php echo $codpro?>">
                                        <?php
                                        if ($row = mysqli_fetch_array($resp)) {
                                            do {
                                                ?>
                                                <option value="<?php echo $row['digo']; ?>"  <?php if($row['digo'] == $codpro) echo "selected" ?>>
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
                                <div class="col-md-9"> <input type="text" name="correo" class="form-control" placeholder="Correo" value="<?php echo $correo?>" autofocus></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" name="update">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("parts/footer.php"); ?>