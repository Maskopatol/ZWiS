<?
/**
 * auth
 * Klasa służąca do autoryzacji użytkowników
 * 
 * @author Mateusz Russak
 */
class auth{
	private $CI;
	private $usr = NULL;
	/**
	 * Konstruktor
	 */
	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('user_model');
		$this->CI->load->library('session');
	}
	
	/**
	 * user
	 * zwraca dane zalogowanego użytkownika
	 * 
	 * jeśli użytkownik nie jest zalogowany zwraca NULL
	 * @return array
	 */
	public function user(){
		if($this->usr==NULL){
			$uid = $this->CI->session->userdata('user_id');
			if(!empty($uid)){
				$this->usr = $this->CI->user_model->get($uid);
			}
		}
		return $this->usr;
	}
	
	/**
	 * is_logged
	 * czy zalogowany?
	 * @return bool
	 */
	public function is_logged(){
		$uid = $this->CI->session->userdata('user_id');
		if(!empty($uid)){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_logged_by_google(){
		$g = $this->CI->session->userdata('logged_with_google');
		if(!empty($g) && $q ==true){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * uid
	 * zwraca id użytkownika , jak użytkownik nie jest zalogowany - null
	 * @return int 
	 */
	public function uid(){
		$uid = $this->CI->session->userdata('user_id');
		if(!empty($uid)){
			return $uid;
		}else{
			return null;
		}
	}
	
	/**
	 * login
	 * zalogowanie użytkownika
	 * @param string - nazwa użytkownika
	 * @param string - hasło użytkownika
	 * @return bool - czy logowanie powiodło się
	 */
	
	public function login($email , $pass){
		$user = $this->CI->user_model->get($email);
		if($user!= null){
			$pass = sha1($pass);
			if($user['password'] == $pass){
				$this->CI->session->set_userdata('user_id' , $user['id_user']);
				$this->usr = $user;
				return true;
			}
		}
		return false;
	}
	/**
	 * login_with_google
	 * zalogowanie użytkownika za pomocą Google oauth2
	 * 
	 * @return bool - czy logowanie powiodło się
	 */
	public function google_login(){
		$this->CI->load->library("google");
		$guser = $this->CI->google->login($_GET['code']);
	
		$user = $this->CI->user_model->get($guser['email']);
		if($user == NULL){
			print_r($guser);
			$data['name'] = $guser['given_name'];
			$data['surname'] = $guser['family_name'];
			$data['email'] = $guser['email'];
			$data['photo'] = $guser['picture'];
			$data['password'] = sha1(uniqid());
			if($this->CI->user_model->create($data)){
				$id = $this->CI->user_model->new_user_id();
				$this->CI->session->set_userdata('user_id' , $id);
				$this->CI->session->set_userdata('logged_with_google' , true);
				return true;
			}
		}else{
			$this->CI->session->set_userdata('user_id' , $user['id_user']);
			$this->CI->session->set_userdata('logged_with_google' , true);
			return true;
		}
		return false;
		
	}
	
	public function google_login_link(){
		$this->CI->load->library("google");
		return $this->CI->google->authUrl();
	}
	
	/**
	 * logout
	 * wylogowanie użytkownika
	 */
	public function logout(){
		$this->CI->load->library("google");
		$this->CI->session->unset_userdata('user_id');
		if($this->CI->session->userdata('logged_with_google')){
			$this->CI->google->logout();
			$this->CI->session->unset_userdata('logged_with_google');
		}
	} 
}
?>