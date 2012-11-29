<?

class Message_model extends CI_Model
    {    
        public $id;
		public $id_user;
		public $sender_id;
        public $message_content;
        public $message_date;
        public $name;


		/*
			Funkcja zwraca wiadomości
			do użytkownika z $id_user
		*/
		
        public function get_messages($id_user)
        {
               
                $all_messages = array();

                $sql = "SELECT DISTINCT messages.id,
                               messages.message_content, 
                               messages.message_date,
							   messages.id_user,
							   messages.sender_id,
                               CONCAT_WS(' ',users.name,users.surname) as name
                        FROM messages LEFT JOIN users ON messages.sender_id = users.id_user
						WHERE messages.id_user = ? 
						ORDER BY messages.message_date DESC";

                
                $query = $this->db->query($sql, array($id_user, $id_user));
				
				//Obiekty typu Message_model
                foreach($query->result("Message_model") as $message)
                {
                        $all_messages[] = $message;
                }

                return $all_messages;
        }

		/*
			Funkcja dodaje wiadomości do bazy
		*/
		
		public function add_message($message_content, $id_user, $sender_id)
		{
			
			$data = array(
			   'message_content' => $message_content ,
			   'id_user' => $id_user ,
			   'sender_id' => $sender_id
			);

			$this->db->insert('messages', $data);
		}
}