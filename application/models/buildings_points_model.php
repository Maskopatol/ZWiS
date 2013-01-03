<?
class Buildings_points_model extends CI_Model{
	
	public function add($points, $id_building){
		$data = array();
		for($i = 0 ; $i < count($points) ; $i++){
			$data[$i]['id_point'] = $i;
			$data[$i]['id_building'] = $id_building;
			$data[$i]['latitude'] = $points[$i][0];
			$data[$i]['longitude'] = $points[$i][1];
		}
		$this->db->insert_batch('buildings_points', $data); 
	}
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