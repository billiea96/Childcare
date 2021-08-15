<?php
class Jabatan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_jabatan($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('jabatan',array('Hapus?' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('jabatan', array('Id' => $slug,'Hapus?'=>0));
        return $query->row_array();
	}
	public function add_jabatan($arr_data)
	{
	    return $this->db->insert('jabatan', $arr_data);
	}
    public function edit_jabatan($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('jabatan', $arr_data);
    }
    public function delete_jabatan($id) {
        $this->db->where('Id', $id);
        return $this->db->update('jabatan', array('Hapus?' => 1));
    }
}