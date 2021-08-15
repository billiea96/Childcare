<?php
class IndikatorPerkembangan_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        $this->db->select("indikator_perkembangan.*,kategori_indikator.Id as IDKategori ,kategori_indikator.Nama as NamaKategori");
        $this->db->from('indikator_perkembangan');
        $this->db->join('kategori_indikator', 'indikator_perkembangan.Kategori_Indikator_Id = kategori_indikator.Id');
        $this->db->where('indikator_perkembangan.Hapuskah',0);
        $this->db->order_by('kategori_indikator.Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("indikator_perkembangan.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function add($arr_data)
	{
	    return $this->db->insert('indikator_perkembangan', $arr_data);
	}
    public function edit($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('indikator_perkembangan', $arr_data);
    }
    public function delete($id) {
        $this->db->where('Id', $id);
        return $this->db->update('indikator_perkembangan', array('Hapuskah' => 1));
    }
    public function getByKategori($id){
        $query = $this->db->get_where('indikator_perkembangan', array('Kategori_Indikator_Id' => $id,'Hapuskah' => 0));
        return $query->result_array();
    }
    public function get_all(){
          $query = $this->db->query("
                    SELECT ki.Id, ki.Nama, ip.Id as IDIndikator , ip.Indikator, j.Jumlah
                    FROM kategori_indikator ki
                    INNER JOIN indikator_perkembangan ip on ki.Id=ip.Kategori_Indikator_Id
                    INNER JOIN (SELECT ki.Id, ki.Nama, ip.Indikator, COUNT(ip.Id) as Jumlah
                                FROM kategori_indikator ki
                                INNER JOIN indikator_perkembangan ip on ki.Id=ip.Kategori_Indikator_Id
                                WHERE ki.Hapuskah=0 AND ip.Hapuskah=0
                                GROUP BY ki.Id) as j on ki.Id=j.Id
                    WHERE ki.Hapuskah=0 AND ip.Hapuskah=0 AND ki.Aktif=1");      
        return $query->result_array();
    }
}