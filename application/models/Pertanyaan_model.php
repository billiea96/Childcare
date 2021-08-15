<?php
class Pertanyaan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_pertanyaan($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('daftar_pertanyaan');
            return $query->result_array();
        }

        $this->db->where("daftar_pertanyaan.Id = '".$slug."'", NULL, FALSE);
        return $query->row_array();
	}
	public function add_pertanyaan($arr_data)
	{
	    return $this->db->insert('daftar_pertanyaan', $arr_data);
	}
    public function edit_pertanyaan($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('daftar_pertanyaan', $arr_data);
    }
}