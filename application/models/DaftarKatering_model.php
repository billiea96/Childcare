<?php
class DaftarKatering_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function add($data){
        return $this->db->insert('daftar_katering', $data);
    }
    public function get_calendar_data($year,$month){
    	$date=strtotime("+3 day",strtotime(date('Y-m-d'))); 
    	$date=date('Y-m-d',$date);
    	$query = $this->db->query("SELECT * FROM paket_katering WHERE Tanggal >= '".$date."' and Nama like '%1%' and month(Tanggal) = ".$month." and year(Tanggal) =".$year);

        $data = array();
        foreach ($query->result_array() as $key => $value) {
        	$day = intval(substr($value['Tanggal'],8,2));
        	$temp = $this->get_detail($value['Id']);
        	$nama ="";
        	foreach ($temp as $value2) {
        		$nama.= $value2['Nama'].'<br>';
        	}
        	$data[$day] =$nama;
        	
        }

        return $data;
    }
    public function get_detail($id){
    	$query = $this->db->get_where('detail_katering', array('Paket_Katering_Id' => $id));
        return $query->result_array();
    }
    public function get_detail_by_tanggal($tanggal){
		$query = $this->db->query("SELECT pk.Id,dk.Nama,dk.Bahan FROM paket_katering pk inner join detail_katering dk on pk.Id=dk.Paket_Katering_Id WHERE pk.Nama like '%1%' and pk.Tanggal ='".$tanggal."'");    	
		return $query->result_array();
    }
    public function generate($year=null,$month=null){
    	$conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url().'DaftarKatering/index' 
		);

		$conf['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}
        	<div class="day_num">{day}</div>
        	<div class="my_content">{content}</div>
        {/cal_cell_content}
        {cal_cell_content_today}
        	<div class="day_num highlight">{day}</div>
        	<div class="my_content">{content}</div>
        {/cal_cell_content_today}

        {cal_cell_no_content}
        	<div class="day_num">{day}</div>
        {/cal_cell_no_content}
        {cal_cell_no_content_today}
        	<div class="day_num highlight">{day}</div>
        {/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
		';
		
		$this->load->library('calendar',$conf);

		$data = $this->get_calendar_data($year,$month);

		return $this->calendar->generate($year,$month,$data);
    }
    /*UNTUK PAKET 2*/
    public function get_calendar_data2($year,$month){
    	$date=strtotime("+3 day",strtotime(date('Y-m-d'))); 
    	$date=date('Y-m-d',$date);
    	$query = $this->db->query("SELECT * FROM paket_katering WHERE Tanggal >= '".$date."' and Nama like '%2%' and month(Tanggal) = ".$month." and year(Tanggal) =".$year);

        $data = array();
        foreach ($query->result_array() as $key => $value) {
        	$day = intval(substr($value['Tanggal'],8,2));
        	$temp = $this->get_detail($value['Id']);
        	$nama ="";
        	foreach ($temp as $value2) {
        		$nama.= $value2['Nama'].'<br>';
        	}
        	$data[$day] =$nama;
        	
        }

        return $data;
    }
    public function get_detail_by_tanggal2($tanggal){
		$query = $this->db->query("SELECT pk.Id,dk.Nama,dk.Bahan FROM paket_katering pk inner join detail_katering dk on pk.Id=dk.Paket_Katering_Id WHERE pk.Nama like '%2%' and pk.Tanggal ='".$tanggal."'");    	
		return $query->result_array();
    }
    public function generate2($year=null,$month=null){
    	$conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url().'DaftarKatering/index' 
		);

		$conf['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}
        	<div class="day_num">{day}</div>
        	<div class="my_content">{content}</div>
        {/cal_cell_content}
        {cal_cell_content_today}
        	<div class="day_num highlight">{day}</div>
        	<div class="my_content">{content}</div>
        {/cal_cell_content_today}

        {cal_cell_no_content}
        	<div class="day_num">{day}</div>
        {/cal_cell_no_content}
        {cal_cell_no_content_today}
        	<div class="day_num highlight">{day}</div>
        {/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
		';
		
		$this->load->library('calendar',$conf);

		$data = $this->get_calendar_data2($year,$month);

		return $this->calendar->generate($year,$month,$data);
    }
    public function get_for_bayar($id_anak,$bulan){
        $query = $this->db->query("
            SELECT pk.Nama,pk.Tanggal 
            FROM daftar_katering dk 
            INNER JOIN paket_katering pk on dk.Paket_Katering_Id=pk.Id 
            where dk.Anak_Id='".$id_anak."' AND Month(pk.Tanggal) = '".$bulan."' And Year(pk.Tanggal) ='".date('Y')."'");      
        return $query->result_array();
    }
    public function get_laporan($id_anak,$tanggal){
        $query = $this->db->query("
            SELECT  pk.Id,pk.Nama as NamaPaket,pk.Tanggal,dd.Nama as NamaMakanan,dd.Bahan,j.Jumlah
            FROM daftar_katering dk
            INNER JOIN paket_katering pk on dk.Paket_Katering_Id=pk.Id
            INNER JOIN detail_katering dd on dd.Paket_Katering_Id = pk.Id
            INNER JOIN (SELECT  pk.Id, COUNT(pk.Id) as JUmlah
                        FROM daftar_katering dk
                        INNER JOIN paket_katering pk on dk.Paket_Katering_Id=pk.Id
                        INNER JOIN detail_katering dd on dd.Paket_Katering_Id = pk.Id
                        WHERE dk.Anak_Id ='".$id_anak."' AND pk.Tanggal LIKE '".$tanggal."-%'
                        GROUP BY pk.Id) as j on j.Id=pk.Id
            WHERE dk.Anak_Id ='".$id_anak."' AND pk.Tanggal LIKE '".$tanggal."-%'
            ORDER BY pk.Tanggal"
        );      
        return $query->result_array();
    }
    public function exist($id,$id_paket){
        $this->db->select("*");
        $this->db->from('daftar_katering');
        $this->db->where('Anak_Id',$id);
        $this->db->where('Paket_Katering_Id',$id_paket);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_rekap($bulan){
        $query = $this->db->query("
            SELECT pk.Id,pk.Nama,pk.Tanggal, Sum(dk.Jumlah) as Jumlah
            FROM daftar_katering dk INNER JOIN paket_katering pk on dk.Paket_Katering_Id=pk.Id
            WHERE Month(pk.Tanggal) = '".$bulan."' AND Year(pk.Tanggal) = '".date('Y')."'
            GROUP BY pk.Tanggal,pk.Nama"
        );      
        return $query->result_array();
    }
}