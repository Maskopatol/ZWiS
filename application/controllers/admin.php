<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function _construct()
	{
		parent::_construct();
		
	}


	function index()
	{
		$data['heading'] = 'Admin';
		$this->layout->view('admin/admin_view', $data);
	}
	
	function choose_uni($id)
	{
		$data['heading'] = 'Wybierz uczelnię';
		$data['id'] = $id;
		$unis = $this->Uni_model->all();
		if(empty($unis)){
			$data['info'] = 'Brak uczelni w bazie - dodaj nową uczelnię';
			$this->layout->view('admin/add_uni_view', $data);
			} else {
		foreach ($unis as $u)
			$options[$u['id']] = $u['name'];
		$data['options'] = $options;
		$this->layout->view('admin/choose_uni_view', $data);
		}
	}
	
	function uni($id)
	{
		switch($id){
		case 1:
				$data['heading'] = 'Wprowadź dane';
				$this->layout->view('admin/add_uni_view', $data);
				break;
		case 2:
				$data['heading'] = 'Edytuj dane';
				$uni_id = $this->input->post('uni');
				$uni_inf = $this->Uni_model->get($uni_id);
				$data['uni_inf'] = $uni_inf;
				$this->layout->view('admin/edit_uni_view', $data);
				break;
		case 3:	
				$data['heading'] = 'Wprowadź dane';
				$data['id_uni'] = $this->input->post('uni');
				$this->layout->view('admin/add_faculty_view', $data);
				break;
		case 4:
		case 5:
		case 6:
				$data['id'] = $id;
				$data['heading'] = 'Wybierz wydział';
				$fac = $this->Faculty_model->all_in_uni($this->input->post('uni'));
				if(empty($fac)){
					$data['info'] = 'Brak wydziałów w bazie - dodaj nowy wydział';
					$this->layout->view('admin/add_faculty_view', $data);
					} else {
					foreach ($fac as $f)
						$options[$f['id']] = $f['name'];
						$data['options'] = $options;
						$this->layout->view('admin/choose_faculty_view', $data);
				}

		}
		
	}
	
	function add_uni()
	{
		$data = array(
			'name' => $this->input->post("name"),
			'address' => $this->input->post("address"),
			'established' => $this->input->post("established"),
			'students' => $this->input->post("students"),
			'home_page' => $this->input->post("home_page"),
			'is_public' => $this->input->post("is_public"),
			);
		if($this->Uni_model->create($data)){
			redirect("admin/");
			}else{
			echo "coś poszło nie tak jak powinno";
			$this->layout->view("admin");
		}

	}
	
	function edit_uni($id)
	{
		$data = array(
			'name' => $this->input->post("name"),
			'address' => $this->input->post("address"),
			'established' => $this->input->post("established"),
			'students' => $this->input->post("students"),
			'home_page' => $this->input->post("home_page"),
			'is_public' => $this->input->post("is_public"),
			);
		if($this->Uni_model->update($id, $data)){
			redirect("admin/");
			}else{
			echo "coś poszło nie tak jak powinno";
			$this->layout->view("admin");
		}

	}
	
	function fac($id)
	{
		switch($id){
		case 4:
				$data['heading'] = 'Edytuj dane';
				$fac_id = $this->input->post('fac');
				$data['fac_inf'] = $this->Faculty_model->get($fac_id);
				$this->layout->view('admin/edit_faculty_view', $data);
				break;
		case 5:
				$data['heading'] = 'Wprowadź dane';
				$data['id_fac'] = $this->input->post('fac');
				$this->layout->view('admin/add_field_view', $data);
				break;
		case 6:	
				$data['heading'] = 'Wybierz kierunek';
				$field = $this->Field_model->all_in_faculty($this->input->post('fac'));
				if(empty($field)){
					$data['info'] = 'Brak wydziałów w bazie - dodaj nowy kierunek';
					$this->layout->view('admin/add_field_view', $data);
					} else {
					foreach ($field as $f)
						$options[$f['id']] = $f['name'];
						$data['options'] = $options;
						$this->layout->view('admin/choose_field_view', $data);
				}
		}

	}
		
	
	function add_faculty()
	{
		$data = array(
			'name' => $this->input->post("name"),
			'info' => $this->input->post("info"),
			'id_uni' => $this->input->post("id_uni"),
			);
		if($this->Faculty_model->create($data)){
			redirect("admin/");
			}else{
			echo "coś poszło nie tak jak powinno";
			$this->layout->view("admin");
		}

	}
	
	function edit_faculty($id)
	{
		$data = array(
			'name' => $this->input->post("name"),
			'info' => $this->input->post("info"),
			'id_uni' => $this->input->post("id_uni"),
			);
		if($this->Faculty_model->update($id, $data)){
			redirect("admin/");
			}else{
			echo "coś poszło nie tak jak powinno";
			$this->layout->view("admin");
		}

	}
	
	function field()
	{
		$data['heading'] = 'Edytuj dane';
		$id = $this->input->post('field');
		$data['field_inf'] = $this->Field_model->get($id);
		$this->layout->view('admin/edit_field_view', $data);
	}
	function add_field()
	{
		$data = array(
			'name' => $this->input->post("name"),
			'info' => $this->input->post("info"),
			'id_faculty' => $this->input->post("id_fac"),
			);
		if($this->Field_model->create($data)){
			redirect("admin/");
			}else{
			echo "coś poszło nie tak jak powinno";
			$this->layout->view("admin");
		}

	}
	
	function edit_field($id)
	{
		$data = array(
			'name' => $this->input->post("name"),
			'info' => $this->input->post("info"),
			'id_faculty' => $this->input->post("id_fac"),
			);
		if($this->Field_model->update($id, $data)){
			redirect("admin/");
			}else{
			echo "coś poszło nie tak jak powinno";
			$this->layout->view("admin");
		}

	}
	

}