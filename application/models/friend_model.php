<?

class Friend_model extends CI_Model
    {    
		public $id_user;
		public $photo;
		public $email;
        public $name;
		
		public function get_all_friends($id_user)
		{
			$all_friends = array();

			$sql = "SELECT id_user,
						   photo, 
						   email,
						   CONCAT_WS(' ',name,surname) as name
					FROM users
					WHERE id_user IN 
								(SELECT id_friend
								FROM friends
								WHERE id_user = ?)";

			
			$query = $this->db->query($sql, $id_user);
			
			//Obiekty typu Friend_model
			foreach($query->result("Friend_model") as $friend)
			{
					$all_friends[] = $friend;
			}

			return $all_friends;
		
		}
		
		
		public function add_friend($id_user, $id_friend)
		{
			
			$data = array(
			   'id_user' => $id_user ,
			   'id_friend' => $id_friend
			);

			$this->db->insert('friends', $data);
			
			$data = array(
			   'id_user' => $id_friend ,
			   'id_friend' => $id_user
			);
			
			$this->db->insert('friends', $data);
			
			$this->db->where('id_user', $id_user);
			$this->db->where('sender_id', $id_friend);
			$data = array(
				'message_content' => 'Ty i nadawca wiadomości jesteście znajomymi.'
				);
			$this->db->update('messages', $data);
		}
		
		public function check_friend($id1, $id2)
		{
			$this->db->where('id_user',$id1);
			$this->db->where('id_friend',$id2);
			$query = $this->db->get('friends');
			if($query && $query->num_rows()){
				return TRUE;
			}
			else{
				return FALSE;
			}
			
		}
		
		public function check_request($id1, $id2)
		{
			$this->db->where('id_user',$id1);
			$this->db->where('sender_id',$id2);
			$query = $this->db->get('messages');
			if($query && $query->num_rows()){
				return TRUE;
			}
			else{
				return FALSE;
			}
			
		}
}