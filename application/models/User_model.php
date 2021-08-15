<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct() {
        $this->load->database();
    }
	public function cek_user($data) {
		$query = $this->db->get_where('user', array('Username' => $data['Username'], 'Password' => $data['Password']));
    	return $query->row_array();	
	}
	public function get_user_karyawan($data){
		$query = $this->db->get_where('karyawan', array('Username' => $data['Username']));
    	return $query->row_array();	
	}
	public function get_user_anak($data){
		$query = $this->db->get_where('anak', array('Username' => $data['Username']));
    	return $query->row_array();	
	}
	public function add($arr_data)
	{
	    return $this->db->insert('user', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Username', $arr_data['Username']);
        return $this->db->update('user', $arr_data);
    }
    public function edit2($username,$arr_data) {
        $this->db->where('Username', $username);
        return $this->db->update('user', $arr_data);
    }
    public function exist($username){
        $this->db->select("*");
        $this->db->from('user');
        $this->db->where('Username',$username);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_karyawan(){
    	$this->db->select("karyawan.*,user.HakAkses");
        $this->db->from('user');
        $this->db->join('karyawan', 'karyawan.Username = user.Username');
        $this->db->where('karyawan.Hapus',0);
        $this->db->order_by('karyawan.Id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_anak(){
    	$this->db->select("anak.*,user.HakAkses");
        $this->db->from('user');
        $this->db->join('anak', 'anak.Username = user.Username');
        $this->db->where('anak.Hapus',0);
        $this->db->order_by('anak.Id');
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>