<?

class Faculty_model extends CI_Model {


	function find($string){
		$this->db->like('name',$string);
		$q = $this->db->get('faculty');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $q->result_array();
	}
	
	function find_in_uni($string, $id){
		$this->db->like('name',$string);
		$this->db->where('id_uni',$id);
		$q = $this->db->get('faculty');

		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $q->result_array();
	}

	function all(){
		$query = $this->db->get('faculty');
		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $query->result_array();
	}
	
	function all_in_uni($id){
		$this->db->where('id_uni',$id);
		$query = $this->db->get('faculty');
		if($this->db->_error_number()!=0){
			return NULL;
		}
		return $query->result_array();
	}

	function get($item){
		$this->db->where('id',$item);
		$query = $this->db->get('faculty');
		
		if($this->db->_error_number()!=0){
			return NULL;
		}
		$result = $query->result_array();
		return $result[0];
	}

	function create($data){	
		$this->db->insert('faculty',$data);
		
		if($this->db->_error_number()!=0)
			return false;

		return true;
	}

	
	function update($id , $data){
		$this->db->where('id', $id);
		$this->db->update('faculty', $data); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
	function delete($id){
		$this->db->delete('faculty', array('id' => $id)); 
		if($this->db->_error_number()!=0){
			return false;
		}
		
		return true;
	}
	
	
	
}
