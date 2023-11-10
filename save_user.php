<?php
include('db.php');

if (isset($_POST['save_user'])) {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];

    $query = "INSERT INTO usuarios(nombre, usuario, dni, correo) VALUES ('$nombre', '$usuario', '$dni', '$correo')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $_SESSION['message'] = 'Error al guardar el usuario. Error: ' . mysqli_error($conn);
        $_SESSION['message_type'] = 'danger';
        header("location: index.php");
    } else {
        $_SESSION['message'] = 'Usuario guardado correctamente.';
        $_SESSION['message_type'] = 'success';
        header("location: index.php");
    }

}
?>
