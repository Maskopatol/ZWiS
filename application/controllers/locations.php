<?
class Locations extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("locations_model");
	}
	
	public function index(){
		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true");
		$this->layout->addJS("maps.google");
		$this->layout->addCSS("maps.google");
	//	$this->load->model("locations_model");
		$lastLocations = $this->locations_model->get($this->auth->uid());
		
		$data['user'] = $this->auth->user();
		$data['user']['location'] = $this->google->get_user_location();
		
//		echo "<pre>";
		
		if($lastLocations[0]->latitude != $data['user']['location']['latitude'] 
			|| $lastLocations[0]->longitude != $data['user']['location']['longitude']){
			
//			print_r($lastLocations[0]);
//			print_r($data['user']['location']);
			
			$d['id_user'] = $this->auth->uid();
			$d['latitude'] = $data['user']['location']['latitude'];
			$d['longitude'] = $data['user']['location']['longitude'];
			$this->locations_model->add($d);
		}
		
//		print_r($data);
//		echo "</pre>";
//		exit();
		
		$this->layout->view("locations/index",$data);
	//	print_r();
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
	
	public function test(){
		
		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.10&sensor=false");
		$this->layout->addJS("maps2.google");
		$this->layout->addCSS("maps.google");

		$data['user'] = $this->auth->user();
		$data['user']['location'] = $this->google->get_user_location();
		
		

		$this->layout->view("locations/test",$data);
	}
	
	public function saveBuilding(){
		$data = $this->input->post('data');
		echo "<pre>";print_r($_POST);echo "</pre>";
		$data = explode("|",$data);
		$res = array();
		foreach($data as $point){
			if(!empty($point))
				$res[] = explode(",",$point);
		}
		echo "<pre>";print_r($res);echo "</pre>";
	}
	
	public function building_form(){
		$this->load->view("locations/building_form");
	}
	
	public function testBuildings(){
		
	}
	//<3
}
?>