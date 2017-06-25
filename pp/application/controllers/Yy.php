<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->database();
		$this->load->helper('url');
		$this->load->library(array('grocery_CRUD'));
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	
	public function index()
	{
		$codigo="";
		$numero=0;
		$estado="No existe";
		if(isset($_GET["mf"])){
			
		$codigo=$_GET["mf"];
		//$codigo=iconv('UTF-8', 'ISO-8859-1',$codigo);
		
//		$codigo=substr($codi,-10);
//		$codigo=$this->db->escape($codigo); 

		$query = $this->db->query("select * from jes_cod where codigo='".$codigo."'");
//		$query = $this->db->query("select * from jes_cod where elco='".$codigo."'");

		$row = $query->row();

		if (isset($row))
		{
			$numero=$row->nro;
			if(is_null($row->feventa)){
				$estado="No rendida";
			}elseif(is_null($row->ingresa)){
				$estado="Ingreso correcto";
				$query = $this->db->query("UPDATE jes_cod SET ingresa=now() WHERE codigo='".$codigo."'");
			}else{
				$estado="Ya ingreso";
			
			}		
		}	
		}
		$pasadatos= array(
            'codi' => $codigo,
            'estado' => $estado,
            'numero' => $numero
          );
		  
		$this->load->view('intis',$pasadatos);
	}

	public function revisoticket2 ()
	{
		$codigo="";
		$numero=0;
		$evento=0;
		$nevento=null;
		$vendedor=0;
		$nvendedor=null;
		$feventa=null;
		$ingresa=null;
		$estado="No existe";
		if(isset($_GET["mf"])){
			
		$codigo=$_GET["mf"];
		$query = $this->db->query("select * from jes_cod where codigo='".$codigo."'");

		$row = $query->row();

			if (isset($row))
			{
				$numero=$row->nro;
				$feventa=$row->feventa;
				$ingresa=$row->ingresa;
				$evento=$row->serie;
				$estado="Existe";
				$query = $this->db->query("select * from jes_entrega where ".$numero." between numdesde and numhasta");
				
				$row2= $query->row();
				if (isset($row2))
					{
					$vendedor=$row2->int_ven;
					
					}
			}
			
		}
		$pasadatos= array(
            'codi' => $codigo,
            'estado' => $estado,
            'numero' => $numero,
			'feventa' => $feventa,
			'ingresa' => $ingresa,
			'evento' =>	$evento,
			'nevento' => $nevento,
			'vendedor' => $vendedor,
			'nvendedor' => $nvendedor
			);
		  
		$this->load->view('revisoticket2',$pasadatos);
	
	
	}
	public function revisoticket ()
	{
	$this->load->model('yy_model');
	$pasadatos= array(
        'codi' => 0,
        'estado' => "leer codigo",
        'numero' => 0,
		'feventa' => null,
		'ingresa' => null,
		'evento' =>	null,
		'vendedor' => null
		);
		
	
	if(isset($_GET["mf"]))
		{
		$codigo=$_GET["mf"];
		$pasadatos = $this->yy_model->revisot($codigo);
			
		}	
		  
		$this->load->view('revisoticket',$pasadatos);
	
	}

	public function amano()
		{
		$codigo="";
		$numero=0;
		$estado="No existe";
		if(isset($_GET["mf"])){
			
		$codigo=$_GET["mf"];
		$query = $this->db->query("select * from jes_cod where nro=".$codigo);

		$row = $query->row();

		if (isset($row))
		{
			$numero=$row->nro;
			if(is_null($row->feventa)){
				$estado="No rendida";
				$query = $this->db->query("UPDATE jes_cod SET feventa=now() WHERE nro=".$codigo);
			}else{
				$estado="Ya ingreso";
			}		
		}	
		}
		$pasadatos= array(
            'codi' => $codigo,
            'estado' => $estado,
            'numero' => $numero
          );
		  
		$this->load->view('intos',$pasadatos);
	}
	
	public function mientras($evento=null)
	{
		if(is_null($evento))
		{
				$evento=1;
		}
		$query = $this->db->query("select * from jes_cod where serie= ".$evento." and not isnull(ingresa)");
		$cuanto=$query->num_rows();
		$query = $this->db->query("select * from jes_cod where serie= ".$evento." and not isnull(feventa)");
		$totalaentrar=$query->num_rows();
		$pasadatos= array(
            'cuanto' => $cuanto,
			'evento' => $evento,
			'totalaentrar' => $totalaentrar);
		  
		$this->load->view('mientras',$pasadatos);

	}



	
	public function coma()
	{
	$sacd=$this->db->get("jes_cod");
	foreach($sacd->result() as $fila)
		{
		echo $fila->elco."</br>";
		}
	}
	
	
	public function apro($elapa){
		echo $elapa;
		$query = $this->db->query("UPDATE jes_cod SET feventa=now() WHERE elco='".$elapa."'");
		$query = $this->db->query("select * from jes_cod where elco='".$elapa."'");

		$row = $query->row();

		if (isset($row))
		{
			$numero=$row->nro;
			if(is_null($row->feventa)){
				$estado="Disponible";
			}else{
				$estado="Vendida";
			}		
		}	
		$pasadatos= array(
            'codi' => $elapa,
            'estado' => $estado,
            'numero' => $numero
          );
		$this->load->view('listo',$pasadatos);
	}
	
	public function bye()
	{
		$this->load->view('sale');	
	}
	
	public function vertot()
	{
		$this->load->view('verto');		
	}
	
	public function cuenta($evento = null)
	{
		if(is_null($evento))
		{
				$evento=1;
		}
		$query = $this->db->query("select * from jes_cod where serie= ".$evento." and not isnull(feventa)");
			echo "Vendidos: ".$query->num_rows();
	}


	public function ccuenta($evento = null)
	{
		if(is_null($evento))
		{
				$evento=1;
		}
		$sql="select * from jes_cod where serie= ? and not isnull(feventa)";
		
		$query = $this->db->query($sql,array($evento));
//		echo $this->db->version();
		echo "</br>";
		echo "Vendidos: ".$query->num_rows();
		echo "</br>";
		foreach($query->result() as $sale)
		{
			echo $sale->nro;
			echo "</br>";	
		}
	}
	

	
	public function mecuenta()
	{
		$query = $this->db->query("select * from jes_cod where not isnull(feventa)");
	//	echo "Vendidos: ".$query->num_rows();	
	//		echo "</br>";
	//		header('Content-type: application/json');
			echo json_encode($query->result());
	//		echo "</br>";
	}	
	
	public function vi($mus)
	{
		echo $mus;
	}
	
	
	public function vendedore()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_language("spanish");
			$crud->set_theme('datatables');
			$crud->set_table('jes_ven');
			$crud->set_subject('Vendedores');
			$crud->required_fields('interno');
			$crud->columns('interno','apellido','fechain','dni','telefono','activo');


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function evente()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_language("spanish");
			$crud->set_theme('datatables');
			$crud->set_table('jes_eve');
			$crud->set_subject('Eventos');
			$crud->required_fields('interno');
			$crud->columns('interno','fecha','descrip','numdesde','numhasta','activo');


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
public function caja()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_language("spanish");
			$crud->set_theme('datatables');
			$crud->set_table('jes_caja');
			$crud->set_subject('Cajas Internas');
			$crud->required_fields('interno');
			$crud->columns('interno','descrip','activo');
			$crud->field_type('activo','true_false');
			//,array('1' => 'activo', '2' => 'inactivo'));

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function entrege()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_language("spanish");
			$crud->set_theme('datatables');
			$crud->set_table('jes_entrega');
			$crud->set_relation('int_ven','jes_ven','apellido');
			$crud->display_as('Int_ven','Vendedor');

			$crud->set_subject('Entrega de tickets');
			$crud->required_fields('interno');
			$crud->columns('interno','int_ven','int_eve','numdesde','numhasta');


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	



	public function products_management()
	{
			$crud = new grocery_CRUD();
			$crud->set_language("spanish");

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("spanish");

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();

		$this->_example_output($output);
	}

	public function film_management_twitter_bootstrap()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('film');
			$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			$crud->unset_columns('special_features','description','actors');

			$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$this->_example_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}

	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("spanish");
		$crud->set_table('offices');
		$crud->set_subject('Office');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function employees_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("spanish");

		$crud->set_theme('datatables');
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');

		$crud->required_fields('lastName');

		$crud->set_field_upload('file_url','assets/uploads/files');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function customers_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_language("spanish");

		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

}
