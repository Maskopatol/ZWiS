<?
class Profile extends CI_Controller{
	public function edit(){
		$id = $this->auth->uid();
		$data = $this->user_model->get($id);
		$this->layout->view("profile/edit",$data);
	}
	public function update(){
		$id = $this->auth->uid();
		$data = array(
			'name' => $this->input->post("name"),
			'surname' => $this->input->post("surname")
			);
	
		$pass = $this->input->post("password");
		$pass2 = $this->input->post("password_confirmation");
		if(!empty($pass) && $pass == $pass2){
			$data['password'] = sha1($pass);
		}
		
		if($this->user_model->update($id , $data)){
			redirect("home/","location");
		}else{
			$data['errors']="coś poszło nie tak jak powinno?";
			$this->layout->view("profile/edit",$data);
		}
		
	}
}
?>