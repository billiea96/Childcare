<?php
class KegiatanNonRutin_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_kegiatan($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('kegiatan_non_rutin',array('Hapus?' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('kegiatan_non_rutin', array('Id' => $slug,'Hapus?'=>0));
        return $query->row_array();
	}
	public function add_kegiatan($arr_data)
	{
	    return $this->db->insert('kegiatan_non_rutin', $arr_data);
	}
    public function edit_kegiatan($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('kegiatan_non_rutin', $arr_data);
    }
    public function delete_kegiatan($id) {
        $this->db->where('Id', $id);
        return $this->db->update('kegiatan_non_rutin', array('Hapus?' => 1));
    }
}