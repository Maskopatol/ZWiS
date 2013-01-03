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
			if($data['user']['name']=="Anonymous"){
				$this->notices->add('global','info',"Nie zapomnij zmienić swojego imienia i nazwiska! ".anchor('profile/edit','link'));
			}
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
				$u = $this->auth->user();
				$this->notices->add('global','ok',"Zalogowany jako: ".$u['name']." ".$u['surname']);
				$this->notices->save();
				redirect("/home/","location");
			}else{
				$this->notices->add('login','error',"Nieprawidłowy użytkownik lub hasło");
				$this->layout->view('home/login');
			}
		}else{
			$this->layout->view('home/login');
		}
	}
	
	public function glogin(){
		if($this->auth->google_login()){
			$u = $this->auth->user();
			$this->notices->add('global','ok',"Zalogowany jako: ".$u['name']." ".$u['surname']);
			$this->notices->save();
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
		$this->load->helper('email');
		
		if(empty($_POST)){
			$this->layout->view('home/register');
			return;
		}
		
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$pass2 = $this->input->post('password_confirmation');
		
		$error = 0;
		
		if (!valid_email($email)){
			$this->notices->add('register','error',"Adres email jest niepoprawny!");
			$error++;
		}
		if(empty($pass)){
			$this->notices->add('register','error',"Hasło nie może być puste!");
			$error++;
		}
		if ($pass != $pass2){
			$this->notices->add('register','error',"Hasła nie pasują do siebie");
			$error++;
		}
		
		if($error == 0){
			
			
			$data['email'] = $email;
			$data['password'] = sha1($pass);
			if(!$this->user_model->create($data)){
				$this->notices->add('register','error',"Adres email jest zajęty");
			}
			
			if($this->auth->login($email,$pass)){
				$this->notices->add('global','ok',"Użytkownik zarejestrowany!");
				$this->notices->save();
				redirect("/home/","location");
			}else{
				$this->layout->view('home/register');
			}
		}else{
			$this->layout->view('home/register');
		}
	}
}

