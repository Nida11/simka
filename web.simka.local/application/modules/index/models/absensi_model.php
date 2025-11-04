<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->id_absen = $this->session->userdata('ID_ABSEN');
	}

	function get_data($periode='', $id_absen=''){
		$id_absen = (empty($id_absen)) ? $this->id_absen : $id_absen;
		if(!empty($this->id_absen)){
			$sql = "SELECT 
						USER_ID,
						TO_CHAR(TO_DATE(BULAN, 'YYYYMM'), 'MONTH') AS PERIODE_BULAN,
						TO_CHAR(TO_DATE(BULAN, 'YYYYMM'), 'YYYY') AS PERIODE_TAHUN,
						MP,
						S24,
						OP,
						PS,
						ML,
						SR,
						SM,
						SG,
						PG,
						IP,
						D,
						S,
						CB,
						CT,
						CR,
						CL,
						I,
						LB,
						CPB,
						TOT_WH_STD,
						TOT_WH_CAPAIN,
						JML_HARI_KERJA_NORMAL,
						JML_HARI_KERJA_MASUK,
						JML_JAM_KERJA_JATAH,
						JML_JAM_KERJA_NORMAL,
						JML_JAM_KERJA_MASUK,
						RATA_RATA_JAM_KERJA,
						WH_PERSEN
					FROM FDMSUSR.V_RESUME_ABSENSI
					WHERE USER_ID IS NOT NULL
						AND USER_ID = '$id_absen'";
			$sql .= (!empty($periode)) ? " AND BULAN = '$periode'" : '';
			return $this->db->query($sql)->result_array();
		}else{
			return array();
		}
	}

	function get_rekapitulasi_absensi($id_bagian='', $periode='', $tahun=''){
		$periode = $tahun.''.$periode;
		$sql = "SELECT ROUND(AVG(WH_PERSEN),2) AS TOTAL_WH_PERSEN
				FROM PEGAWAI A 
				LEFT JOIN FDMSUSR.V_RESUME_ABSENSI B ON A.ID_ABSEN = B.USER_ID
				WHERE A.ID_BAGIAN = '$id_bagian'
					AND BULAN = '$periode'";
		return $this->db->query($sql)->result_array();
	}

	function get_leave_request_code(){
		$sql = "SELECT *
				FROM FDMSUSR.MSTLEAVEREQUEST_CODE";
		return $this->db->query($sql)->result_array();
	}
}