<?php

namespace App\Controllers;

use App\Models\CrudModel;

class Dashboard extends BaseController
{

	
	function index()
	{	

		if ($this->request->getPost('select')){
		$select_valor =$this->request->getPost('select');
		$crudModel = new CrudModel();
		$data['empresas'] = $crudModel->orderBy('id', 'ASC')->paginate($select_valor);
		$data['pagination_link'] = $crudModel->pager;
		return view('crud_view', $data);

		}
		$select_valor = 5;
		$crudModel = new CrudModel();
		$data['empresas'] = $crudModel->orderBy('id', 'ASC')->paginate($select_valor);
		$data['pagination_link'] = $crudModel->pager;
		return view('crud_view', $data);

	}

	function agregar()
	{
		return view('agregar_datos');
	}

	function add_validation()
	{
		helper(['form', 'url']);

		$error = $this->validate([
			'nombre'	=>	'required|min_length[2]',
			'correo'	=>	'required|valid_email',
		]);

		if(!$error)
		{
			echo view('agregar_datos', [
				'error' 	=> $this->validator
			]);
		}
		else
		{
			$crudModel = new CrudModel();

			$crudModel->save([
				'nombre'	=>	$this->request->getVar('nombre'),
				'correo'	=>	$this->request->getVar('correo')			
			]);

			$session = \Config\Services::session();

			$session->setFlashdata('success', 'Datos agregados correctamente');

			return $this->response->redirect(site_url('/dashboard'));
		}
	}

	// Vista aun unico dato de la BD por el ID
    function fetch_single_data($id = null)
    {
        $crudModel = new CrudModel();

        $data['user_data'] = $crudModel->where('id', $id)->first();

        return view('editar_datos', $data);
    }

    function edit_validation()
    {
    	helper(['form', 'url']);
        
        $error = $this->validate([
            'nombre' 	=> 'required|min_length[3]',
            'correo' => 'required|valid_email'
           
        ]);

        $crudModel = new CrudModel();

        $id = $this->request->getVar('id');


        if(!$error)
        {
        	$data['user_data'] = $crudModel->where('id', $id)->first();
			
        	$data['error'] = $this->validator;
			$session = \Config\Services::session();
            $session->setFlashdata('success', 'Error al editar sus datos');
        	echo view('editar_datos', $data);
        } 
        else 
        {
	        $data = [
	            'nombre' => $this->request->getVar('nombre'),
	            'correo'  => $this->request->getVar('correo')
	           
	        ];

        	$crudModel->update($id, $data);
        	$session = \Config\Services::session();
            $session->setFlashdata('success', 'Sus datos han sido actualizados correctamente');

        	return $this->response->redirect(site_url('/dashboard'));
        }
    }

	function delete($id)
    {
        $crudModel = new CrudModel();

        $crudModel->where('id', $id)->delete($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Dato eliminado con exito');

        return $this->response->redirect(site_url('/dashboard'));
    }
	function busqueda()
    {
	 
    $busqueda = $this->request->getPost('busqueda');
	 $crudModel = new CrudModel();	
	 $request = \Config\Services::request();
 	 echo json_encode($crudModel->where('nombre', 'UNAB')->first());
    
    }
}

?>
