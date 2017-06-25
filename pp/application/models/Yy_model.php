<?php

class Yy_model  extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }
	
	public function revisot($qr_completo)
    {
		$query = $this->db->query("select * from jes_cod where codigo='".$qr_completo."'");
		$row = $query->row();
		if (isset($row)){
		$vende=$this->detecta_vendedor($row->nro);
		$matriz_data_ticket= array(
			'codi' => $row->codigo,
			'estado' => "existe",
			'numero' => $row->nro,
			'feventa' => $row->feventa,
			'ingresa' => $row->ingresa,
			'evento' =>	$this->evento($row->serie),
			'vendedor' => $this->vendedor($this->detecta_vendedor($row->nro))
			);
		}
		else{
		$matriz_data_ticket= array(
			'codi' => $qr_completo,
			'estado' => "No existe",
			'numero' => 0,
			'feventa' => null,
			'ingresa' => null,
			'evento' =>	null,
			'vendedor' => null
			);
		};

		return $matriz_data_ticket;
	}
	
	public function detecta_vendedor($numeracion_habilitada)
	{
		$query= $this->db->query("select * from jes_entrega where ".$numeracion_habilitada." between numdesde and numhasta");
		$row = $query->row();
		if(isset($row))
			{
				$devuelve=$row->int_ven;
			}else
			{
				$devuelve=null;
			}
		return $devuelve;		
	}

	public function vendedor($int_vendedor)
	{
		$query = $this->db->query("select * from jes_ven where interno='".$int_vendedor."'");
		$row = $query->row();
		if(isset($row))
			{
				$devuelve=$row->interno." - ".$row->apellido." - ".$row->telefono;
			}else
			{
				$devuelve="No encontrado";
			}

		return $devuelve;
	}
	
	public function evento($int_evento)
	{
		$query = $this->db->query("select * from jes_eve where interno='".$int_evento."'");
		$row = $query->row();
		if(isset($row))
			{
				$devuelve=$row->interno." - ".$row->descrip." - ".$row->fecha;
			}else
			{
				$devuelve="No encontrado";
			}
		return $devuelve;
		
	}
}