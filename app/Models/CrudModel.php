<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
	protected $table = 'tbl_empresas';

	protected $primaryKey = 'id';

	protected $allowedFields = ['nombre', 'correo'];

}

?>