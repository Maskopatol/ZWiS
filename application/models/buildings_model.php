<?



class Buildings_model extends CI_Model{    
        public $id_building;
        public $name;
		public $desc;
	
		
	public function add($data){
		$this->name = $data['name'];
		$this->desc = $data['desc'];
		$this->db->insert('buildings' , $data);
		$this->id_building = $this->db->insert_id();
		return $this;
	}
	
	public function addPoints($points,$id_building=null){
		$this->load->model("buildings_points_model");
		if($id_building == null){
			$id_building = $this->id_building;
		}
		return $this->buildings_points_model->add($points,$id_building);
	}
	
	public function getPoints($id_building = null){
		$this->load->model("buildings_points_model");
		if($id_building == null){
			$id_building = $this->id_building;
		}
		return $this->buildings_points_model->get($id_building);
	}
	public function get($id_building){
		$this->db->from('buildings');
		$this->db->where('id_building',$id_building);
		$q = $this->db->get();
		if($q->num_rows() == 0) return null;
		$r = $q->row("Buildings_model");
		return $r;
	}
	public function getAll(){
		$this->db->from('buildings');
		$q = $this->db->get();
		if($q->num_rows() == 0) return null;
		return $q->result("Buildings_model");
	}
	

}