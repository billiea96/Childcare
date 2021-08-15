<?php
class PeriodeAsuh_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_periode_asuh($slug = FALSE)
	{  
        $this->db->order_by('Id','DESC');
        if ($slug === FALSE)
        {   
            $query = $this->db->get_where('periode_asuh');
            return $query->result_array();
        }

        $query = $this->db->get_where('periode_asuh');
        return $query->row_array();
	}
	public function add_periode_asuh($arr_data)
	{
	    return $this->db->insert('periode_asuh', $arr_data);
	}
    public function edit_periode_asuh($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('periode_asuh', $arr_data);
    }
    public function delete_periode_asuh($id) {
        $this->db->where('Id', $id);
        return $this->db->update('periode_asuh', array('Hapus?' => 1));
    }
    //untuk mengeset semua periode menjadi tidak aktif
    public function set_non_aktif(){
        return $this->db->update('periode_asuh', array('Status'=>0));
    }
    public function get_periode_asuh_aktif()
    {  
        $query = $this->db->get_where('periode_asuh',array('Status'=>1));
        return $query->row_array();
    }
}