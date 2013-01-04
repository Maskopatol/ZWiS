<?
/**
 * User_model
 * klasa służąca do zapisu, odczytu i modyfikacji danych użytkownika w bazie danych.
 * @author Mateusz Russak
 */

class User_model extends CI_Model {
	private $new_user;
	/**
	 * find
	 * słyży do wyszukiwania użytkowników w bazie danych, jako argument należy podać imie, nazwisko lub email.
	 * @param string
	 * @return array - tablica znalezionych / NULL jak nie znaleziono
	 */
	function find($string , $lecturer = null){
		$this->db->like('name',$string);
		$this->db->or_like('surname',$string);
		$this->db->or_like('email',$string);
		if($lecturer != null){
			$this->db->where('lecturer',$lecturer);
		}
		$q = $this->db->get('users');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $q->result_array();
	}
	/**
	 * all
	 * zwraca listę wszystkich użytkowników wraz z ich danymi
	 * @return array
	 */
	function all(){
		$query = $this->db->get('users');
		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $query->result_array();
	}
	/**
	 * get
	 * zwraca użytkownika i jego dane. jako argument można podać id-użytkownika lub email
	 * @param int/string
	 * @return array
	 */
	function get($item){
		$this->db->where('id_user',$item);
		$this->db->or_where('email',$item);
		$query = $this->db->get('users');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		$result = $query->result_array();
		return $result[0];
	}

	function set_static($id_location, $id_user){
		$this->db->update('users', array('static_location'=>$id_location), "id_user = ".$id_user);
	}

	function set_photo($photo , $id_user){
		$this->db->update('users', array('photo'=>$photo), "id_user = ".$id_user);
	}
	/**
	 * create
	 * tworzy nowego użytkownika
	 * jako argument tablica asocjacyjna: klucze <- nazwy kolumn,
	 * wartości <- wartości które mają być wprowadzone w dane kolumny
	 * np:
	 * 	$data = array('email' => 'asd@asd.asd' ,
	 *  			  'haslo' => sha1("heselko") ,
	 *  			  'imie' => "Zbyszek" ,
	 * 				  'nazwisko' => "Kowalski"
	 * 			);
	 *
	 * @param array
	 * @return bool
	 */
	function create($data){
		$this->db->insert('users',$data);

		if($this->db->_error_number()!=0)
			return false;

		$this->new_user = $this->db->insert_id();
		/*if(!$this->post_model->createNewBoard($id)){
			$this->db->delete('Users',array('id_user' => $id));
			return false;
		}

		if(!$this->gallery_model->create($id)){
		//	echo "wtf??!??!" ;exit();
			$this->db->delete('Users',array('id_user' => $id));
			return false;
		}
		*/
		return true;
	}
	/**
	 * new_user_id
	 * zwraca id nowododanego użytkownika
	 * @return int
	 */
	function new_user_id(){
		return $this->new_user;
	}

	/**
	 * update
	 * zmienia dane użytkownika
	 * @param int - id-użytkownika
	 * @param array - dane które mają zostać zmienione. format taki sam jak w create
	 * @return bool
	 */
	function update($id , $data){
		$this->db->where('id_user', $id);
		$this->db->update('users', $data);
	//	echo $this->db->last_query(); exit();
		if($this->db->_error_number()!=0){
			return false;
		}

		return true;
	}
	/**
	 * delete
	 * usuwa użytkownika z bazy danych
	 * @param int - id-użytkownika do usunięcia
	 * @return bool
	 */

	function delete($id){
		$this->db->delete('users', array('id_user' => $id));
		if($this->db->_error_number()!=0){
			return false;
		}

		return true;
	}



}
