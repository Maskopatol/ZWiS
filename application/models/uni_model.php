<?

class Uni_model extends CI_Model {


	function find($string){
		$this->db->like('name',$string);
		$this->db->or_like('home_page',$string);
		$q = $this->db->get('university');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $q->result_array();
	}

	function all(){
		$query = $this->db->get('university');
		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $query->result_array();
	}

	function get($item){
		$this->db->where('id',$item);
		$query = $this->db->get('university');
		
		if($this->db->_error_number()!=0){
			return NULL;
		}
		$result = $query->result_array();
		return $result[0];
	}

	function create($data){	
		$this->db->insert('university',$data);
		
		if($this->db->_error_number()!=0)
			return false;

		return true;
	}

	
	function update($id , $data){
		$this->db->where('id', $id);
		$this->db->update('university', $data); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
	function delete($id){
		$this->db->delete('university', array('id' => $id)); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
	
	function get_all_unis()
	{
		$all_unis = array();

		$sql = "SELECT	name,
						address,
						established,
						students,
						home_page,
						is_public,
						id
				FROM `university` 
				ORDER BY `university`.`students` DESC";

		$query = $this->db->query($sql);

		foreach($query->result("uni_model") as $university)
		{
			$all_unis[] = $university;
		}
		return $all_unis;
	}
	
}
