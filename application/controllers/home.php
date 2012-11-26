<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** przykłądowa klasa wykorzystania Layoutów
 * 
 * @author Mateusz Russak
 */

class Home extends CI_Controller {

	public function index(){

	}
	
	public function login(){
		$this->load->helper('form');
		$this->load->library("auth");
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		if(!empty($email) && !empty($pass)){
			if($this->auth->login($email,$pass)){
				redirect("/home/","location");
			}else{
				$this->layout->view('home/login');
			}
		}else{
			$this->layout->view('home/login');
		}
	}
}

