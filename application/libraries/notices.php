<?

class Notices{
	private $tab= array();
	private $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}
	
	function add($id, $type, $msg){
		$this->tab[$id][] = array(
			'type' => $type,
			'message' => $msg
		);
	}
	
	function save($id = NULL){
		if($id != NULL){
			if(!empty($this->tab[$id])){
				$this->CI->session->set_flashdata($id.'-notices', $this->tab[$id]);
			}
		}else{
			foreach($this->tab as $id => $data){
				$this->CI->session->set_flashdata($id.'-notices', $this->tab[$id]);
			}
		}
	}	
	
	function get($id){
		$data['notices'] = array();
		$tab = $this->tab[$id];
		if(is_array($tab))$data['notices'] = array_merge($data['notices'] , $tab);
		$flash = $this->CI->session->flashdata($id.'-notices');
		if(is_array($flash))$data['notices'] = array_merge($data['notices'] , $flash);
		
		return $this->CI->load->view('notices',$data,true);
	}
}
?>
	