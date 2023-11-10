<?php include("db.php") ?>
<?php include("includes/header.php") ?>



<div class="container p-4">
    <div class="row">

        <div class="col-md-4">

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); } ?>

            <div class="card card-body">
                <form id="formulario" action="save_user.php" method="POST" onsubmit="return validarFormulario()">
                    <div class="form-group" id="grupo__nombre">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" autofocus>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>

                    <div class="form-group" id="grupo__usuario">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" autofocus>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>

                    <div class="form-group" id="grupo__dni">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" id="dni" placeholder="DNI" autofocus>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>

                    <div class="form-group" id="grupo__dni2">
                        <label for="dni2" class="form-label">Confirmar DNI</label>
                        <input type="text" name="dni2" class="form-control" id="dni2" placeholder="Repetir DNI" autofocus>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>

                    <div class="form-group" id="grupo__correo">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" autofocus>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-success btn-block" type="submit" name="save_user">Save User</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Dni</th>
                            <th>Correo</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = "SELECT * FROM usuarios";
                        $result_tasks = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_array($result_tasks)) { ?>
                            <tr>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['usuario'] ?></td>
                                <td><?php echo $row['dni'] ?></td>
                                <td><?php echo $row['correo'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="delete_user.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        
                        <?php } ?>
                    </tbody>

                </table>
        </div>

    </div>
</div>

<?php include("includes/footer.php") ?>