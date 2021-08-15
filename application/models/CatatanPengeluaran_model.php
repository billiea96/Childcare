<?php
class CatatanPengeluaran_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('catatan_pengeluaran');
            return $query->result_array();
        }

        $query = $this->db->get_where('catatan_pengeluaran', array('Id' => $slug));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('catatan_pengeluaran', $arr_data);
	}
    public function get_laporan($tanggal){
        $query = $this->db->query("
            SELECT cp.Tanggal,kp.Nama,cp.Keterangan,cp.JumlahBayar
            FROM catatan_pengeluaran cp
            INNER JOIN kategori_pengeluaran kp on cp.Kategori_Pengeluaran_Id=kp.Id
            WHERE cp.Tanggal LIKE '".$tanggal."-%'");      
        return $query->result_array();
    }
}