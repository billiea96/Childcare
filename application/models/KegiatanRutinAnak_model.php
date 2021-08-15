<?php
class KegiatanRutinAnak_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        $this->db->select("anak.*,kegiatan_rutin.Id as IDKegiatan ,kegiatan_rutin.Nama as NamaKegiatan, kegiatan_rutin.DetailKegiatan");
        $this->db->from('kegiatan_anak');
        $this->db->join('anak', 'anak.Id = kegiatan_anak.Anak_Id');
        $this->db->join('kegiatan_rutin', 'kegiatan_rutin.Id = kegiatan_anak.Kegiatan_Rutin_Id');
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
	    return $this->db->insert('kegiatan_anak', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('kegiatan_anak', $arr_data);
    }
    public function exist($arr_data){
        $this->db->select("*");
        $this->db->from('kegiatan_anak');
        $this->db->where('Kegiatan_Rutin_Id',$arr_data["Kegiatan_Rutin_Id"]);
        $this->db->where('Anak_Id',$arr_data["Anak_Id"]);
        $this->db->where('Tanggal',$arr_data["Tanggal"]);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_laporan($id,$tanggal){
        $this->db->select("anak.Nama as NamaAnak,kegiatan_rutin.Nama as NamaKegiatan,kegiatan_rutin.Hari,kegiatan_rutin.DetailKegiatan,kegiatan_rutin.JamMulai,kegiatan_rutin.JamSelesai,kegiatan_anak.Catatan,kegiatan_anak.Tanggal");
        $this->db->from('kegiatan_anak');
        $this->db->join('anak', 'anak.Id = kegiatan_anak.Anak_Id');
        $this->db->join('kegiatan_rutin', 'kegiatan_rutin.Id = kegiatan_anak.Kegiatan_Rutin_Id');
        $this->db->where('kegiatan_anak.Anak_Id',$id);
        $this->db->where('kegiatan_anak.Tanggal',$tanggal);
        $this->db->order_by('kegiatan_rutin.JamMulai');
        $query = $this->db->get();
        return $query->result_array();
    }
}