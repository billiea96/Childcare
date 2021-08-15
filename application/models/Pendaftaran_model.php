<?php
class Pendaftaran_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_pendaftaran($slug = FALSE)
	{
        $this->db->select("form_pendaftaran.*,data_form_pendaftaran.Jawaban,daftar_pertanyaan.Pertanyaan,anak.*");
        $this->db->from('form_pendaftaran');
        $this->db->join('data_form_pendaftaran', 'form_pendaftaran.NoForm = data_form_pendaftaran.NoForm');
        $this->db->join('daftar_pertanyaan', 'daftar_pertanyaan.Id = data_form_pendaftaran.Id');
        $this->db->join('anak', 'anak.Id = form_pendaftaran.Anak_Id');
        $this->db->where('anak.Hapus',0);
        $this->db->order_by('form_pendaftaran.NoForm');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("form_pendaftaran.NoForm = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
	}
    public function get_pendaftaran_anak($slug)
    {
        $this->db->select("form_pendaftaran.NoForm,form_pendaftaran.Tanggal,data_form_pendaftaran.Jawaban,daftar_pertanyaan.Pertanyaan,");
        $this->db->from('form_pendaftaran');
        $this->db->join('data_form_pendaftaran', 'form_pendaftaran.NoForm = data_form_pendaftaran.NoForm');
        $this->db->join('daftar_pertanyaan', 'daftar_pertanyaan.Id = data_form_pendaftaran.Id');
        $this->db->join('anak', 'anak.Id = form_pendaftaran.Anak_Id');
        $this->db->order_by('daftar_pertanyaan.Id');
    
        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function add_pendaftaran($arr_data)
	{
	    return $this->db->insert('form_pendaftaran', $arr_data);
	}
    public function edit_pendaftaran($arr_data) {
        $this->db->where('NoForm', $arr_data['NoForm']);
        return $this->db->update('form_pendaftaran', $arr_data);
    }
    public function get_last_pendaftaran() {
        $this->db->select('NoForm,Anak_Id');
        $this->db->limit(1);
        $this->db->order_by('NoForm', 'DESC');
        $query = $this->db->get('form_pendaftaran');
        return $query->row_array();
    }
}