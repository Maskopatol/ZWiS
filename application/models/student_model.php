<?

class Student_model extends CI_Model
{
	function set_student($id_user, $id_fos)
	{
		$data = array(
			'id_user' => $id_user ,
			'id_fos' => $id_fos
		);
		$this->db->insert('students', $data);
		if($this->db->_error_number()!=0){
				return false;
			}
		return true;
	}
	
}
