<?
/**
 * User_model
 * klasa służąca do zapisu, odczytu i modyfikacji danych użytkownika w bazie danych.
 * @author Mateusz Russak
 */

class User_model extends CI_Model {
	
	/**
	 * find
	 * słyży do wyszukiwania użytkowników w bazie danych, jako argument należy podać imie, nazwisko lub email.
	 * @param string 
	 * @return array - tablica znalezionych / NULL jak nie znaleziono
	 */
	function find($string){
		$this->db->like('name',$string);
		$this->db->or_like('surname',$string);
		$this->db->or_like('email',$string);
		$q = $this->db->get('Users');

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
		$query = $this->db->get('Users');
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
		$query = $this->db->get('Users');
		
		if($this->db->_error_number()!=0){
			return NULL;
		}
		$result = $query->result_array();
		return $result[0];
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
		$this->db->insert('Users',$data);
		
		if($this->db->_error_number()!=0)
			return false;
		$id = $this->db->insert_id();
		if(!$this->post_model->createNewBoard($id)){
			$this->db->delete('Users',array('id_user' => $id));
			return false;
		}
		
		if(!$this->gallery_model->create($id)){
		//	echo "wtf??!??!" ;exit();
			$this->db->delete('Users',array('id_user' => $id));
			return false;
		}
		
		return true;
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
		$this->db->update('Users', $data); 
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
		$this->db->delete('Users', array('id_user' => $id)); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
}
