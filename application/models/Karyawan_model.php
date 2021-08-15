<?php
class Karyawan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_karyawan($slug = FALSE)
	{
        $this->db->select("karyawan.*,jabatan.Id as IDJabatan ,jabatan.Nama as NamaJabatan");
        $this->db->from('karyawan');
        $this->db->join('jabatan', 'jabatan.Id = karyawan.Jabatan_Id');
        $this->db->where('karyawan.Hapus',0);
        $this->db->order_by('karyawan.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("karyawan.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function add_karyawan($arr_data)
	{
	    return $this->db->insert('karyawan', $arr_data);
	}
    public function edit_karyawan($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('karyawan', $arr_data);
    }
    public function delete_karyawan($id) {
        $this->db->where('Id', $id);
        return $this->db->update('karyawan', array('Hapus' => 1));
    }
    public function get_pengasuh(){
        $query = $this->db->query('SELECT k.*,j.Nama AS NamaJabatan from karyawan k inner join jabatan j on k.Jabatan_Id=j.Id where (j.Nama = "Nanny" or j.Nama="nanny") AND k.Hapus=0');
        return $query->result_array();
    }
    public function get_perawat(){
        $query = $this->db->query('SELECT k.*,j.Nama AS NamaJabatan from karyawan k inner join jabatan j on k.Jabatan_Id=j.Id where (j.Nama = "Keperawatan" or j.Nama="keperawatan") AND k.Hapus=0');
        return $query->result_array();
    }

    public function get_no_username()
    {
        $query = $this->db->get_where('karyawan',array('Hapus' => 0,'Username' => NULL));
        return $query->result_array();
    }
}