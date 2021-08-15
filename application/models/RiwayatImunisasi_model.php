<?php
class RiwayatImunisasi_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('riwayat_imunisasi');
            return $query->result_array();
        }

        $query = $this->db->get_where('riwayat_imunisasi');
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('riwayat_imunisasi', $arr_data);
	}
    public function get_laporan($id_anak,$tanggalSebelum,$tanggal){
        $query = $this->db->query("
            SELECT r.Tanggal,r.Catatan,v.Nama,v.Keterangan
            FROM riwayat_imunisasi as r
            INNER JOIN vaksinasi v on r.Vaksinasi_Id=v.Id
            where r.Tanggal > '".$tanggalSebelum."' AND r.Tanggal <= '".$tanggal."' And r.Anak_Id='".$id_anak."'
            ORDER BY r.Tanggal
        ");      
        return $query->result_array();
    }
    /*public function delete_vaksinasi($id) {
        $this->db->where('Id', $id);
        return $this->db->update('vaksinasi', array('Hapus?' => 1));
    }*/
}