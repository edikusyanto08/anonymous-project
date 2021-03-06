<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class m_admin extends CI_Model {

	public function displayUser() 
		{
			$this->load->database();
			$query = $this->db->query("
				select * from users
				");
			return $query->result();
		}
		
	public function insertUser($no_induk, $id_prev, $user_pass) 
		{
			$this->load->database();
		
			$query = $this->db->query("
			insert into users
			values ('$no_induk', '$id_prev', '$user_pass')
			");
		}
		
	public function editUser($no_induk) 
		{
			$this->load->database();
			$query = $this->db->query("select * from users where no_induk = '$no_induk'");
			return $query->result();
		}
		
	public function deleteUser($no_induk) 
		{
			$this->load->database();
			$query = $this->db->query("delete from users where no_induk = '$no_induk'");
		}
	
	public function updateUser($no_induk, $id_prev, $user_pass) 
		{
			$this->load->database();
			$query = $this->db->query("
			update users 
			set no_induk='$no_induk', id_prev='$id_prev', user_pass='$user_pass'
			where no_induk='$no_induk'
			");
		}
		
		
		
	public function displayMenu() 
		{
			$this->load->database();
			$query = $this->db->query("
				select a.id_menu, a.id_prev, b.nama_menu as parent, a.nama_menu, a.action_menu from menu a left join (select * from menu) b on a.men_id_menu = b.id_menu
				");
			return $query->result();
		}
	
	public function getIDParentMenu() 
		{
			$this->load->database();
			$query = $this->db->query("
				select * from menu where men_id_menu is null
				");
			return $query->result();
		}
	
	public function getIDPrev() 
		{
			$this->load->database();
			$query = $this->db->query("
				select id_prev from previlege
				");
			return $query->result();
		}
		
	public function insertMenu($data) 
		{
			$this->load->database();
		
			$query = $this->db->insert('menu',$data);
		}
		
	public function editMenu($id_menu) 
		{
			$this->load->database();
			$query = $this->db->query("select * from menu where id_menu = '".$id_menu."'");
			return $query->result();
		}
		
	// public function deleteUser($no_induk) 
		// {
			// $this->load->database();
			// $query = $this->db->query("delete from users where no_induk = '$no_induk'");
		// }
	
	public function updateMenu($data,$id) 
		{
			$this->load->database();
			$query = $this->db->update("menu",$data,"id_menu = '".$id."'");
		}
}
?>