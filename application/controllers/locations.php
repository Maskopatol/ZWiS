<?
class Locations extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("locations_model");
	}
	
	public function index(){
				
		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.10&sensor=false");
		$this->layout->addJS("maps2.google");
		$this->layout->addCSS("maps.google");

		
		$lastLocations = $this->locations_model->get($this->auth->uid());
		$data['user'] = $this->auth->user();
		
		if($this->auth->is_logged_by_google()){
			$data['user']['location'] = $this->google->get_user_location();
		
			if($lastLocations[0]->latitude != $data['user']['location']['latitude'] 
				|| $lastLocations[0]->longitude != $data['user']['location']['longitude']){
				
				$d['id_user'] = $this->auth->uid();
				$d['latitude'] = $data['user']['location']['latitude'];
				$d['longitude'] = $data['user']['location']['longitude'];
				$this->locations_model->add($d);
			}
		}
		
		$this->layout->view("locations/index",$data);
		
	}
	
	public function get_json($id = NULL){
		if($id == NULL){
		//	$this->load->library("google");
			$data = $this->locations_model->getAll();
		}else{
			$data = $this->user_model->get($id);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function user_info($id){
		$data = $this->user_model->get($id);
		$this->load->view("locations/user_info", $data);
	}

	
	public function add_location(){
		//$lat = $this->input->post("latitude");
	}
	
	
	public function saveBuilding(){
		$this->load->model("buildings_model");
		$data = $this->input->post('data');
//		echo "<pre>";print_r($_POST);echo "</pre>";
		$data = explode("|",$data);
		$res = array();
		foreach($data as $point){
			if(!empty($point))
				$res[] = explode(",",$point);
		}
		$d['name'] = $this->input->post('name');
		$d['desc'] = $this->input->post('desc');
		$x = $this->buildings_model->add($d);
		$id = $x->id_building;
		$x->addPoints($res);
		$zx['id'] = $id;
		$this->output->set_content_type('application/json')->set_output(json_encode($zx));
	}
	
	public function loadBuildings(){
		$this->load->model("buildings_model");
		$b = $this->buildings_model->getAll();
		$data = array();
		foreach($b as $build){
			$d['id'] = $build->id_building;
			$d['name'] = $build->name;
	//		$d['desc'] = $build->desc;
			$d['points'] = $build->getPoints();
			$data[] = $d;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	public function building($id = null){
		if($id == null){
			$this->load->view("locations/building_form");
		}else{
			$this->load->model("buildings_model");
			$b = $this->buildings_model->get($id);
			$this->load->view('locations/building_info',$b);
		}
	}
	
	public function testBuildings(){
		
	}
	//<3
}
?>