<?

class Comment_model extends CI_Model
    {    
        public $comment_content;
        public $comment_date;
		public $id_user;
        public $name;        


		/*
			Funkcja dodaje komentarz do bazy
		*/
		public function add_comment($comment_content, $post_id, $id_user)	
		{
			$data = array(
			   'comment_content' => $comment_content ,
			   'post_id' => $post_id ,
			   'id_user' => $id_user
			);
			
			$this->db->insert('comments', $data); 
			
			$date = time();  
			$date = date( 'Y-m-d H:i:s');
			$this->db->set('last_com_date', $date);
			$this->db->where('post_id =', $post_id);
			$this->db->update('posts');
		}
}