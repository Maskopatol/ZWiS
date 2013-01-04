<?
/**
 * User_model
 * klasa służąca do zapisu, odczytu i modyfikacji danych użytkownika w bazie danych.
 * @author Mateusz Russak
 */

class Locations_model extends CI_Model {
	public $id_user;
	public $add_date;
	public $latitude;
	public $longitude;

	function getAll(){
		$this->load->model("user_model");
		$r = $this->db->get("locations");
		$l = NULL;
		foreach($r->result("Locations_model") as $location){
			$u = $this->user_model->get($location->id_user);
			$l[$location->id_user]['name'] = $u['name']." ".$u['surname'];
			$l[$location->id_user]['locations'][] = $location;
		}
		return $l;
	}

	function getUsers(){
		$q = $this->db->query("select u.id_user, u.name , u.surname,u.photo, u.lecturer , u.static_location ,l.id_location, l.latitude , l.longitude from users u left join locations l on (IFNULL(u.static_location,(select max(lo.id_location) from locations lo where lo.id_user = u.id_user ))) = l.id_location and l.id_user = u.id_user");
		return $q->result_array();
	}


	function get($uid){
		$this->db->from("locations");
		$this->db->where("id_user",$uid);
		$this->db->order_by("add_date","DESC");
		$q = $this->db->get();
		return $q->result("Locations_model");
	}

	function add($data){
		$this->db->insert('locations',$data);
		return $this->db->insert_id();
	}

	function del($id){
		$this->db->delete('locations',array('id_location'=>$id));
	}


	function getBuildings(){

	}

	function addBuilding(){

	}

}
