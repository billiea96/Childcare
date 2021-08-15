<?php
class OrangTua_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_orangtua($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('orangtua',array('Hapus?' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('orangtua', array('Id' => $slug,'Hapus?'=>0));
        return $query->row_array();
	}
    public function get($slug = FALSE)
    {   
        $this->db->order_by('Hapus?',"ASC");
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('orangtua');
            return $query->result_array();
        }

        $query = $this->db->get_where('orangtua', array('Id' => $slug));
        return $query->row_array();
    }
	public function add_orangtua($arr_data)
	{
	    return $this->db->insert('orangtua', $arr_data);
	}
    public function edit_orangtua($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('orangtua', $arr_data);
    }
    public function delete_orangtua($id) {
        $this->db->where('Id', $id);
        return $this->db->update('orangtua', array('Hapus?' => 1));
    }
    public function get_last_orangtua() {
        $this->db->select('Id');
        $this->db->limit(1);
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('orangtua');
        return $query->row_array();
    }
}