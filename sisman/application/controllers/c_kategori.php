<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class c_kategori extends CI_Controller {

	function __construct() {
		parent :: __construct();
		$this->load->model('m_menu');
		$this->client_logon = $this->session->userdata('login');
		$this->data['menus'] = $this->m_menu->getAll($this->client_logon['id_prev']);
		if($this->client_logon['id_prev']!="absen" && $this->client_logon['id_prev']!="admin"){
			$this->redirectto($this->client_logon['id_prev']);
		}
	}

	public function index() {
		$this->load->model('m_kategori');
		$this->data['rows'] = $this->m_kategori->displayKategori();
		$this->data['title'] = "Data Kategori";
		$this->load->view('v_header', $this->data);
		$this->load->view('v_kategori', $this->data);
		$this->load->view('v_footer', $this->data);
	}
	
	public function viewTambahKategori($flag,$id=0) {
		$this->load->model('m_kategori');
		$this->data['row'] = $this->m_kategori->getKategori($id);
		$this->data['flag'] = $flag;
		$this->data['title'] = "Kategori";
		$this->load->view('v_header', $this->data);
		$this->load->view('v_tambah_kategori', $this->data);
		$this->load->view('v_footer', $this->data);
	}
	
	public function tambahKategori() {
		$this->load->model('m_kategori');
		$id = $this->input->post('id_kategori');
		$nama = $this->input->post('nama_kategori');

		$this->m_kategori->tambahKategori($id, $nama);
		
		redirect(index_kategori);
	}
	
	public function kategoriSiswa($id_kategori) {
		$this->load->model('m_kategori');
		$this->load->model('m_siswa');
		$this->data['kategori'] = $this->m_kategori->getKategori($id_kategori);
		$this->data['items'] = $this->m_siswa->getByKategori($id_kategori);
		$this->data['title'] = "Tambah Kategori Siswa";
		$this->load->view('v_header', $this->data);
		$this->load->view('v_kategori_siswa', $this->data);
		$this->load->view('v_footer', $this->data);
	}
	
	public function add_siswa($id_kategori) {
		$this->data['id_kategori'] = $id_kategori;
		$this->data['title'] = "Tambah Siswa";
		$this->load->view('v_header', $this->data);
		$this->load->view('v_add_kat_siswa', $this->data);
		$this->load->view('v_footer', $this->data);
	}
	
	public function tambahKategoriSiswa() {
		$this->load->model('m_siswa');
		$this->load->model('m_kategori');
		$nis = $_REQUEST['no_induk'];
		$id = $_REQUEST['id_kategori'];
		$count = $this->m_siswa->check($nis);
		if(!$count){
			$this->kategoriSiswa($id);
			return;
		}
		$sql = $this->m_kategori->tambahKategoriSiswa($id, $nis);
		$this->kategoriSiswa($id);		
	}
	
	function redirectto($prev) {
		switch ($prev) {
			case 'absen' :
				redirect('index_absensi');
				break;
			case 'smsgw' :
				redirect('index_sms');
				break;
			case 'sppap' :
				redirect('index_spp');
				break;
			case 'nilai' :
				redirect('index_nilai');
				break;
			case 'admin' :
				redirect('index_admin');
				break;
		}
		}

}