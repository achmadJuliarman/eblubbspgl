<?php

class Test extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function surat_penagihan()
	{
		$this->load->view('admin/surat_penagihan_tekmira');
	}


}
?>
