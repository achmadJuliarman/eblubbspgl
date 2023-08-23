<?php

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang'));
	}

	function index()
	{
		$data['isi'] = 'home/content';
		$this->load->view('home/index',$data);
	}

	function upload()
	{
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$uploadpath = './uploads';
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '20000';
		//$config['file_name'] = "1SuratTugas";
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file'))
		{
			$error = $this->upload->display_errors();
			echo '<script>alert("Data Gagal Disimpan!'.$error.'");</script>';
			//echo $id_kontrak;
			redirect('home/afin_detail_kontrak?id='.$id_kontrak,'refresh');
		}
		else
		{
			$upload = $this->upload->data();
			$file	= $upload['file_name'];
			$this->db->query("UPDATE kontrak SET file='$file' WHERE id_kontrak=$id_kontrak");
			echo '<script>alert("Data Berhasil disimpan");</script>';
			redirect('home/afin_detail_kontrak?id='.$id_kontrak,'refresh');
		}
	}

	// AFIN

	function afin_index()
	{
		$data['isi'] = 'admin/afin_content';
		$data['result'] = $this->m_kontrak->list_kontrak()->result();
		$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('admin/index',$data);
	}

	function afin_inbox()
	{
		$data['isi'] = 'home/afin_inbox';
		$this->load->view('home/afin_index',$data);
	}

	function afin_input_kontrak()
	{
		$data['isi'] = 'home/afin_input_kontrak';
		$this->load->view('home/afin_index',$data);
	}

	function afin_aksi()
	{
		$data['isi'] = 'home/afin_aksi';
		$this->load->view('home/afin_index',$data);
	}

	function afin_detail_kontrak()
	{
		$data['isi'] = 'home/afin_detail_kontrak';
		$this->load->view('home/afin_index',$data);
	}

	function afin_upload()
	{
		$data['isi'] = 'home/afin_upload';
		$this->load->view('home/afin_index',$data);
	}

	function afin_upload2()
	{
		$data['isi'] = 'home/afin_upload2';
		$this->load->view('home/afin_index',$data);
	}

	function afin_adendum()
	{
		$data['isi'] = 'home/afin_adendum';
		$this->load->view('home/afin_index',$data);
	}

	function afin_approve_adendum()
	{
		$data['isi'] = 'home/afin_approve_adendum';
		$this->load->view('home/afin_index',$data);
	}












	// PIC
	function pic_index()
	{
		$data['isi'] = 'home/pic_content';
		$this->load->view('home/pic_index',$data);
	}

	function pic_inbox()
	{
		$data['isi'] = 'home/pic_inbox';
		$this->load->view('home/pic_index',$data);
	}

	function pic_detail_kontrak()
	{
		$data['isi'] = 'home/pic_detail_kontrak';
		$this->load->view('home/pic_index',$data);
	}

	function pic_input_kegiatan()
	{
		$data['isi'] = 'home/pic_input_kegiatan';
		$this->load->view('home/pic_index',$data);
	}

	function pic_input_ro()
	{
		$data['isi'] = 'home/pic_input_ro';
		$this->load->view('home/pic_index',$data);
	}

	function pic_hapus_ro()
	{
		$data['isi'] = 'home/pic_hapus_ro';
		$this->load->view('home/pic_index',$data);
	}

	function pic_hapus_pengajuan()
	{
		$data['isi'] = 'home/pic_hapus_pengajuan';
		$this->load->view('home/pic_index',$data);
	}

	function pic_aksi()
	{
		$data['isi'] = 'home/pic_aksi';
		$this->load->view('home/pic_index',$data);
	}

	function pic_sendiri()
	{
		$data['isi'] = 'home/pic_sendiri';
		$this->load->view('home/pic_index',$data);
	}

	function pic_lihat_solusi()
	{
		$data['isi'] = 'home/pic_lihat_solusi';
		$this->load->view('home/pic_index',$data);
	}

	function pic_lihat_solusi_close()
	{
		$data['isi'] = 'home/pic_lihat_solusi_close';
		$this->load->view('home/pic_index',$data);
	}

	function pic_input_pengajuan()
	{
		$data['isi'] = 'home/pic_input_pengajuan';
		$this->load->view('home/pic_index',$data);
	}

	function pic_konfirm_bukti(){
		$data['isi'] = 'home/pic_konfirm_bukti';
		$this->load->view('home/pic_index',$data);
	}

	function pic_input_termin()
	{
		$data['isi'] = 'home/pic_input_termin';
		$this->load->view('home/pic_index',$data);
	}

	function pic_edit_termin()
	{
		$data['isi'] = 'home/pic_edit_termin';
		$this->load->view('home/pic_index',$data);
	}

	function pic_edit_ro()
	{
		$data['isi'] = 'home/pic_edit_ro';
		$this->load->view('home/pic_index',$data);
	}

	function pic_tampilan()
	{
		$data['isi'] = 'home/pic_tampilan';
		$this->load->view('home/pic_index',$data);
	}

	function pic_dash2()
	{
		$data['isi'] = 'home/pic_dash2';
		$this->load->view('home/pic_index',$data);
	}

	function pic_rencana_pendapatan()
	{
		$data['isi'] = 'home/pic_rencana_pendapatan';
		$this->load->view('home/pic_index',$data);
	}

	function pic_gantt()
	{
		$data['isi'] = 'home/pic_gantt';
		$this->load->view('home/pic_index',$data);
	}

	function pic_realisasi()
	{
		$data['isi'] = 'home/pic_realisasi';
		$this->load->view('home/pic_index',$data);
	}

	function pic_pengajuan_adendum()
	{
		$data['isi'] = 'home/pic_pengajuan_adendum';
		$this->load->view('home/pic_index',$data);
	}

	function pic_lihat_perubahan()
	{
		$data['isi'] = 'home/pic_lihat_perubahan';
		$this->load->view('home/pic_index',$data);
	}

	function pic_rencana_gantt()
	{
		$data['isi'] = 'home/pic_rencana_gantt';
		$this->load->view('home/pic_index',$data);
	}

	function coba_pb()
	{
		// $this->load->view('home/coba_pb');

		$data['isi'] = 'home/coba_pb';
		$this->load->view('home/pic_index',$data);
	}


	function afin_content()
	{

		$this->load->view('home/afin_content');
	}



	// KEUANGAN . TATA USAHA
	function tata_usaha_index()
	{
		$data['isi'] = 'home/tata_usaha_content';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_inbox()
	{
		$data['isi'] = 'home/tata_usaha_inbox';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_aksi()
	{
		$data['isi'] = 'home/tata_usaha_aksi';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_keuangan_kontrak()
	{
		$data['isi'] = 'home/tata_usaha_keuangan_kontrak';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_approve_pengajuan()
	{
		$data['isi'] = 'home/tata_usaha_approve_pengajuan';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_tolak_pengajuan()
	{
		$data['isi'] = 'home/tata_usaha_tolak_pengajuan';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_termin()
	{
		$data['isi'] = 'home/tata_usaha_termin';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_cetak_invoice()
	{
		$this->load->view('home/tata_usaha_cetak_invoice');
	}

	function tata_usaha_po()
	{
		$data['isi'] = 'home/tata_usaha_po';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_input_po()
	{
		$data['isi'] = 'home/tata_usaha_input_po';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_pembayaran_kontrak()
	{
		$data['isi'] = 'home/tata_usaha_pembayaran_kontrak';
		$this->load->view('home/tata_usaha_index',$data);
	}

	function tata_usaha_pengajuan()
	{
		$data['isi'] = 'home/tata_usaha_pengajuan';
		$this->load->view('home/tata_usaha_index',$data);
	}


	// function tata_usaha_keuangan_kontrak()
	// {
	// 	$data['isi'] = 'home/tata_usaha_keuangan_kontrak';
	// 	$this->load->view('home/tata_usaha_index',$data);
	// }





	// PENELITIAN
	function penelitian_index()
	{
		$data['isi'] = 'home/penelitian_content';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_aksi()
	{
		$data['isi'] = 'home/penelitian_aksi';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_inbox()
	{
		$data['isi'] = 'home/penelitian_inbox';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_detail_kontrak()
	{
		$data['isi'] = 'home/penelitian_detail_kontrak';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_input_kegiatan()
	{
		$data['isi'] = 'home/penelitian_input_kegiatan';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_input_ro()
	{
		$data['isi'] = 'home/penelitian_input_ro';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_input_pengajuan()
	{
		$data['isi'] = 'home/penelitian_input_pengajuan';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_input_progress()
	{
		$data['isi'] = 'home/penelitian_input_progress';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_gantt()
	{
		$data['isi'] = 'home/penelitian_gantt';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_lihat_solusi_close()
	{
		$data['isi'] = 'home/penelitian_lihat_solusi_close';
		$this->load->view('home/penelitian_index',$data);
	}


	function penelitian_input_pengajuan_tu()
	{
		$data['isi'] = 'home/penelitian_input_pengajuan_tu';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_pengajuan_tu()
	{
		$data['isi'] = 'home/penelitian_pengajuan_tu';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_pilih_kontrak_pengajuan_umum()
	{
		$data['isi'] = 'home/penelitian_pilih_kontrak_pengajuan_umum';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_ro_terpilih()
	{
		$data['isi'] = 'home/penelitian_ro_terpilih';
		$this->load->view('home/penelitian_index',$data);
	}















	// FORM FAMILY
	// PERJALANAN
	function penelitian_view_form_perjalanan()
	{
		$data['isi'] = 'home/penelitian_view_form_perjalanan';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_form_perjalanan()
	{
		$data['isi'] = 'home/penelitian_isi_form_perjalanan';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_perjalanan()
	{
		$data['isi'] = 'home/penelitian_isi_detail_perjalanan';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_cetak_form_perjalanan()
	{
		$data['isi'] = 'home/penelitian_cetak_form_perjalanan';
		$this->load->view('home/penelitian_index',$data);
	}










	//-------------------------BEDA SENDIRI

	function penelitian_cetak_form_modal()
	{
		$data['isi'] = 'home/penelitian_cetak_form_modal';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_cetak_form_baru()
	{
		$data['isi'] = 'home/penelitian_cetak_form_baru';
		$this->load->view('home/index',$data);
	}

	function penelitian_cetak_form_barang()
	{
		$data['isi'] = 'home/penelitian_cetak_form_barang';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_cetak_form_konsumsi()
	{
		$data['isi'] = 'home/penelitian_cetak_form_konsumsi';
		$this->load->view('home/penelitian_index',$data);
	}

	//-------------------------BEDA SENDIRO





	// PERJAM
	function penelitian_view_form_perjam()
	{
		$data['isi'] = 'home/penelitian_view_form_perjam';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_form_perjam()
	{
		$data['isi'] = 'home/penelitian_isi_form_perjam';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_perjam()
	{
		$data['isi'] = 'home/penelitian_isi_detail_perjam';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_cetak_form_perjam()
	{
		$data['isi'] = 'home/penelitian_cetak_form_perjam';
		$this->load->view('home/penelitian_index',$data);
	}
	// -----------------------------ffffffffffffffffffoooooooooooooooooooooorrrrrrrrrrrrrrrrrmmmmmmmmmmmmmmmmmmmmmmmmm-----------------------

	// PERHARI
	function penelitian_view_form_perhari()
	{
		$data['isi'] = 'home/penelitian_view_form_perhari';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_form_perhari()
	{
		$data['isi'] = 'home/penelitian_isi_form_perhari';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_perhari()
	{
		$data['isi'] = 'home/penelitian_isi_detail_perhari';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_perhari_tgl()
	{
		$data['isi'] = 'home/penelitian_isi_detail_perhari_tgl';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_cetak_form_perhari()
	{
		$data['isi'] = 'home/penelitian_cetak_form_perhari';
		$this->load->view('home/penelitian_index',$data);
	}
	//--------------------------------------------------------------

	// MODAL
	function penelitian_view_form_modal()
	{
		$data['isi'] = 'home/penelitian_view_form_modal';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_form_modal()
	{
		$data['isi'] = 'home/penelitian_isi_form_modal';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_modal()
	{
		$data['isi'] = 'home/penelitian_isi_detail_modal';
		$this->load->view('home/penelitian_index',$data);
	}

	// function penelitian_cetak_form_modal()
	// {
	// 	$data['isi'] = 'home/penelitian_cetak_form_modal';
	// 	$this->load->view('home/penelitian_index',$data);
	// }
	//-------------------------MODAL :END



	// function penelitian_input_kegiatan()
	// {
	// 	$data['isi'] = 'home/penelitian_input_kegiatan';
	// 	$this->load->view('home/penelitian_index',$data);
	// }

	// BARANG
	function penelitian_view_form_barang()
	{
		$data['isi'] = 'home/penelitian_view_form_barang';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_form_barang()
	{
		$data['isi'] = 'home/penelitian_isi_form_barang';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_barang()
	{
		$data['isi'] = 'home/penelitian_isi_detail_barang';
		$this->load->view('home/penelitian_index',$data);
	}

	function penelitian_isi_detail_barang_nama()
	{
		$data['isi'] = 'home/penelitian_isi_detail_barang_nama';
		$this->load->view('home/penelitian_index',$data);
	}

	// function penelitian_isi_detail_barang_nama()
	// {
	// 	$data['isi'] = 'home/penelitian_isi_detail_barang_tgl';
	// 	$this->load->view('home/penelitian_index',$data);
	// }

	// function penelitian_cetak_form_barang()
	// {
	// 	$data['isi'] = 'home/penelitian_cetak_form_barang';
	// 	$this->load->view('home/penelitian_index',$data);
	// }
	//--------------------------------------------------------------







	// PROGRAM
	function program_index()
	{
		$data['isi'] = 'home/program_content';
		$this->load->view('home/program_index',$data);
	}

	function program_inbox()
	{
		$data['isi'] = 'home/program_inbox';
		$this->load->view('home/program_index',$data);
	}

	function program_detail_kontrak()
	{
		$data['isi'] = 'home/program_detail_kontrak';
		$this->load->view('home/program_index',$data);
	}

	function program_input_kegiatan()
	{
		$data['isi'] = 'home/program_input_kegiatan';
		$this->load->view('home/program_index',$data);
	}

	function program_input_ro()
	{
		$data['isi'] = 'home/program_input_ro';
		$this->load->view('home/program_index',$data);
	}
// hapus nanti
	function gantt()
	{
		$data['isi'] = 'home/gantt';
		$this->load->view('home/program_index',$data);

		// $this->load->view('home/gantt');
	}

	function coba()
	{
		// $data['isi'] = 'home/coba';
		// $this->load->view('home/program_index',$data);

		$this->load->view('home/coba');
	}

	function coba4()
	{
		$data['isi'] = 'home/cetak_realisasi';
		$this->load->view('home/pic_index',$data);

		// $this->load->view('home/coba');
	}

	function coba2()
	{
		// $data['isi'] = 'home/coba2';
		// $this->load->view('home/program_index',$data);

		$this->load->view('home/coba2');
		//
	}

	function coba3()
	{
		$data['isi'] = 'home/coba3';
		$this->load->view('home/pic_index',$data);

		// $this->load->view('home/coba');
	}

	function coba5()
	{
		$data['isi'] = 'home/coba9';
		$this->load->view('home/penelitian_index',$data);

		// $this->load->view('home/coba');
	}

	function coba7()
	{
		$data['isi'] = 'home/coba7';
		$this->load->view('home/penelitian_index',$data);

		// $this->load->view('home/coba');
	}

	function coba8()
	{
		$data['isi'] = 'home/coba8';
		$this->load->view('home/penelitian_index',$data);

		// $this->load->view('home/coba');
	}

	function dataa()
	{
		// $data['isi'] = 'home/data';
		$this->load->view('home/dataa');

		// $this->load->view('home/coba');
	}

	function penelitian_kirim_bukti()
	{
		$data['isi'] = 'home/penelitian_kirim_bukti';
		$this->load->view('home/penelitian_index',$data);
	}





	// PENYELENGGARA
	function penyelenggara_index()
	{
		$data['isi'] = 'home/penyelenggara_content';
		$this->load->view('home/penyelenggara_index',$data);
	}

	function penyelenggara_aksi()
	{
		$data['isi'] = 'home/penyelenggara_aksi';
		$this->load->view('home/penyelenggara_index',$data);
	}





	// pimpinan_pendapatan// PENYELENGGARA
	function pimpinan_pendapatan()
	{
		//$data['isi'] = 'home/pimpinan_pendapatan';
		$data['rba'] = $this->m_pimpinan->list_rba()->result();
		$this->load->view('grafik',$data);
	}

	function pimpinan_pengeluaran()
	{
		$data['isi'] = 'home/pimpinan_pengeluaran';
		$this->load->view('home/pimpinan_index',$data);
	}

	function pimpinan_detail()
	{
		$id= $this->uri->segment(3);
		$data['isi'] = 'home/pimpinan_detail_list_layanan';
		$data['result'] = $this->m_pimpinan->detail_list_layanan($id)->result();
		$this->load->view('home/pimpinan_index',$data);
	}

	function grafik()
	{
		$data['rba'] = $this->m_pimpinan->list_rba()->result();
		$this->load->view('grafik',$data);
	}




	// ppk
	function ppk_index()
	{
		$data['isi'] = 'home/ppk_content';
		$this->load->view('home/ppk_index',$data);
	}

	function ppk_approve()
	{
		$data['isi'] = 'home/ppk_approve';
		$this->load->view('home/ppk_index',$data);
	}

	function ppk_tolak()
	{
		$data['isi'] = 'home/ppk_tolak';
		$this->load->view('home/ppk_index',$data);
	}

	//bendahara
function bendahara_index()
{
	$data['isi'] = 'home/bendahara_content';
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_realisasi()
{
	$data['isi'] = 'home/bendahara_realisasi';
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_input_po()
{
	$data['isi'] = 'home/bendahara_input_po';
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_list_po()
{
	$data['isi'] = 'home/bendahara_list_po';
	$data['result'] = $this->m_bendahara->list_po()->result();
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_list_ba_po()
{
	$data['isi'] = 'home/bendahara_ba_po';
	$data['result'] = $this->m_bendahara->list_ba()->result();
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_rekap_po()
{
	$data['isi'] = 'home/bendahara_rekap_po';
	$data['layanan'] = $this->m_bendahara->list_jenis_layanan()->result();
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_cetak_invoice()
{
	$id = $this->uri->segment(3);
	$data['result'] = $this->m_bendahara->cetak_invoice_po($id)->row();
	$get = $this->m_bendahara->cetak_invoice_po($id)->row();
	$data['terbilang'] = $this->format_terbilang->terbilang($get->nilai_po);
	$this->load->view('home/bendahara_invoice_po',$data);
}

function bendahara_cetak_kwitansi()
{
	$id = $this->uri->segment(3);
	$data['result'] = $this->m_bendahara->cetak_kwitansi_po($id)->row();
	$get = $this->m_bendahara->cetak_invoice_po($id)->row();
	$data['terbilang'] = $this->format_terbilang->terbilang($get->nilai_po);
	$this->load->view('home/bendahara_kwitansi_po',$data);
}

function bendahara_cetak_berita_acara()
{
	$id = $this->uri->segment(3);
	$data['result'] = $this->m_bendahara->cetak_ba_po($id)->result();
	$this->load->view('home/bendahara_berita_acara_po',$data);
}

function bendahara_pindah()
{
	$id = $this->uri->segment(3);
	$data['isi'] = 'home/bendahara_pindah_po';
	$data['hasil_po'] = $this->m_bendahara->cetak_kwitansi_po($id)->row();
	$this->load->view('home/bendahara_index',$data);
}

function bendahara_detail()
{
	$id = $this->uri->segment(3);
	$data['result'] = $this->m_bendahara->detail($id)->result();
	$data['sample'] = $this->m_bendahara->jumlah_sample($id)->row();
	$data['isi'] = 'home/bendahara_rekap_detail_po';
	$this->load->view('home/bendahara_index',$data);
}

// function bendahara_pindah_operasional()
// {
// 	$id = $this->uri->segment(3);
// 	$data['result'] = $this->m_bendahara->pindah_operasional($id);
// 	echo '<script>alert("Data Berhasil Disimpan!");</script>';
// 	redirect('home/bendahara_list_po','refresh');
// }

function bendahara_pindah_operasional()
{
	$id = addslashes($this->input->post('id'));
	$keterangan = addslashes($this->input->post('keterangan'));
	//$no_lab = addslashes($this->input->post('no_lab'));
	$tgl_sertifikat = addslashes($this->input->post('tgl_sertifikat'));
	$no_sertifikat = addslashes($this->input->post('no_sertifikat'));
	$data['result'] = $this->m_bendahara->pindah_operasional($id,$keterangan,$no_sertifikat,$tgl_sertifikat);
	echo '<script>alert("Data Berhasil Disimpan!");</script>';
	redirect('home/bendahara_list_po','refresh');
}





}
?>
