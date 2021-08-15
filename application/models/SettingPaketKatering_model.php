<?php
class SettingPaketKatering_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function get($slug = FALSE)
	{
        if ($slug === FALSE)
        {
            $query = $this->db->get('setting_paket_katering');
            return $query->result_array();
        }

        $query = $this->db->get_where('IdSetting', array('Id' => $slug));
        return $query->row_array();
	}
    public function edit($arr_data) {
        $this->db->where('IdSetting', $arr_data['IdSetting']);
        return $this->db->update('setting_paket_katering', $arr_data);
    }
}