<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** przykłądowa klasa wykorzystania Layoutów
 * 
 * @author Mateusz Russak
 */

class Home extends CI_Controller {

	public function index(){
		if(!$this->auth->is_logged()){
			redirect('login','location');
		}else{
			$this->layout->addCSS('userdata');
			$data['user'] = $this->auth->user();
			$this->layout->view("home/index",$data);
		}
	}
	
	public function login(){
		$this->load->helper('form');
		$this->layout->set('intro');
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
	
	public function glogin(){
		if($this->auth->google_login()){
			redirect("home/",'location');
		}else{
			redirect("login/",'location');
		}
	}
	
	public function logout(){
		$this->auth->logout();
		redirect("/home/login","location");
	}
	
	public function register(){
		$this->load->helper('form');
		$this->load->library("auth");
		$this->layout->set('intro');
		
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$pass2 = $this->input->post('password_confirmation');
		
		
		if(!empty($email) && !empty($pass) && $pass == $pass2){
			$data['email'] = $email;
			$data['password'] = sha1($pass);
			$this->user_model->create($data);
			
			if($this->auth->login($email,$pass)){
				redirect("/home/","location");
			}else{
				$d['error']= "Rejestracja nie powiodła się";
				$this->layout->view('home/register',$d);
			}
		}else{
			$this->layout->view('home/register');
		}
	}
}

