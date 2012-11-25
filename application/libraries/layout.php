 
<?

/**
 * interfejs dla klas z folderu application/layouts/
 * 
 * @author Mateusz Russak
 */
interface MY_Layout{
	/** init
	* funkcja zwracająca domyślne dla layoutu dane
	*/
	function init();
	/** contentVar
	* zwraca nazwę elementu podstawowego Layoutu
	*/
	function contentVar();
	/** viewName
	* zwraca nazwę widoku powiązanego z layoutem - folder application/views/layouts/ 
	*/
	function viewName();
}


/**
 * Biblioteka Layout
 *
 * Służy do tworzenia stałych elementów strony, takich jak: logo, pasek tytułu, metadata itp.
 *
 * @author Mateusz Russak
 */
class Layout{
	private $CI;
	private $JSarray = array();
	private $CSSarray = array();
	private $loaded_layouts;
	private $layoutname = "default";
	private $layout = null;
	
	/**
	 * Konstruktor
	 */
	function __construct($config = null){
		$this->CI =& get_instance();
		
		if($config != null){
			$this->JSarray = $config["autoload_js"];
			$this->CSSarray = $config["autoload_css"];
			$this->layoutname = $config["default_layout"];
		}
		
		$this->setLayout($this->layoutname);
	}
	/**
	 * dodaj JavaScript
	 * 
	 * dodaje odniesienia do skryptów javascipt w nagłówku strony
	 * argument powinien być nazwą pliku z katalogu static/js/ bez rozszerzenia
	 * 
	 * @param srting
	 */
	function addJS($fname){
		$path = baseUrl()."static/js/".$fname.".js";
		$this->JSarray[] = "<script type='text/javascript' src='".$path."'></script>\n";
	}
	/**
	 * dodaj Style
	 * 
	 * dodaje pliki styli - css
	 * argument powinien być nazwą pliku z katalogu static/css/ bez rozszerzenia
	 *  
	 * @param srting
	 */
	function addCSS($fname){
		$path = baseUrl()."static/css/".$fname.".css";
		$this->CSSarray[] = "<link rel='stylesheet' type='text/css' media='all' href='".$path."' />";
	}
	/**
	 * ustaw Layout
	 * 
	 * ustawia Layout na klasę z folderu application/layouts/
	 * 
	 * argumentem powinna być nazwa pliku bez rozszerzenia w którym znajduje się klasa implementująca MY_Layout 
	 * Uwaga:
	 * 	klasa powinna się nazywać [nazwa pliku]_layout
	 * @param srting
	 */
	function set($name){
		if(!empty($loaded_layouts[$name])){
			$this->layout =& $loaded_layouts[$name];
		}else{
			require_once(APPPATH."layouts/".$name.".php");
			$classname = $name."_layout";
			$loaded_layouts[$name] = new $classname();
			$this->layout =& $loaded_layouts[$name];
			$this->layoutname = $name;
		}
	}
	/**
	 * widok
	 * 
	 * wypełnia główny element Layoutu ładując do niego widok
	 * 
	 * funkcja działą jak $this->load->view()
	 * @param string nazwa widoku
	 * @param array dane przekazywane do widoku
	 * @param bool czy wynik działania funkcji ma zostać zwrócony (true) czy wypisany (false) 
	 * 
	 */
	function view($path , $data = '', $ret = false){
		$data = $this->layout->init();
		$data[$this->layout->contentVar()] = $this->CI->load->view($path,$data,true);
		$data2['body'] = $this->CI->load->view('layouts/'.$this->layout->viewName(),$data,true);
		$data2['style_src'] = implode($this->CSSarray);
		$data2['scripts'] = implode($this->JSarray);
		return $this->CI->load->view('main',$data2,$ret);
	}
	
	
}
?>