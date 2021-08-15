<?php
class BiayaOverTime_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
    {
        $this->db->select("absensi.*");
        $this->db->from('biaya_overtime');
        $this->db->join('anak', 'biaya_overtime.Anak_Id = anak.Id');
        $this->db->where('anak.Hapus',0);
        $this->db->order_by('anak.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function add($arr_data)
    {
        return $this->db->insert('biaya_overtime', $arr_data);
    }
    public function get_for_bayar($id_anak,$bulan){
        $query = $this->db->query("
            SELECT *
            FROM biaya_overtime
            where Anak_Id='".$id_anak."' AND Month(Tanggal) = '".$bulan."' AND Year(Tanggal) = '".date('Y')."'");      
        return $query->result_array();
    }
}