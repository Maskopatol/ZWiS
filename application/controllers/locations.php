<?
class Locations extends CI_Controller{
	public function index(){
		$this->load->library("google");
		$this->layout->addJS("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
		$this->layout->addJS("maps.google");
		$this->layout->addCSS("maps.google");
		$data['lat'] = $this->google->get_user_location();
		$data['user'] = $this->auth->user();
		$this->layout->view("locations/index",$data);
	//	print_r();
	}
}
?>