<?php
class Pembayaran_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('pembayaran');
            return $query->result_array();
        }

        $query = $this->db->get_where('pembayaran', array('Id' => $slug));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('pembayaran', $arr_data);
	}
    public function exist($id_anak,$bulan){
        $this->db->select("*");
        $this->db->from('pembayaran');
        $this->db->where('Month(Tanggal)',$bulan);
        $this->db->where('Year(Tanggal)',date('Y'));
        $this->db->where('Anak_Id',$id_anak);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_laporan($id_anak,$tahun){
        $query = $this->db->query("
            SELECT * 
            FROM pembayaran 
            WHERE Anak_Id ='".$id_anak."' AND Year(Tanggal) = '".$tahun."'");      
        return $query->result_array();
    }
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('pembayaran', $arr_data);
    }
    public function get_belum_lunas($id_anak,$month){
        $query = $this->db->query("
            SELECT a.Id as IDAnak, a.Nama, p.*
            FROM anak a
            inner join pembayaran p on a.Id = p.Anak_Id
            where Month(p.Tanggal)='".$month."' AND p.Lunas=0 AND a.Id='".$id_anak."'" 
        );
        return $query->row_array();
    }
}