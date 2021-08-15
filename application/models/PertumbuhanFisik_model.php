<?php
class PertumbuhanFisik_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('pertumbuhan_fisik');
            return $query->result_array();
        }

        $query = $this->db->get_where('pertumbuhan_fisik');
        return $query->row_array();
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('pertumbuhan_fisik', $arr_data);
    }
	public function add($arr_data)
	{
	    return $this->db->insert('pertumbuhan_fisik', $arr_data);
	}
    public function get_last_year($id_anak){
         $query = $this->db->query("
            SELECT * 
            FROM pertumbuhan_fisik 
            WHERE Tanggal >= DATE_SUB(NOW(),INTERVAL 1 YEAR) and Anak_Id='".$id_anak."'
            ORDER BY Tanggal DESC
        ");      
        return $query->result_array();
    }
    public function exist($id_anak,$tanggal){
        $query = $this->db->query("
            SELECT * 
            FROM pertumbuhan_fisik 
            WHERE MONTH(Tanggal) = MONTH('".$tanggal."') and Anak_Id='".$id_anak."'
        ");      
        return $query->row_array();
    }
    public function has_laporan($id_anak){
        $query = $this->db->query("
            SELECT * 
            FROM pertumbuhan_fisik 
            WHERE Anak_Id='".$id_anak."'
            ORDER BY Tanggal DESC 
            LIMIT 1,1
        ");      
        return $query->row_array();
    }
    public function get_previous_month($id_anak){
        $query = $this->db->query("
            SELECT * 
            FROM pertumbuhan_fisik 
            WHERE Anak_Id ='".$id_anak."' 
            ORDER BY Tanggal DESC 
            LIMIT 1,1
        ");      
        return $query->row_array();
    }
    public function get_now($id_anak,$tanggal){
        $query = $this->db->query("
            SELECT a.Nama as NamaAnak,k.Nama as NamaKaryawan,p.* 
            FROM pertumbuhan_fisik p
            INNER JOIN anak a on a.Id=p.Anak_Id
            INNER JOIN karyawan k on k.Id=p.Perawat
            WHERE MONTH(Tanggal) = MONTH('".$tanggal."') and Anak_Id='".$id_anak."'
        ");      
        return $query->row_array();
    }
    public function get_next_month($id_anak,$tanggal){
        $query = $this->db->query("
            SELECT a.Nama as NamaAnak,k.Nama as NamaKaryawan,p.* 
            FROM pertumbuhan_fisik p
            INNER JOIN anak a on a.Id=p.Anak_Id
            INNER JOIN karyawan k on k.Id=p.Perawat
            WHERE YEAR(p.Tanggal) = YEAR('".$tanggal."')
            AND MONTH(p.Tanggal) >= MONTH('".$tanggal."')
            AND p.Anak_Id='".$id_anak."'
            ORDER BY p.Tanggal ASC
            LIMIT 1,1
        ");      
        return $query->row_array();
    }
    public function get_by_date($id_anak,$tanggal){
        $query = $this->db->query("
            SELECT a.Nama as NamaAnak,k.Nama as NamaKaryawan,p.* 
            FROM pertumbuhan_fisik p
            INNER JOIN anak a on a.Id=p.Anak_Id
            INNER JOIN karyawan k on k.Id=p.Perawat
            WHERE MONTH(Tanggal) = MONTH('".$tanggal."') and Anak_Id='".$id_anak."' AND StatusLaporan=1
        ");      
        return $query->row_array();
    }
    /*public function delete_vaksinasi($id) {
        $this->db->where('Id', $id);
        return $this->db->update('vaksinasi', array('Hapus?' => 1));
    }*/
}