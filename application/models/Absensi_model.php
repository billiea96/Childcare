<?php
class Absensi_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
    {
        $this->db->select("absensi.*");
        $this->db->from('absensi');
        $this->db->join('anak', 'absensi.Anak_Id = anak.Id');
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
        return $this->db->insert('absensi', $arr_data);
    }
    public function exist($tanggal,$id){
        $this->db->select("*");
        $this->db->from('absensi');
        $this->db->where('Tanggal',$tanggal);
        $this->db->where('Anak_Id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_laporan($id_anak,$tanggal_awal,$tanggal_akhir){
        $query = $this->db->query("
            SELECT *
            FROM absensi
            where Anak_Id='".$id_anak."' AND Tanggal >= '".$tanggal_awal."' AND Tanggal < '".$tanggal_akhir."'");      
        return $query->result_array();
    }
}