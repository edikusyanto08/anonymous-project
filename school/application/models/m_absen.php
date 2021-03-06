<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class m_absen extends CI_Model {

	public function getTanggal() {
		$this->load->database();
		$query = $this->db->query("
						select distinct tanggal_absensi from absen order by tanggal_absensi desc
						");
		return $query->result();
	}

	public function insert($id, $al) {
		$this->load->database();
		$query = $this->db->query("INSERT INTO absen VALUES (nextval('absen_pk_seq'),'" . $id . "',CURRENT_DATE,'" . $al . "')");
		return $query;
	}

	public function getHariIni() {
		$this->load->database();
		$query = $this->db->query("
						select CURRENT_DATE as hari_ini
						");
		return $query->result();
	}

	public function editAbsensi($no_absensi) {
		$this->load->database();
		$query = $this->db->query("select b.no_absensi, a.id_users, a.nama_person, d.waktu_absen as waktu_masuk, c.waktu_absen as waktu_keluar  
						from person a inner join absen b on a.no_induk = b.no_induk 
						inner join keterangan_absen d on b.no_absensi = d.no_absensi
						left join (select b.waktu_absen, b.no_absensi from absen a inner join keterangan_absen b on a.no_absensi = b.no_absensi where keterangan = '2') c on b.no_absensi = c.no_absensi
						where d.keterangan ='1' and d.no_absensi = $no_absensi
						");
		return $query->result();
	}

	public function updateAbsensi($data, $no) {

		$this->load->database();
		$query = $this->db->update("absen",$data,"no_absensi = $no");
	}

	public function displayBelumAbsen($tanggal) {
		$this->load->database();
		$query = $this->db->query("
					select * from person where 
					not exists (select no_induk from absen where absen.no_induk=person.no_induk and tanggal_absensi=" . $tanggal . ")
					");
		return $query->result();
	}

	public function get_not_absen() {
		$this->load->database();
		$query = $this->db->query("
					select * from siswa where 
					not exists (select id_users from absen where absen.id_users=siswa.id_users and tanggal_absensi=CURRENT_DATE)
					ORDER BY nama_siswa");
		return $query->result();
	}
}
?>