<?php 
 
class M_data extends CI_Model{	

	public function __construct(){
        parent::__construct();
       	$this->load->database();
    }
	
	// All view
	function view_konfigurasi_web($table){
		$q = "SELECT * FROM $table";		
		return $this->db->query($q)->result();
	}
	function view_kategori_menu($table){
		$q = "SELECT * FROM $table";		
		return $this->db->query($q)->result();
	}
	function view_menu($table){
		$q = "
			SELECT 
				* 
			FROM $table as rm
			JOIN ref_kategori_menu rkm ON rkm.id_kategori_menu = rm.id_kategori_menu ";		
		return $this->db->query($q)->result();
	}
	function view_user_akses($table){
		$q = "
			SELECT
				rua.*,
				u.nama_lengkap as nama,
				rm.nama_menu
			FROM
				$table rua
				LEFT JOIN ref_user u ON u.id_user = rua.id_user
				LEFT JOIN ref_menu rm ON rm.id_menu = rua.id_menu
		";		
		return $this->db->query($q)->result();
	}
	function view_master_user($table){
		$q = "SELECT * FROM $table";		
		return $this->db->query($q)->result();
	}
	function view_master_user_edit($table,$id){
		$q = "SELECT * FROM $table WHERE id_user = '$id'";		
		return $this->db->query($q)->result();
	}
	function view_cek_user_akses($table,$id_user,$id_menu){
		$q = "
			SELECT
				* 
			FROM
				ref_user_akses 
			WHERE
				id_user = '$id_user'
				AND id_menu = '$id_menu'
		";		
		return $this->db->query($q)->num_rows();
	}
	function view_master_provinsi($table){
		$q = "SELECT * FROM $table";		
		return $this->db->query($q)->result();
	}
	function view_master_kabupaten($table){
		$q = "SELECT * FROM $table";		
		return $this->db->query($q)->result();
	}
	function view_master_kecamatan($table){
		$q = "SELECT * FROM $table";		
		return $this->db->query($q)->result();
	}


	// All insert
	function insert_konfigurasi_menu($table,$data){
		$this->db->insert($table,$data);
	}
	function insert_konfigurasi_user_akses($table,$data){
		$this->db->insert($table,$data);
	}
	function insert_master_user($table,$data){
		$this->db->insert($table,$data);
	}
	function insert_apikey($table,$data){
		$this->db->insert($table,$data);
	}

	// All edit
	function edit_konfigurasi_menu($table,$data,$id){
		$this->db->where('id_menu',$id);
      	$this->db->update($table,$data);
	}
	function edit_master_user($table,$data,$id){
		$this->db->where('id_user',$id);
      	$this->db->update($table,$data);
	}

	// All delete
	function hapus_konfigurasi_menu($table,$id){
		$this->db->where('id_menu',$id);
      	$this->db->delete($table);
	}
	function hapus_master_user($table,$id){
		$this->db->where('id_user',$id);
      	$this->db->delete($table);
	}
	function hapus_konfigurasi_user_akses($table,$id){
		$this->db->where('id_user_akses',$id);
      	$this->db->delete($table);
	}
}