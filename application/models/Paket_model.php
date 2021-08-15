<?php
class Paket_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_paket($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('paket',array('Hapuskah' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('paket', array('Id' => $slug,'Hapuskah'=>0));
        return $query->row_array();
	}
	public function add_paket($arr_data)
	{
	    return $this->db->insert('paket', $arr_data);
	}
    public function edit_paket($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('paket', $arr_data);
    }
    public function delete_paket($id) {
        $this->db->where('Id', $id);
        return $this->db->update('paket', array('Hapuskah' => 1));
    }
}