<?php
class RiwayatKesehatan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('riwayat_kesehatan');
            return $query->result_array();
        }

        $query = $this->db->get_where('riwayat_kesehatan');
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('riwayat_kesehatan', $arr_data);
	}
    public function get_laporan($id_anak,$tanggalSebelum,$tanggal){
        $query = $this->db->query("
            SELECT r.Tanggal,r.Diagnosa,r.Catatan,t.Nama,t.Keterangan
            FROM riwayat_kesehatan as r
            INNER JOIN terapi t on r.Terapi_Id=t.Id
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