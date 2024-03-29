<?
class Locations extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("locations_model");
	}

	public function index(){

		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.10&sensor=false");
		$this->layout->addJS("http://localhost/index.php/locations/script");
//		$this->layout->addJS("test");
		$this->layout->addCSS("maps.google");


		$lastLocations = $this->locations_model->get($this->auth->uid());
		$data['user'] = $this->auth->user();

		if($this->auth->is_logged_by_google()){
			try{
				$data['user']['location'] = $this->google->get_user_location();

				if($lastLocations[0]->latitude != $data['user']['location']['latitude']
					|| $lastLocations[0]->longitude != $data['user']['location']['longitude']){

					$d['id_user'] = $this->auth->uid();
					$d['latitude'] = $data['user']['location']['latitude'];
					$d['longitude'] = $data['user']['location']['longitude'];
					$this->locations_model->add($d);
				}
			}catch(Google_ServiceException $e){

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

	public function set_static(){
		$data['id_user'] = $this->auth->uid();
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$id = $this->locations_model->add($data);
		$this->user_model->set_static($id , $this->auth->uid());
	}
	public function unset_static(){
		$user = $this->auth->user();
		if($user['static_location'] != null){
			$this->locations_model->del($user['static_location']);
			$this->user_model->set_static(null , $this->auth->uid());
		}else{
			$this->output->set_status_header('404');
		}
	}

	public function loadUsers(){
		$a = $this->locations_model->getUsers();
	//	print_r($a);
		$this->output->set_content_type('application/json')->set_output(json_encode($a));
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
		$d['id_university'] = $this->input->post('uni');
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
			$unis = $this->Uni_model->all();
			$options['null'] = "Wybierz";
			foreach ($unis as $u)
				$options[$u['id']] = $u['name'];
			$data['options'] = $options;

			$this->load->view("locations/building_form",$data);
		}else{
			$this->load->model("uni_model");
			$this->load->model("buildings_model");
			$b = $this->buildings_model->get($id);
			$u = $this->uni_model->get($b->id_university);
			//print_r($u);
			$d["name"] = $b->name;
			$d["desc"] = $b->desc;
			$d["uni_name"] = $u['name'];
			$this->load->view('locations/building_info',$d);
		}
	}

	public function script(){

		$this->load->library("scripts");
	//	file_put_contents("/var/www/localhost/htdocs/static/js/test.js",$this->scripts->get("mapsV2"));
		$this->output
			->set_content_type('application/x-javascript')
			->set_output($this->scripts->get("mapsV2") );
	}



	public function find($string){
		$this->load->model('buildings_model');
		$result = array();
		if($this->input->post('buildings')){
			$result['buildings'] = $this->buildings_model->find($string);
		}
		if($this->input->post('lecturers')){
			$result['lecturers'] = $this->user_model->find($string , 1);
		}
		if($this->input->post('students')){
			$result['students'] = $this->user_model->find($string , 0);
		}
		$result['users'] = array_merge($result['lecturers'],$result['students']);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}
?>
