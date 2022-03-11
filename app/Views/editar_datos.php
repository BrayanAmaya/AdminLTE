
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
     content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Editar Datos</title>
    <!--  -->
</head>
<body>
    <div class="container">
        
        <?php 

        $validation = \Config\Services::validation();
        ?>
        <h2 class="text-center mt-4 mb-4"></h2>
        
        <div class="card">
            <div class="card-header">Editar Datos</div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('dashboard/edit_validation'); ?>">
                    <div class="form-group">
                        <label>Empresa</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $user_data['nombre']; ?>">

                        <!-- Error -->
                        <?php 
                        if($validation->getError('nombre'))
                        {
                            echo "
                            <div class='alert alert-danger mt-2'>
                            ".$validation->getError('nombre')."
                            </div>
                            ";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control" value="<?php echo $user_data['correo']; ?>">

                        <?php 
                        if($validation->getError('email'))
                        {
                            echo "
                            <div class='alert alert-danger mt-2'>
                            ".$validation->getError('correo')."
                            </div>
                            ";
                        }
                        ?>
                    </div>

                    
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $user_data["id"]; ?>" />
                        <a href="<?php echo base_url("/dashboard")?>" class="btn btn-warning">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
 
</body>
</html>
