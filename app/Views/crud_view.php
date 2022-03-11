<?= $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

<style type="text/css">

#divPadre {
    height:auto;
    width:auto;
     text-align:center;

}
#divHijo {
    height:auto;
    width:auto;
     margin:0px auto;

     
}
#contenedor{
  display: inline-block;
  min-width: 100px;
}

#texto{
  background-color: red;
  width: 100%;
}

</style>
 <!-- Navbar -->
  <nav class=" navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <a href="http://localhost:8080/">Inicio</a>/<a">Empresas </a>
    </ul>
</nav>


<nav class=" navbar navbar-expand navbar-white navbar-light">
 <ul class="navbar-nav">
        <h3 class="mt-4">Lista de Empresas</h3>      
    </ul>

<ul class="navbar-nav ml-auto">
        <div class="row">
        <a href="<?php echo base_url("/dashboard/agregar")?>" class="btn btn-success">Añadir</a>  
    </div>
    </ul>
</nav>

<div id="divPadre">
     
 <div class="card mb-4">
    <div class="card-header">
       <i class="fas fa-table mr-1"></i>Gestion de empresas </div>
       <?php
        $session = \Config\Services::session();
        if($session->getFlashdata('success'))
        {
            echo '
            <div class="alert alert-success">'.$session->getFlashdata("success").'</div>';
        }
        ?>
 
  <!-- Navbar -->
  <nav class=" navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
<form method="get" action="<?php echo base_url('dashboard/busqueda'); ?>" >	
<div class="col-md-8 form-horizontal">
<input method="post" name="busqueda" id="busqueda"  type="search" class="form-control" />
<button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
</div>
 </form>
 
    </ul>
</nav>

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>id</th>
                <th>Empresa</th>
                <th>Correo</th>                                         
                <th >Operaciones</th>
              </tr>
            </thead>
      
        <tbody>                    
           	<tr>       							
              <?php
                  if($empresas)
                        {
                            foreach($empresas as $data)
                            {
                                echo '
                                <tr>
                                    <td>'.$data["id"].'</td>
                                    <td>'.$data["nombre"].'</td>
                                    <td>'.$data["correo"].'</td>
                                    <td> 
                                    <a href="'.base_url().'/dashboard/fetch_single_data/'.$data["id"].'" class="btn btn-warning"><i class="fa fa-edit"></i>Editar</a>
                                    <button type="button" onclick="delete_data('.$data["id"].')" class="btn btn-danger"><i class="fa fa-trash"></i>Eliminar</button>
                      

                                </tr>';
                            }
                        }
                    
                        ?>
                </tr>      
                  </tbody>
                    </table>
                        </div>
                            </div>
    
   <ul class="navbar-nav">
      <?php
        $pagination_link->setPath('dashboard');
        echo $pagination_link->links();               
      ?>
</ul>

<ul class="navbar-nav ml-auto">
<div class="row">

<form method="post">	
<div class="form-group">
  <select action="<?php echo base_url('dashboard/index'); ?> " onchange='this.form.submit()' class="form-control" name="select" id="select" >
    <option value = "5">5</option>
    <option value = "10">10</option>
    <option value = "25">25</option>
    <option value = "50">50</option>
    <option value = "100">100</option>
  </select>
</div>
 </form>
    </div>
        </ul>

            </div>
       </div>
   </div>
 </div>
  <!-- /.navbar -->

  <script>
function delete_data(id)
{
    if(confirm("¿Estas seguro que quieres eliminar?"))
    {
        window.location.href="<?php echo base_url(); ?>/dashboard/delete/"+id;
    }
    return false;
}
</script>


<?= $this->endSection() ?>
