<?php
class PaketKatering_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{  
        $this->db->order_by('Tanggal', 'DESC');
        $this->db->order_by('Id', 'Asc');
        if ($slug === FALSE)
        {
            $query = $this->db->get('paket_katering');
            return $query->result_array();
        }
        $query = $this->db->get_where('paket_katering', array('Id' => $slug));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('paket_katering', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('paket_katering', $arr_data);
    }
    public function get_last() {
        $this->db->select('Id,Nama,Tanggal');
        $this->db->limit(1);
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('paket_katering');
        return $query->row_array();
    }
    public function get_detail($id){
        $this->db->select("paket_katering.*,detail_katering.Id as IDDetail, detail_katering.Nama as NamaDetail, detail_katering.Bahan");
        $this->db->from('paket_katering');
        $this->db->join('detail_katering', 'paket_katering.Id = detail_katering.Paket_Katering_Id');
        $this->db->order_by('paket_katering.Id');
        $this->db->where("paket_katering.Id = '".$id."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete_detail($id) {
        $this->db->where('Paket_Katering_Id', $id);
        return $this->db->delete('detail_katering');
    }
    public function exist($nama,$tanggal){
        $this->db->select("*");
        $this->db->from('paket_katering');
        $this->db->where('Nama',$nama);
        $this->db->where('Tanggal',$tanggal);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_by_month($bulan){
        $query = $this->db->query("SELECT * FROM paket_katering WHERE Month(Tanggal) ='".$bulan."' And Year(Tanggal) ='".date('Y')."'");      
        return $query->result_array();
    }
}