<?php
class DataFormPendaftaran_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_data_form_pendaftaran($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('data_form_pendaftaran',array('Hapus?' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('data_form_pendaftaran', array('Id' => $slug,'Hapus?'=>0));
        return $query->row_array();
	}
	public function add_data_form_pendaftaran($arr_data)
	{
	    return $this->db->insert('data_form_pendaftaran', $arr_data);
	}
    public function edit_data_form_pendaftaran($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('data_form_pendaftaran', $arr_data);
    }
    public function delete_data_form_pendaftaran($id) {
        $this->db->where('Id', $id);
        return $this->db->update('data_form_pendaftaran', array('Hapus?' => 1));
    }
}