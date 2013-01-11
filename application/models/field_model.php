<?

class Field_model extends CI_Model {


	function find($string){
		$this->db->like('name',$string);
		$q = $this->db->get('field_of_study');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $q->result_array();
	}
	
	function find_in_faculty($string, $id){
		$this->db->like('name',$string);
		$this->db->where('id_faculty',$id);
		$q = $this->db->get('field_of_study');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $q->result_array();
	}

	function all(){
		$query = $this->db->get('field_of_study');
		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $query->result_array();
	}
	
	function all_in_faculty($id){
		$this->db->where('id_faculty',$id);
		$query = $this->db->get('field_of_study');
		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $query->result_array();
	}

	function get($item){
		$this->db->where('id',$item);
		$query = $this->db->get('field_of_study');
		
		if($this->db->_error_number()!=0){
			return NULL;
		}
		$result = $query->result_array();
		return $result[0];
	}

	function create($data){	
		$this->db->insert('field_of_study',$data);
		
		if($this->db->_error_number()!=0)
			return false;

		return true;
	}

	
	function update($id , $data){
		$this->db->where('id', $id);
		$this->db->update('field_of_study', $data); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
	function delete($id){
		$this->db->delete('field_of_study', array('id' => $id)); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
	function get_all_in_faculty($id)
	{
		$all_field = array();

		$sql = "SELECT	id,
						name,
						info
				FROM `field_of_study`
				WHERE id_faculty = $id
				ORDER BY `field_of_study`.`name` ASC";

		$query = $this->db->query($sql);

		foreach($query->result("field_model") as $field)
		{
			$all_field[] = $field;
		}
		return $all_field;
	}
}
