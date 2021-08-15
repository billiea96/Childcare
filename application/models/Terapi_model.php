<?php
class Terapi_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('terapi',array('Hapus' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('terapi', array('Id' => $slug,'Hapus'=>0));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('terapi', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('terapi', $arr_data);
    }
    public function delete($id) {
        $this->db->where('Id', $id);
        return $this->db->update('terapi', array('Hapus' => 1));
    }
}