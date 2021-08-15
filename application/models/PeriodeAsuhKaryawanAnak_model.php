<?php
class PeriodeAsuhKaryawanAnak_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_periode_asuh_karyawan_anak($slug = FALSE)
	{  
        $this->db->select("karyawan.Nama as NamaKaryawan,karyawan.Id as IDKaryawan,anak.Nama as NamaAnak, anak.Id as IDAnak, periode_asuh.TanggalAwal,periode_asuh.TanggalAkhir,periode_asuh.Id as idPeriodeAsuh,periode_asuh_karyawan_anak.Id");
        $this->db->from('periode_asuh_karyawan_anak');
        $this->db->join('karyawan', 'karyawan.Id = periode_asuh_karyawan_anak.Karyawan_Id');
        $this->db->join('anak', 'anak.Id = periode_asuh_karyawan_anak.Anak_Id');
        $this->db->join('periode_asuh', 'periode_asuh.Id = periode_asuh_karyawan_anak.Periode_Asuh_Id');
        $this->db->where('anak.Hapus',0);
        $this->db->where('periode_asuh.Status',1);
        $this->db->order_by('anak.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        return $query->row_array();
	}
	public function add_periode_asuh_karyawan_anak($arr_data)
	{
	    return $this->db->insert('periode_asuh_karyawan_anak', $arr_data);
	}
    public function edit_periode_asuh_karyawan_anak($arr_data,$id) {
        $this->db->where('Id', $id);
        return $this->db->update('periode_asuh_karyawan_anak', $arr_data);
    }
}