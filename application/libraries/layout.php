 
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
	private $CSSs = array();
	private $JSs = array();
	
	private $loaded_layouts;
	private $layoutname = "default";
	private $layout = null;
	
	private $pagetitle = null;
	private $subpagetitle =null;
	
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
		if(isset($config["page_title"]))
			$this->pagetitle = $config["page_title"];
		$this->set($this->layoutname);
	}
	/**
	 * dodaj JavaScript
	 * 
	 * dodaje odniesienia do skryptów javascipt w nagłówku strony
	 * argument powinien być nazwą pliku z katalogu static/js/ bez rozszerzenia
	 * 
	 * @param srting
	 */
	 
	private function _createJS($fname){
		$path = base_url()."static/js/".$fname.".js";
		$this->JSs[] = "<script type='text/javascript' src='".$path."'></script>\n";
	}
	/**
	 * dodaj Style
	 * 
	 * dodaje pliki styli - css
	 * argument powinien być nazwą pliku z katalogu static/css/ bez rozszerzenia
	 *  
	 * @param srting
	 */
	private function _createCSS($fname){
		$path = base_url()."static/css/".$fname.".css";
		$this->CSSs[] = "<link rel='stylesheet' type='text/css' media='all' href='".$path."' />";
	}
	
	/**
	 * setPageTitle
	 * ustawia tytuł strony w pasku adresu
	 * @param string - tytuł
	 */
	function setPageTitle($string){
		$this->pagetitle = $string;
	}
	/**
	 * setSubpageTitle
	 * ustawia tytuł podstrony w pasku adresu "[tytuł strony] - [tytul podstrony]"
	 * @param string - tytuł podstrony
	 */
	function setSubpageTitle($string){
		$this->subpagetitle = $string;
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
	function view($path , $udata = '', $ret = false){
		$data = $this->layout->init();
		$data[$this->layout->contentVar()] = $this->CI->load->view($path,$udata,true);
		$data2['body'] = $this->CI->load->view('layouts/'.$this->layout->viewName(),$data,true);
		$data2['style_src'] = '';
		$data2['scripts'] = '';
		foreach($this->JSarray as $js)
			$data2['scripts'] .= addJS($js);
		foreach($this->CSSarray as $css)
			$data2['scripts'] .= addCSS($css);  
		
		$data2['pagetitle'] = $this->pagetitle;
		$data2['subpagetitle'] = $this->subpagetitle;
		return $this->CI->load->view('main',$data2,$ret);
	}
	
	
}
?>