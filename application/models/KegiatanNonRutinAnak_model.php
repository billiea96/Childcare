<?php
class KegiatanNonRutinAnak_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        $this->db->select("anak.*,kegiatan_non_rutin.Id as IDKegiatan ,kegiatan_non_rutin.Nama as NamaKegiatan, kegiatan_non_rutin.DetailKegiatan");
        $this->db->from('kegiatan_non_rutin_anak');
        $this->db->join('anak', 'anak.Id = kegiatan_non_rutin_anak.Anak_Id');
        $this->db->join('kegiatan_non_rutin', 'kegiatan_non_rutin.Id = kegiatan_non_rutin_anak.Kegiatan_Non_Rutin_Id');
        $this->db->where('anak.Hapus',0);
        $this->db->order_by('anak.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('kegiatan_non_rutin_anak', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('kegiatan_non_rutin_anak', $arr_data);
    }
    public function exist($arr_data){
        $this->db->select("*");
        $this->db->from('kegiatan_non_rutin_anak');
        $this->db->where('Kegiatan_Non_Rutin_Id',$arr_data["Kegiatan_Non_Rutin_Id"]);
        $this->db->where('Anak_Id',$arr_data["Anak_Id"]);
        $this->db->where('Tanggal',$arr_data["Tanggal"]);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_laporan($id,$tanggal){
        $this->db->select("anak.Nama as NamaAnak,kegiatan_non_rutin.Nama as NamaKegiatan,kegiatan_non_rutin.DetailKegiatan,kegiatan_non_rutin_anak.Catatan,kegiatan_non_rutin_anak.Tanggal");
        $this->db->from('kegiatan_non_rutin_anak');
        $this->db->join('anak', 'anak.Id = kegiatan_non_rutin_anak.Anak_Id');
        $this->db->join('kegiatan_non_rutin', 'kegiatan_non_rutin.Id = kegiatan_non_rutin_anak.Kegiatan_Non_Rutin_Id');
        $this->db->where('kegiatan_non_rutin_anak.Anak_Id',$id);
        $this->db->where('kegiatan_non_rutin_anak.Tanggal',$tanggal);
        $query = $this->db->get();
        return $query->result_array();
    }
}