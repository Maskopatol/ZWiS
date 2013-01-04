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
		$error = 0;
		$pass = $this->input->post("password");
		$pass2 = $this->input->post("password_confirmation");

		if(!empty($pass)){
			if($pass != $pass2){
				$this->notices->add('profile-edit','error','Hasła nie pasują do siebie');
				$error++;
			}else{
				$data['password'] = sha1($pass);
			}
		}


		if($error == 0 && $this->user_model->update($id , $data)){
			redirect("home/","location");
		}else{
			$this->notices->save();
			redirect("profile/edit/","location");
		}

	}
}
?>
