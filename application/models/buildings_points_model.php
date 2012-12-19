<?
class Buildings_points_model extends CI_Model{
	
	public function get($id_building){
		$this->db->from('buildings_points');
		$this->db->where('id_building',$id_building);
		$this->db->order_by('id_point');
		$q = $this->db->get();
		$points = array();
		foreach($q->result("Buildings_points_model") as $point){
			$points[] = $point;
		}
		return $points;
	}
}

?>