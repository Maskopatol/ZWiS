 
<?

require_once "Google/Google_Client.php";
require_once "Google/contrib/Google_Oauth2Service.php";
require_once 'Google/contrib/Google_LatitudeService.php';
class Google {
	
	private $CI;
	public $client;
	public $oauth2;
	public $latitude;

	function __construct($config){
		$this->CI =& get_instance();
		try{
			$this->client = new Google_Client();
			$this->client->setApplicationName($config['applicationName']);
			$this->client->setClientId($config['clientId']);
			$this->client->setClientSecret($config['clientSecret']);
			$this->client->setRedirectUri($config['redirectUri']);
			$this->client->setDeveloperKey($config['developerKey']);
			$this->oauth2 = new Google_Oauth2Service($this->client);
			$this->latitude = new Google_LatitudeService($this->client);
			$token = $this->CI->session->userdata('google_token');
			if (!empty($token)) {
				$this->client->setAccessToken($token);
			}
		}catch(Exeption $e){
			echo $e->getMessage();
		}
	}
	
	function authUrl(){
		return $this->client->createAuthUrl();
		
	}
	
	function get_user(){
		if ($this->client->getAccessToken()) {
 			return $this->oauth2->userinfo->get();
 		}else{
 			return NULL;
		}
	}
	
	function get_user_location(){
		if ($this->client->getAccessToken()) {
 			return $this->latitude->currentLocation->get(array('granularity'=>"best"));
 		}else{
 			return NULL;
		}
		
	}
	
	function login($code = NULL){
		if ($code != NULL) {
			$this->client->authenticate($code);
			$this->CI->session->set_userdata('google_token',$this->client->getAccessToken());
			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			redirect(filter_var($redirect, FILTER_SANITIZE_URL) , "location");
			return;
		}else{
			return $this->get_user();
		}
		
	}
	function logout(){
		$this->CI->session->unset_userdata('google_token');
		$this->client->revokeToken();
	}

}
?>