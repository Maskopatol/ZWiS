<?

class Post_model extends CI_Model
    {    
        public $post_id;
		public $id_user;
        public $post_content;
        public $post_date;
        public $name;        
        public $comments;


		/*
			Funkcja zwraca wszystkie posty
			napisane lub skomentowane
			przez użytkownika z id = id_user.		
		*/
		
        public function get_user_posts($id_user)
        {
               
                $all_posts = array();

                $sql = "SELECT DISTINCT posts.post_id,
                               posts.post_content, 
                               posts.post_date,
							   posts.id_user,
                               CONCAT_WS(' ',users.name,users.surname) as name
                        FROM posts LEFT JOIN users ON posts.id_user = users.id_user
						WHERE posts.id_user = ? 
						OR posts.post_id IN 
									(SELECT post_id
									 FROM comments
									 WHERE id_user = ?)
						ORDER BY posts.last_com_date DESC";

                
                $query = $this->db->query($sql, array($id_user, $id_user));
				
				//Obiekty typu Post_model
                foreach($query->result("Post_model") as $post)
                {
                        $post->comments = $this->get_post_comments($post->post_id);
                        $all_posts[] = $post;
                }

                return $all_posts;
        }
		
		public function get_user_friend_posts($id_user)
        {
               
                $all_posts = array();

                $sql = "SELECT DISTINCT posts.post_id,
                               posts.post_content, 
                               posts.post_date,
							   posts.id_user,
                               CONCAT_WS(' ',users.name,users.surname) as name
                        FROM posts LEFT JOIN users ON posts.id_user = users.id_user
						WHERE posts.id_user = ? 
						OR posts.post_id IN 
									(SELECT post_id
									 FROM comments
									 WHERE id_user = ?)
						OR posts.id_user IN
									(SELECT id_friend
									 FROM friends
									 WHERE id_user = ?)
						ORDER BY posts.last_com_date DESC";

                
                $query = $this->db->query($sql, array($id_user, $id_user, $id_user));
				
				//Obiekty typu Post_model
                foreach($query->result("Post_model") as $post)
                {
                        $post->comments = $this->get_post_comments($post->post_id);
                        $all_posts[] = $post;
                }

                return $all_posts;
        }


        /*
			Funkcja zwraca komentarze do postu
			o podanym id		
		*/
		
       public function get_post_comments($post_id)
        {
                $sql = "SELECT 	comments.comment_content,
								CONCAT_WS(' ',users.name,users.surname) as name,
								comments.comment_date,
								comments.id_user
						FROM comments LEFT JOIN users ON comments.id_user = users.id_user
						WHERE post_id = ?
						ORDER BY comments.comment_date DESC";
                $query = $this->db->query($sql, array($post_id));
                $comments = array();
                foreach($query->result("Comment_model") as $comment)
                {
					$comments[] = $comment;
                }
                return $comments;
        } 
	
		/*
			Funkcja dodaje post do bazy
		*/
		
		public function add_post($post_content, $id_user)
		{
			$date = time();  
			$date = date( 'Y-m-d H:i:s');
			
			$data = array(
			   'post_content' => $post_content ,
			   'id_user' => $id_user ,
			   'last_com_date' => $date
			);

			$this->db->insert('posts', $data);
			if($this->db->_error_number()!=0){
				return false;
			}
			return true;
		}
}