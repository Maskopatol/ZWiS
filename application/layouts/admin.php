<?
/** przygładowy/domyślny Layout
 *
 * @author Mateusz Russak
 */

class admin_layout implements MY_Layout{
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
		$data['menubar'] = $this->CI->load->view('menubar_admin','',true);
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
		return "default";
	}

	function css(){
		return array('default');
	}

	function js(){
		return array();
	}
}
?>
