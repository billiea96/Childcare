<?php
class Riwayat_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function catatan_makan($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT fh.Tanggal, cm.Jenis, cm.Waktu, cm.Keterangan
            FROM form_harian fh
            INNER join catatan_makan cm on cm.NoForm= fh.NoForm
            WHERE fh.Anak_Id ='".$id."' AND Month(fh.Tanggal)='".$bulan."' AND Year(fh.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function catatan_snack($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT fh.Tanggal, cm.Jenis, cm.Waktu, cm.Keterangan
            FROM form_harian fh
            INNER join catatan_snack cm on cm.NoForm= fh.NoForm
            WHERE fh.Anak_Id ='".$id."' AND Month(fh.Tanggal)='".$bulan."' AND Year(fh.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function catatan_minum_susu($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT fh.Tanggal, c.Waktu, c.CC ,c.Keterangan
            FROM form_harian fh
            INNER join catatan_minum_susu c on c.NoForm= fh.NoForm
            WHERE fh.Anak_Id ='".$id."' AND Month(fh.Tanggal)='".$bulan."' AND Year(fh.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function catatan_obat_vit($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT fh.Tanggal, c.Nama, c.Dosis, c.JadwalMinum, c.WaktuPemberian, k.Nama as Pemberi, kk.Nama as PenanggungJawab
            FROM form_harian fh
            INNER join daftar_obat_vitamin c on c.NoForm= fh.NoForm
            INNER join karyawan k on k.Id= c.Pemberi
            INNER join karyawan kk on kk.Id= c.PenanggungJawab
            WHERE fh.Anak_Id ='".$id."' AND Month(fh.Tanggal)='".$bulan."' AND Year(fh.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function catatan_tidur($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT fh.Tanggal, c.JamMulaiTidur, c.JamBangun
            FROM form_harian fh
            INNER join catatan_tidur c on c.NoForm= fh.NoForm
            WHERE fh.Anak_Id ='".$id."' AND Month(fh.Tanggal)='".$bulan."' AND Year(fh.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function catatan_bab($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT fh.Tanggal, c.Waktu,c.Keterangan
            FROM form_harian fh
            INNER join catatan_bab c on c.NoForm= fh.NoForm
            WHERE fh.Anak_Id ='".$id."' AND Month(fh.Tanggal)='".$bulan."' AND Year(fh.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function kesehatan($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT r.Tanggal, r.Diagnosa, t.Nama, r.Catatan
            FROM riwayat_kesehatan r
            INNER JOIN terapi t on t.Id = r.Terapi_Id
            WHERE r.Anak_Id='".$id."' AND Month(r.Tanggal)='".$bulan."' AND Year(r.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
    public function imunisasi($id,$bulan,$tahun){
        $query = $this->db->query("
            SELECT r.Tanggal, v.Nama, r.Catatan
            FROM riwayat_imunisasi r
            INNER JOIN vaksinasi v on r.Vaksinasi_Id=v.Id
            WHERE r.Anak_Id='".$id."' AND Month(r.Tanggal)='".$bulan."' AND Year(r.Tanggal)='".$tahun."'");      
        return $query->result_array();
    }
}