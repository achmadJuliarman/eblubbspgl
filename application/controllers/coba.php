<?php

class Coba extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang'));
	}

	public function index()
	{
		//$url="http://jsonplaceholder.typicode.com/posts/";
		$url="http://jlt.lemigas.esdm.go.id:3000/api/ws_rencana_operasional";
		$get_url = file_get_contents($url);
		$data = json_decode($get_url);
		$data_array = array(
		'datalist' => $data
		);
		$this->load->view('admin/json',$data_array);
	}

	public function kontrak()
	{
		//$url="http://jsonplaceholder.typicode.com/posts/";
		$tahun = DATE('Y');
		//$url="http://jlt.lemigas.esdm.go.id:3000/api/ws_termin?_where=(termin_tgl,like,$tahun~)";
		$url="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20SUM(termin_nilai)AS%20jumlah%20FROM%20ws_termin%20WHERE%20YEAR(termin_tgl)=2020%20AND%20status=3";
		//$url="http://jlt.lemigas.esdm.go.id:3000/api/ws_target";
		//$url='http://jlt.lemigas.esdm.go.id/db2json.php?qu=select%20*%20from%20ws_target';
		//$url="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20from%20ws_termin%20WHERE%20YEAR(termin_tgl)=2020";
		$get_url = file_get_contents($url);
		print_r($get_url);
		//$json = json_encode($get_url);
		//echo $json;

		var_dump(file_get_contents($url));
		//$jsonobj = '[{"jumlah":"20814266697.00"}]';
		$data = json_decode($url);
		echo $data->jumlah;
		//echo "<br/>";
		//$jsonobj2 = '{"jumlah":"20814266697.00"}';
		//var_dump(json_decode($jsonobj2));
		//$data_json = json_decode($jsonobj);
		//echo $data_json->jumlah;
		//$get_url = file_get_contents($url);
		//$data_json = json_decode($get_url);

		$array = array('id'=>1, 'nama'=>'Andi Prayoga');
 		echo $array['nama'];

 		$json = json_encode($array);

 		$array = json_decode($json);
 		echo $array->id;

		//echo $data[0]['jumlah'];

		//$content=utf8_encode($get_url);
	  //mengubah data json menjadi data array asosiatif
	  //$result=json_decode($content,true);
		// foreach ($data as $value)
		// {
		// 	echo $value->id;
		// }

		//echo $data_json->jumlah;
		// $data_array = array(
		// 'datalist' => $data
		// );
		//$data['kontrak_lemigas'] = $data_json;
		//$this->load->view('admin/json_kontrak',$data);
	}

}
?>
