<?php
class CatatanPerkembangan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('catatan_perkembangan');
            return $query->result_array();
        }

        $query = $this->db->get_where('catatan_perkembangan', array('NoForm' => $slug));
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('catatan_perkembangan', $arr_data);
	}
    public function get_last(){
        $this->db->select('NoForm');
        $this->db->limit(1);
        $this->db->order_by('NoForm', 'DESC');
        $query = $this->db->get('catatan_perkembangan');
        return $query->row_array();
    }
    public function exist($id,$tanggal){
        $this->db->select("*");
        $this->db->from('catatan_perkembangan');
        $this->db->where('Anak_Id',$id);
        $this->db->where('Month(Tanggal)',date('m',strtotime($tanggal)));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_laporan($id,$tanggal){
        $query = $this->db->query("
            SELECT ki.Id,cp.Tanggal,cp.KesimpulanSaran,cpp.Nilai,ip.Indikator,ki.Nama, aa.jumlah
            FROM catatan_perkembangan as cp 
            inner join catatan_perkembangan_has_indikator_perkembangan as cpp on cp.NoForm=cpp.NoForm
            inner join indikator_perkembangan as ip on ip.Id=cpp.Id
            inner join kategori_indikator as ki on ki.Id=ip.Kategori_Indikator_Id
            inner join (SELECT ki.Id,cp.Tanggal,cp.KesimpulanSaran,cpp.Nilai,ip.Indikator,ki.Nama, COUNT(ki.Id) as jumlah
                        FROM catatan_perkembangan as cp 
                        inner join catatan_perkembangan_has_indikator_perkembangan as cpp on cp.NoForm=cpp.NoForm
                        inner join indikator_perkembangan as ip on ip.Id=cpp.Id
                        inner join kategori_indikator as ki on ki.Id=ip.Kategori_Indikator_Id
                        where cp.Anak_Id='".$id."' AND cp.Tanggal LIKE '".$tanggal."-%'
                        GROUP BY ki.Id
                        ORDER BY ki.Id) as aa on aa.Id = ki.Id
            where cp.Anak_Id='".$id."' AND cp.Tanggal LIKE '".$tanggal."-%'
            ORDER BY ki.Id"
        );      
        return $query->result_array();
    }
}