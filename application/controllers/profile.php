<?
class Profile extends CI_Controller{
	public function edit(){
		$this->layout->addCSS("profile");
		$id = $this->auth->uid();
		$data = $this->user_model->get($id);
	//	print_r($data);
		$this->layout->view("profile/edit",$data);
	}

	public function photo(){
		$this->layout->addJS("jquery.imgareaselect.min");
		$this->layout->addCSS("imgareaselect-animated");
		$this->layout->view("profile/photo");
	}

	public function rescale(){
		$img = $this->imageCreateFromAny("./uploads/".$this->input->post('photo'));
		if($img == false) return;
		$d = $this->input->post();
		$px = $d['photo_natural_width']/$d['photo_width'];
		$py = $d['photo_natural_height']/$d['photo_height'];
		$inew = imagecreatetruecolor(250,250);
		print_r($this->input->post());
		echo  ($d['x1']*$px)." ".($d['y1']*$py)." ".($d['width']*$px)." ".($d['height']*$py);
		echo imagecopyresampled ( $inew , $img , 0 , 0, $d['x1']*$px , $d['y1']*$py ,250,250, $d['width']*$px , $d['height']*$py );
	//	header('Content-Type: image/jpeg');

		// Output the image
		$file = "static/images/".$this->auth->uid().".png";
		imagepng($inew,$file);
		echo $this->user_model->set_photo(base_url().$file,$this->auth->uid());

		unlink("./uploads/".$this->input->post('photo'));
	//	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function do_upload()	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
		//	$this->output->set_status_header('404');
		}
		$d = $this->upload->data();
		$this->load->view('profile/message',$d);
		//print_r($d);

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


	private function imageCreateFromAny($filepath) {
		$type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
		$allowedTypes = array(
			1,  // [] gif
			2,  // [] jpg
			3,  // [] png
			6   // [] bmp
		);
		if (!in_array($type, $allowedTypes)) {
			return false;
	}
	switch ($type) {
		case 1 :
			$im = imageCreateFromGif($filepath);
			break;
		case 2 :
			$im = imageCreateFromJpeg($filepath);
			break;
		case 3 :
			$im = imageCreateFromPng($filepath);
			break;
		case 6 :
			$im = imageCreateFromBmp($filepath);
			break;
	}
	return $im;
}
}
?>
