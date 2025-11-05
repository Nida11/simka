<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Drr_report extends Site_utils {

    function __construct() {
        parent::__construct();
        $this->load->model('drr_proses_report_model');
        $this->v_default = 'v_config/';
        $this->file_name = 'simka_bapenda.ini';
    }

    //proses report
    function index() {
        $cek_data = $this->drr_proses_report_model->cek_data_scan();
        foreach ($cek_data as $key) {
            $drr_tgl_proses_daftar = $key->tgl_proses_daftar;
            $drr_tgl_akhir_pajak= $key->tgl_akhir_pajak;
            $drr_tgl_akhir_stnkb= $key->tgl_akhir_stnkb;
            $drr_id_wilayah= $key->id_wilayah;
            $drr_id_kecamatan= $key->id_kecamatan;
            $drr_user_upload= $key->user_upload;
            $counter = $drr_tgl_proses_daftar."#".$drr_tgl_akhir_pajak."#".$drr_tgl_akhir_stnkb."#".$drr_id_wilayah."#".$drr_id_kecamatan."#".$drr_user_upload."#";
            $proses = $this->drr_proses_report_model->cek_data_report($counter);

            if (!$proses) {
                  $masuk = array('drr_tgl_scan' =>$key->tgl_scan,
                        'drr_tgl_proses_daftar' =>$key->tgl_proses_daftar,
                        'drr_tgl_akhir_pajak' =>$key->tgl_akhir_pajak,
                        'drr_tgl_akhir_stnk' =>$key->tgl_akhir_stnkb,
                        'drr_id_wilayah' =>$key->id_wilayah,
                        'drr_id_kecamatan'=>$key->id_kecamatan,
                        'drr_user_upload'=>$key->user_upload,
                        'drr_jumlah'=> 1,
                        'drr_counter' => $counter
                    );
                $this->db->insert('drr_report_'.date('Y'), $masuk); 
            }else{
                foreach ($proses as $key1) {
                    // $tgl1 = "2013-05-09";// pendefinisian tanggal awal
                    // $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
                    // if ($key1->drr_tgl_scan == $tgl2) {
                    //  # code...
                    // }else{
                        $masuk = array('drr_jumlah'=> $key1->drr_jumlah + 1,
                                        'drr_tgl_scan' => $key->tgl_scan
                        );
                        $this->db->where(array('drr_counter'=>$key1->drr_counter));
                        $this->db->update('drr_report_'.date('Y'),$masuk);
                    // }
                }
            }
        }

        $content['tampil'] = $this->drr_proses_report_model->cek_data_scan();
        $content['js'] = get_js_modules('admin/ngconfig');
        $content['ini_array'] = parse_ini_file($this->file_name);
        $data['title'] = 'Admin Index';
        $data['content_banner'] = $this->load->view('content_banner/admin', null, true);
        $data['content'] = $this->load->view($this->v_default.'drr_proses_report', $content, true);
        $this->load->view('template_main', $data);
    }

}

/* End of file drr_report.php */
/* Location: ./application/modules/admin/controllers/drr_report.php */
