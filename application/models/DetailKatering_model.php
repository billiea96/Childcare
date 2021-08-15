<?php
class DetailKatering_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('detail_katering');
            return $query->result_array();
        }
        $query = $this->db->get_where('detail_katering', array('Id' => $slug));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('detail_katering', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('detail_katering', $arr_data);
    }
    /*public function get_last() {
        $this->db->select('Id,Nama,Tanggal');
        $this->db->limit(1);
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('paket_katering');
        return $query->row_array();
    }*/
    /*public function delete($id) {
        $this->db->where('Id', $id);
        return $this->db->update('paket_katering', array('Hapus?' => 1));
    }*/
}