<?php
class CatatanPerkembanganHasIndikatorPerkembangan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    /*public function get($slug = FALSE)
	{  
        if ($slug === FALSE)
        {
            $query = $this->db->get('catatan_perkembangan_has_indikator_perkembangan');
            return $query->result_array();
        }

        $query = $this->db->get_where('catatan_perkembangan_has_indikator_perkembangan', array('NoForm' => $slug));
        return $query->row_array();
	}*/
	public function add($arr_data)
	{
	    return $this->db->insert('catatan_perkembangan_has_indikator_perkembangan', $arr_data);
	}
}