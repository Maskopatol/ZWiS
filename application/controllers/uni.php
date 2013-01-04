<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uni extends CI_Controller
{
	function index()
	{
		$this->layout->setSubpageTitle("Lista wrocławskich uczelni");
		$data['heading'] = 'Wrocławskie uczelnie';
		$data['uni_list'] = $this->Uni_model->get_all_unis();
		$this->layout->view('uni/index', $data);
	}
	
	function faculty($id)
	{
		$this->layout->setSubpageTitle("Wydziały uczelni");
		$data['heading'] = 'Wydziały';
		$data['faculty_list'] = $this->Faculty_model->get_all_in_uni($id);
		$this->layout->view('uni/faculty', $data);
	}
	
	function field($id)
	{
		$this->layout->setSubpageTitle("Kierunki wydziału");
		$data['heading'] = 'Wydziały';
		$data['field_list'] = $this->Field_model->get_all_in_faculty($id);
		$this->layout->view('uni/field', $data);
	}
}

?>