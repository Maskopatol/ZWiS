<?
class Locations extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("locations_model");
	}
	
	public function index(){
		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
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
		}else{
			echo "takie same!!";
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
	public function get($id){
		$data['user'] = $this->user_model->get($id);
		$this->load->view('home/userinfo',$data);
	}
	
	public function add_location(){
		//$lat = $this->input->post("latitude");
	}
	
	public function test(){
		
		$this->load->library("google");
	//	$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
	//	$this->layout->addJS("test");
		$this->layout->addJS("http://maps.google.com/maps/api/js?sensor=true");
	//	$this->layout->addJS("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js");
		$this->layout->addJS("jquery-maps/ui/jquery.ui.map");
		$this->layout->addJS("jquery-maps/ui/jquery.ui.map.extensions");
		$this->layout->addJS("jquery-maps/ui/jquery.ui.map.overlays");
		$this->layout->addJS("jquery-maps/ui/jquery.ui.map.rdfa");
		$this->layout->addJS("jquery-maps/ui/jquery.ui.map.services");
		$this->layout->addCSS("maps.google");
		$data['user']['location'] = $this->google->get_user_location();
		$data['user'] = $this->auth->user();
		$this->layout->view("locations/test",$data);
	}
	
	public function saveBuilding(){
		$data = $this->input->post('data');
		$data = explode("|",$data);
		$res = array();
		foreach($data as $point){
			if(!empty($point))
				$res[] = explode(",",$point);
		}
		echo "<pre>";print_r($res);echo "</pre>";
	}
	//<3
}
?>