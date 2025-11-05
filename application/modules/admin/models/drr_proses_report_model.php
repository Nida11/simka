<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drr_proses_report_model extends CI_Model {

    // function cek_data_report($drr_tgl_proses_daftar, $drr_tgl_akhir_pajak, $drr_tgl_akhir_stnkb, $drr_id_wilayah, $drr_id_kecamatan, $drr_user_upload)
    // {
    //     $data2 = array('drr_tgl_proses_daftar' =>$drr_tgl_proses_daftar,
    //                     'drr_tgl_akhir_pajak' =>$drr_tgl_akhir_pajak,
    //                     'drr_tgl_akhir_stnkb' =>$drr_tgl_akhir_stnkb,
    //                     'drr_id_wilayah' =>$drr_id_wilayah,
    //                     'drr_id_kecamatan'=>$drr_id_kecamatan,
    //                     'drr_user_upload'=>$drr_user_upload
    //      );
    //     $this->db->where($data2);
    //     return $this->db->get('drr_report')->result_array();
    // }

    function cek_data_report($where) {
        $this->load->dbforge();

        $data2 = array(
            'drr_counter' =>$where
         );
        $this->db->where($data2);
        $cek = $this->db->get('drr_report_'.date('Y'));
        if ($cek) {
            $this->db->where($data2);
            return $this->db->get('drr_report_'.date('Y'))->result();
        } else {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'drr_tgl_scan' => array(
                    'type' => 'date'
                ),
                'drr_tgl_proses_daftar' => array(
                    'type' => 'date'
                ),
                'drr_tgl_akhir_pajak' => array(
                    'type' => 'date'
                ),
                'drr_tgl_akhir_stnk' => array(
                    'type' => 'date'
                ),
                'drr_id_wilayah' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'drr_id_kecamatan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'drr_user_upload' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'drr_jumlah' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'drr_counter' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                )
            );

            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('drr_report_'.date('Y'), TRUE);
            return false;
        }
    }

    function cek_data_scan() {
        // $tgl1 = "2013-05-09";// pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))));
        return $this->db->get_where('simka_data_scan',array('tgl_scan'=> $tgl2))->result();
    }

}

/* End of file drr_proses_report_model.php */
/* Location: ./application/modules/admin/models/drr_proses_report_model.php */
