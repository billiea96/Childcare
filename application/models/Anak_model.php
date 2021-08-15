<?php
class Anak_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get_anak($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get_where('anak',array('Hapus' => 0));
            return $query->result_array();
        }

        $query = $this->db->get_where('anak', array('Id' => $slug,'Hapus'=>0));
        return $query->row_array();
    }
    public function get_anak2($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('anak');
            return $query->result_array();
        }

        $query = $this->db->get_where('anak', array('Id' => $slug));
        return $query->row_array();
    }
    public function get($slug = FALSE)
    {
        $this->db->select("anak.*,orangtua.Id as IDOrangtua ,orangtua.NamaAyah, orangtua.NamaIbu");
        $this->db->from('anak');
        $this->db->join('orangtua', 'orangtua.Id = anak.Orangtua_Id');
        $this->db->order_by('anak.Hapus',"ASC");
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_need_validation($slug = FALSE)
    {
        $this->db->select("anak.*,orangtua.Id as IDOrangtua ,orangtua.NamaAyah, orangtua.NamaIbu,paket.Nama as NamaPaket,daftarpaket.Tanggal as TanggalTitip,form_pendaftaran.NoForm");
        $this->db->from('anak');
        $this->db->join('orangtua', 'orangtua.Id = anak.Orangtua_Id');
        $this->db->join('form_pendaftaran', 'form_pendaftaran.Anak_Id = anak.Id');
        $this->db->join('daftarpaket', 'daftarpaket.Anak_Id = anak.Id');
        $this->db->join('paket', 'daftarpaket.Paket_Id = paket.Id');
        $this->db->where("form_pendaftaran.StatusValidasi",0);
        $this->db->order_by('anak.Hapus',"ASC");
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function get_notin_form_today($id){
        $query = $this->db->query("
            SELECT a.Id,a.Nama 
            FROM anak a 
            inner join periode_asuh_karyawan_anak paka on a.Id = paka.Anak_Id 
            inner join periode_asuh pa on pa.Id=paka.Periode_Asuh_Id 
            inner join karyawan k on k.Id = paka.Karyawan_Id 
            where a.Id not in( SELECT a.Id from anak a inner join form_harian fh on a.Id = fh.Anak_Id where a.id IN(fh.Anak_Id) and date(fh.Tanggal) = curdate() ) and a.Hapus =0 and pa.Status =1 and k.Id ='".$id."'");      
        return $query->result_array();
    }
    public function get_notin_form_today2(){
        $query = $this->db->query("
            SELECT a.Id,a.Nama 
            FROM anak a 
            where a.Id not in( SELECT a.Id from anak a inner join form_harian fh on a.Id = fh.Anak_Id where a.id IN(fh.Anak_Id) and date(fh.Tanggal) = curdate() ) and a.Hapus =0");      
        return $query->result_array();
    }
    public function get_anak_asuh($id){
        $query = $this->db->query("
            SELECT a.Id, a.Nama 
            FROM anak a inner join periode_asuh_karyawan_anak paka on a.Id = paka.Anak_Id inner join periode_asuh pa on pa.Id=paka.Periode_Asuh_Id inner join karyawan k on k.Id=paka.Karyawan_Id 
            WHERE a.Id in(SELECT a.Id FROM anak a inner join form_harian fh on a.Id=fh.Anak_Id where fh.Status=0 and date(fh.Tanggal) = curdate()) and a.Hapus =0 and pa.Status=1 and k.Id = '".$id."'");
        return $query->result_array();
    }
    public function get_anak_asuh2(){
        $query = $this->db->query("
            SELECT a.Id, a.Nama 
            FROM anak a 
            WHERE a.Id in(SELECT a.Id FROM anak a inner join form_harian fh on a.Id=fh.Anak_Id where fh.Status=0 and date(fh.Tanggal) = curdate()) and a.Hapus =0");
        return $query->result_array();
    }
    public function get_notin_pembayaran($month){
        $query = $this->db->query("
            SELECT *
            FROM anak
            where Id NOT IN(SELECT Anak_Id
                            FROM pembayaran
                            WHERE month(Tanggal) = '".$month."')");
        return $query->result_array();
    }
    public function get_belum_lunas($month){
        $query = $this->db->query("
            SELECT a.Id as IDAnak, a.Nama, p.*
            FROM anak a
            inner join pembayaran p on a.Id = p.Anak_Id
            where Month(p.Tanggal)='".$month."' AND p.Lunas=0"
        );
        return $query->result_array();
    }
    public function get_orangtua_byanak($slug = FALSE)
    {
        $this->db->select("orangtua.*");
        $this->db->from('anak');
        $this->db->join('orangtua', 'orangtua.Id = anak.Orangtua_Id');
        if ($slug === FALSE)
        {
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->where("anak.Id = '".$slug."'", NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function add_anak($arr_data)
	{
	    return $this->db->insert('anak', $arr_data);
	}
    public function edit_anak($arr_data) {
        $this->db->where('Id', $arr_data['Id']);
        return $this->db->update('anak', $arr_data);
    }
    public function delete_anak($id) {
        $this->db->where('Id', $id);
        return $this->db->update('anak', array('Hapus' => 1));
    }
    public function get_last_anak() {
        $this->db->select('Id');
        $this->db->limit(1);
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('anak');
        return $query->row_array();
    }
    public function get_tidak_ada_pengasuh(){
        $query = $this->db->query('SELECT anak.* from anak where Id NOT in (select Anak_Id from periode_asuh_karyawan_anak pa inner join periode_asuh p on pa.Periode_Asuh_Id=p.Id where p.Status=1)AND Hapus=0');
        return $query->result_array();
    }
    public function get_no_username()
    {
        $query = $this->db->get_where('anak',array('Hapus' => 0,'Username' => NULL));
        return $query->result_array();
    }
}