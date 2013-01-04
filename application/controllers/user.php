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
		$data['posts'] = $this->Post_model->get_user_friend_posts($id_user);
		$data['user'] = $this->user_model->get($id_user);
		$this->layout->addCSS('userdata');
		$this->layout->addCSS('wall');
		$this->layout->view('user/wall_view', $data);
	}
	
	function inbox()
	{
		$id_user = $this->auth->uid();
		$data['heading'] = $this->user_model->get($id_user)['name'].' Inbox';
		$data['messages'] = $this->Message_model->get_messages($id_user);
		$this->layout->addCSS('inbox');
		$this->layout->view('user/inbox_view', $data);
	}
	
	function friends()
	{
		$id_user = $this->auth->uid();
		$data['heading'] = 'Twoi znajomi';
		$data['friends'] = $this->Friend_model->get_all_friends($id_user);
		$this->layout->addCSS('userdata');
		$this->layout->view('user/friends_view', $data);
	}
	
	function search()
	{
		$data['friends'] = $this->user_model->find($this->input->post('item'));
		$data['heading'] = 'Wyniki wyszukiwania';
		$this->layout->addCSS('userdata');
		$this->layout->view('user/search_view', $data);
	}	
	/*
		Dodawanie komentarza
	*/	
	function add_comment()
	{
		$id_user = $this->auth->uid();
		$post_id = $this->input->post('post_id');
		if($this->Comment_model->add_comment($_POST['comment_content'],$post_id, $id_user)){
			$this->notices->add('global','ok',"Komentarz został dodany");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}else{
			$this->notices->add('global','ok',"Wystąpił bład - komentarz nie został dodany");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}			
	
	}
	/*
		Dodawanie posta
	*/	
	function add_post()
	{
		$id_user = $this->auth->uid();
		if($this->Post_model->add_post($_POST['post_content'], $id_user)){
			$this->notices->add('global','ok',"Post został dodany");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}else{
			$this->notices->add('global','ok',"Wystąpił bład - post nie został dodany");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}		
	
	}
	
	function add_message()
	{
		$sender_id = $this->auth->uid();
		$id_user = $this->input->post('id_user');
		if($this->Message_model->add_message($_POST['message_content'], $id_user, $sender_id)){
			$this->notices->add('global','ok',"Wiadomość została wysłana");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}else{
			$this->notices->add('global','ok',"Wystąpił bład - wiadomość nie została wysłana");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}
	}
	
	function add_friend($id)
	{
		$id_user = $this->auth->uid();
		$this->Friend_model->add_friend($id_user, $id);
		redirect('/user/info/'.$id);
	}	
	
	function friend_request($id_user)
	{
		$sender_id = $this->auth->uid();
		$user = $this->user_model->get($sender_id);
		$a = form_open('user/add_friend/'.$sender_id);
		$message_content = $user['name'].' '.$user['surname'].' chce dodać cię do listy swoich znajomych.
		'.$a.'<input type="submit" value="Zatwierdź" ?>
		<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
		</form>';
		if($this->Message_model->add_message($message_content, $id_user, $sender_id)){
			$this->notices->add('global','ok',"Zaprosznie zostało wysłane");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}else{
			$this->notices->add('global','ok',"Wystąpił bład - zaproszenie nie zostało wysłane");
			$this->notices->save();
			redirect($this->input->post('redirect'));
		}
	}
	/*
		Funkcja generuje informacje na podstawie id
		dla zalogowanego użytkownika lub jego znajomego - ścianę,
		dla nieznajomego - krótkie info z opcją zaproszenia
	*/	
	function info($id_user)
	{

		if($id_user == $this->auth->uid()){
			redirect("user");
		}elseif($this->Friend_model->check_friend($id_user,$this->auth->uid())){	
			$data['user'] = $this->user_model->get($id_user);
			$data['posts'] = $this->Post_model->get_user_posts($id_user);	
			$data['id_user'] = $id_user;
			$this->layout->addCSS('userdata');
			$this->layout->addCSS('wall');
			$this->layout->view('user/friend_wall_view', $data);
			}
		else{
			$this->layout->addCSS('userdata');
			$data['user'] = $this->user_model->get($id_user);
			if($this->Friend_model->check_request($id_user,$this->auth->uid())){
			$data['options'] = 'Zaproszenie czeka na  potwierdzenie';
			}
			elseif($this->Friend_model->check_request($this->auth->uid(),$id_user)){
			$data['options'] = anchor('user/add_friend/'.$id_user ,'Potwierdź zaproszenie');;
			}
			else{
			$data['options'] = anchor('user/friend_request/'.$id_user ,'Wyślij zaproszenie');;
			}
			$this->layout->view("user/profile_view",$data);
		}
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */