<?
/** 
 * layout strony logowania
 * @author Mateusz Russak 
 */

class intro_layout implements MY_Layout{
	
	private $CI;
	/**
	 * konstruktor 
	 */
	function __construct(){
		$this->CI =& get_instance();
	
	}
	/**
	 * init
	 * tworzy górny pasek menu 
	 */
	function init(){
		$data['content'] = '';
		return $data;
	}
	/** 
	 * contentVar
	 * mówi że zmienna 'content' jest podstawowym elementem strony - 
	 * czyli $this->layout->view() będzie wypełniać włąśnie tą zmienną 
	 */
	function contentVar(){
		return "content";
	}
	/**
	 * viewName
	 * widokiem dla layoutu jest plik views/layouts/default.php w którym zmienna contentVar()
	 * zostanie wypełniona przy wywołaniu $this->layout->view()
	 */
	function viewName(){
		return "intro";
	}
	
	function css(){
		return array('intro');
	}
	function js(){
		return array();
	}
}
?>