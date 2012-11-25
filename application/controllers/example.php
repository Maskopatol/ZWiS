<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** przykłądowa klasa wykorzystania Layoutów
 * 
 * @author Mateusz Russak
 */

class Example extends CI_Controller {

	public function index()
	{
		//wybów lauoutu z folderu application/layouts
		$this->layout->set('default');
		
		//dodawanie plików css
		$this->layout->addCSS('style.css');
		
		
		//dodawanie plików js
		$this->layout->addJS('jquery.js');
		
		
		//wyświetlenie widoku example/index
		$data['zmienna'] = "jakiś tekst zmiennej";
		$this->layout->view('example/index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
