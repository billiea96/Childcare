<?php
class FotoPerkembangan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('foto_perkembangan');
            return $query->result_array();
        }

        $query = $this->db->get_where('foto_perkembangan', array('NoForm' => $slug));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('foto_perkembangan', $arr_data);
	}
    public function get_by_tanggal($id_anak,$month,$year){
        $query = $this->db->query("
            SELECT cp.Anak_Id,cp.Tanggal, fp.NamaFoto
            FROM catatan_perkembangan cp
            INNER JOIN foto_perkembangan fp on cp.NoForm=fp.NoForm
            WHERE cp.Anak_Id='".$id_anak."' AND Month(cp.Tanggal) ='".$month."' AND Year(cp.Tanggal) ='".$year."'");      
        return $query->result_array();
    }
}