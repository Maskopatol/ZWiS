<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function _construct()
	{
		parent::_construct();
		
	}


	/*
		Funkcja generujaca sciane
		(posty z komentarzami)
		dla aktualnie zalogowanego użytkownika	
	*/
	function index()
	{
		$id_user = $this->auth->uid();
		$data['heading'] = $this->user_model->get($id_user)['name'].' Wall';
		$data['posts'] = $this->Post_model->get_user_posts($id_user);
		
		$this->layout->view('home/wall_view', $data);
	}
	
	function inbox()
	{
		$id_user = $this->auth->uid();
		$data['heading'] = $this->user_model->get($id_user)['name'].' Inbox';
		$data['messages'] = $this->Message_model->get_messages($id_user);
		
		$this->layout->view('home/inbox_view', $data);
	}
	/*
		Dodawanie komentarza
	*/	
	function add_comment()
	{
		$id_user = $this->auth->uid();
		$post_id = $this->input->post('post_id');
		$this->Comment_model->add_comment($_POST['comment_content'],
					$post_id, $id_user);
		redirect($this->input->post('redirect'));			
	
	}
	/*
		Dodawanie posta
	*/	
	function add_post()
	{
		$id_user = $this->auth->uid();
		$this->Post_model->add_post($_POST['post_content'], $id_user);
		redirect($this->input->post('redirect'));			
	
	}
	
	function add_message()
	{
		$sender_id = $this->auth->uid();
		$id_user = $this->input->post('id_user');
		$this->Message_model->add_message($_POST['message_content'], $id_user, $sender_id);
		redirect($this->input->post('redirect'));
	}
	/*
		Funkcja generuje sciane znajomego
	*/	
	function info()
	{
		
		
		$id_user = $this->uri->segment(3);
		if($id_user == $this->auth->uid()){
			redirect("user");
		}else{	
			$data['heading'] = $this->user_model->get($id_user)['name'].' Wall';
			$data['posts'] = $this->Post_model->get_user_posts($id_user);	
			$data['id_user'] = $id_user;
			$this->layout->view('home/friend_wall_view', $data);
			}
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */