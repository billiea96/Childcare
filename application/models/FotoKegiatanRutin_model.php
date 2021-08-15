<?php
class FotoKegiatanRutin_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE,$tanggal)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('foto_kegiatan_rutin');
            return $query->result_array();
        }

        $query = $this->db->get_where('foto_kegiatan_rutin', array('Kegiatan_Rutin_Id' => $slug,'Tanggal' => $tanggal));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('foto_kegiatan_rutin', $arr_data);
	}
    public function get_by_tanggal($kegiatan,$start,$end){
        $query = $this->db->query("
            SELECT Kegiatan_Rutin_Id,NamaFoto,Tanggal
            FROM foto_kegiatan_rutin
            WHERE Kegiatan_Rutin_Id='".$kegiatan."' AND Tanggal BETWEEN '".$start."' AND '".$end."'");      
        return $query->result_array();
    }
}