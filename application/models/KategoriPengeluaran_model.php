<?php
class KategoriPengeluaran_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('kategori_pengeluaran',array('Hapuskah' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('kategori_pengeluaran', array('Id' => $slug,'Hapuskah'=>0));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('kategori_pengeluaran', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('kategori_pengeluaran', $arr_data);
    }
    public function delete($id) {
        $this->db->where('Id', $id);
        return $this->db->update('kategori_pengeluaran', array('Hapuskah' => 1));
    }
}