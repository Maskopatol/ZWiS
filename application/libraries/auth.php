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
	public function login_with_google(){
		//TODO: logowanie za pomocą google oauth2
	}
	
	/**
	 * logout
	 * wylogowanie użytkownika
	 */
	public function logout(){
		$this->CI->session->unset_userdata('user_id');
	} 
}
?>