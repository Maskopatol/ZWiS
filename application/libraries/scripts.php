<?
class Scripts{

	private $CI;
	private $location;
	function __construct(){
		$this->CI =& get_instance();
		$this->location = APPPATH."scripts/";
	}

	function get($name){
		$dirname = $this->location.$name;
		$files = dir($dirname);
		$data = "";
		while (false !== ($file = $files->read())) {
			if(strpos($file , ".") != 0){
				$data .= file_get_contents($dirname."/".$file);

			}
		}
		$files->close();
		return $data;
	}

}
?>
