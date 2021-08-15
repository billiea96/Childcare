<?php
class Vaksinasi_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_vaksinasi($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('vaksinasi',array('Hapus?' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('vaksinasi', array('Id' => $slug,'Hapus?'=>0));
        return $query->row_array();
	}
	public function add_vaksinasi($arr_data)
	{
	    return $this->db->insert('vaksinasi', $arr_data);
	}
    public function edit_vaksinasi($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('vaksinasi', $arr_data);
    }
    public function delete_vaksinasi($id) {
        $this->db->where('Id', $id);
        return $this->db->update('vaksinasi', array('Hapus?' => 1));
    }
}