<?
class Locations extends CI_Controller{
	public function index(){
		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
		$this->layout->addJS("maps2.google");
		$this->layout->addCSS("maps.google");
		$data['lat'] = $this->google->get_user_location();
		$data['user'] = $this->auth->user();
		$this->layout->view("locations/index",$data);
	//	print_r();
	}
	
	public function get_json(){
		$this->load->library("google");
		$data['user'] = $this->auth->user();
		$data['user']['location'] = $this->google->get_user_location();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
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
	//<3
}
?>