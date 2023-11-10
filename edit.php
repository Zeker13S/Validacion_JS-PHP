<?php

    include("db.php");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM usuarios WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $nombre = $row['nombre'];
            $usuario = $row['usuario'];
            $dni = $row['dni'];
            $correo = $row['correo'];
        }
    }

    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $dni = $_POST['dni'];
        $correo = $_POST['correo'];

        $query = "UPDATE usuarios set nombre = '$nombre', usuario = '$usuario', dni = '$dni', correo = '$correo' WHERE id = $id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = 'User Updated Successfully';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");

    }

?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">

                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">

                    <div class="form-group">
                        <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="text" name="usuario" value="<?php echo $usuario; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="number" name="dni" value="<?php echo $dni; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="text" name="correo" value="<?php echo $correo; ?>" class="form-control">
                    </div>

                    <button class="btn btn-success" name="update"> Update </button>

                </form>

            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>