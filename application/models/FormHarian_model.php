<?php
class FormHarian_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('form_harian');
            return $query->result_array();
        }

        $query = $this->db->get_where('form_harian', array('NoForm' => $slug));
        return $query->row_array();
	}
    public function get_by_anak_today($anak){
        $query = $this->db->query("
            SELECT *
            FROM form_harian
            where date(Tanggal) = curdate() and Anak_Id =".$anak);      
        return $query->row_array();
    }
    public function get_last() {
        $this->db->select('NoForm');
        $this->db->limit(1);
        $this->db->order_by('NoForm', 'DESC');
        $query = $this->db->get('form_harian');
        return $query->row_array();
    }
    public function edit_form($arr_data) {
        $this->db->where('NoForm', $arr_data['NoForm']);
        return $this->db->update('form_harian', $arr_data);
    }
	public function add_form_harian($arr_data)
	{
	    return $this->db->insert('form_harian', $arr_data);
	}
    public function add_daftar_obat_vitamin($arr_data)
    {
        return $this->db->insert('daftar_obat_vitamin', $arr_data);
    }
    public function add_catatan_tidur($arr_data)
    {
        return $this->db->insert('catatan_tidur', $arr_data);
    }
    public function add_catatan_minum_susu($arr_data)
    {
        return $this->db->insert('catatan_minum_susu', $arr_data);
    }
    public function add_catatan_makan($arr_data)
    {
        return $this->db->insert('catatan_makan', $arr_data);
    }
    public function add_catatan_bab($arr_data)
    {
        return $this->db->insert('catatan_bab', $arr_data);
    }
    public function add_catatan_snack($arr_data)
    {
        return $this->db->insert('catatan_snack', $arr_data);
    }
    public function add_barang_harus_dibawa($arr_data)
    {
        return $this->db->insert('barang_harus_dibawa', $arr_data);
    }
    public function get_laporan($id,$tanggal){
        $this->db->select("form_harian.*,anak.Id as IDAnak,anak.Nama as NamaAnak,karyawan.Id as IDKaryawan, karyawan.Nama as NamaKaryawan");
        $this->db->from('form_harian');
        $this->db->join('anak', 'form_harian.Anak_Id = anak.Id');
        $this->db->join('karyawan', 'form_harian.Karyawan_Id = karyawan.Id');
        $this->db->where('form_harian.Anak_Id',$id);
        $this->db->where('form_harian.Tanggal',$tanggal);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_daftar_obat_vit($noForm){
        $this->db->select("daftar_obat_vitamin.*, k.Nama as NamaPemberi, kk.Nama as NamaPenanggungJawab");
        $this->db->from('daftar_obat_vitamin');
        $this->db->join('karyawan as k', 'k.Id = daftar_obat_vitamin.Pemberi');
        $this->db->join('karyawan as kk', 'kk.Id = daftar_obat_vitamin.PenanggungJawab');
        $this->db->where('daftar_obat_vitamin.NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_catatan_makan($noForm){
        $this->db->select("*");
        $this->db->from('catatan_makan');
        $this->db->where('NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_catatan_snack($noForm){
        $this->db->select("*");
        $this->db->from('catatan_snack');
        $this->db->where('NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_catatan_minum_susu($noForm){
        $this->db->select("*");
        $this->db->from('catatan_minum_susu');
        $this->db->where('NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_catatan_bab($noForm){
        $this->db->select("*");
        $this->db->from('catatan_bab');
        $this->db->where('NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_catatan_tidur($noForm){
        $this->db->select("*");
        $this->db->from('catatan_tidur');
        $this->db->where('NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_barang_dibawa($noForm){
        $this->db->select("*");
        $this->db->from('barang_harus_dibawa');
        $this->db->where('NoForm',$noForm);
        $query = $this->db->get();
        return $query->result_array();
    }
}