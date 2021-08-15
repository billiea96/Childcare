<?php
class DaftarPaket_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_daftar_Paket($slug = FALSE)
    {
        $this->db->select("paket.*,daftarpaket.Tanggal");
        $this->db->from('daftarpaket');
        $this->db->join('anak', 'daftarpaket.Anak_Id = anak.Id');
        $this->db->join('paket', 'daftarpaket.Paket_Id = paket.Id');
        $this->db->where('daftarpaket.StatusAktif',1);
        $this->db->where('anak.Hapus',0);
        $this->db->order_by('daftarpaket.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_daftar_Paket2($slug = FALSE)
    {
        $this->db->select("paket.*,daftarpaket.Tanggal");
        $this->db->from('daftarpaket');
        $this->db->join('anak', 'daftarpaket.Anak_Id = anak.Id');
        $this->db->join('paket', 'daftarpaket.Paket_Id = paket.Id');
        $this->db->where('daftarpaket.StatusAktif',1);
        $this->db->order_by('daftarpaket.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function add_daftar_paket($arr_data)
    {
        return $this->db->insert('daftarpaket', $arr_data);
    }
    public function edit_daftar_paket($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('daftarpaket', $arr_data);
    }
    public function set_non_aktif($id_anak,$id_paket){
        $this->db->where('Anak_Id', $id_anak);
        $this->db->where('Paket_Id', $id_paket);
        return $this->db->update('daftarpaket', array('StatusAktif'=>0));
    }
}