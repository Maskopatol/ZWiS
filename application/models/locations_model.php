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
	
	function get($uid){
		$this->db->from("locations");
		$this->db->where("id_user",$uid);
		$this->db->order_by("add_date","DESC");
		$q = $this->db->get();
		return $q->result("Locations_model");
	}
	
	function add($data){
		$this->db->insert('locations',$data);
	}
	
	
	function getBuildings(){
		
	}
	
	function addBuilding(){
		
	}
	
}
