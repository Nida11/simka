<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_model extends CI_Model {

	function get_data_wilayah($tipe = '', $tahun='', $bulan='', $tgl1='', $tgl2='') {
		$sql = "SELECT *,
			(SELECT SUM( drr_jumlah ) 
			FROM `drr_report_".date('Y')."` 
			WHERE drr_report_".date('Y').".drr_id_wilayah = simka_wilayah.id_wilayah";
		if ($tipe == 'pajak') {
			$sql .= (!empty($tahun)) ? " AND YEAR(drr_report_".date('Y').".drr_tgl_akhir_pajak) = '$tahun'" : "";
			$sql .= (!empty($bulan)) ? " AND MONTH(drr_report_".date('Y').".drr_tgl_akhir_pajak) = '$bulan'" : "";
			$sql .= (!empty($tgl1) && !empty($tgl2)) ? " AND DAY(drr_report_".date('Y').".drr_tgl_akhir_pajak) BETWEEN '$tgl1' AND '$tgl2'" : "";
		} else if ($tipe == 'stnk') {
			$sql .= (!empty($tahun)) ? " AND YEAR(drr_report_".date('Y').".drr_tgl_akhir_stnk) = '$tahun'" : "";
			$sql .= (!empty($bulan)) ? " AND MONTH(drr_report_".date('Y').".drr_tgl_akhir_stnk) = '$bulan'" : "";
			$sql .= (!empty($tgl1) && !empty($tgl2)) ? " AND DAY(drr_report_".date('Y').".drr_tgl_akhir_stnk) BETWEEN '$tgl1' AND '$tgl2'" : "";
		}
		$sql .= " GROUP BY drr_report_".date('Y').".drr_id_wilayah) as total
			FROM
				`simka_wilayah`";
		// $sql = "SELECT * FROM simka_wilayah ORDER BY nama_singkat ASC";
		return $this->db->query($sql)->result_array();
	}

	function get_data_laporan($user_upload = '', $tahun='', $bulan='', $tgl1='', $tgl2='')	{
		// $user_upload = $this->session->userdata('id_user');

		$sql = "SELECT
					a.Date,
					DAY(a.Date) as tanggal,
					( SELECT user_upload FROM simka_data_scan WHERE";
		$sql .= ($user_upload != '') ? " user_upload = '$user_upload' AND" : "";
		$sql .= " tgl_scan = a.Date GROUP BY tgl_scan ) AS user_upload,
					DAYNAME( a.Date ) AS hari,
					( SELECT COUNT( simka_data_scan.id_scan_data ) FROM simka_data_scan WHERE";
		$sql .= ($user_upload != '') ? " user_upload = '$user_upload' AND" : "";
		$sql .= " tgl_scan = a.Date ) AS jumlah 
				FROM
					(
					SELECT
						last_day( '".$tahun."-".$bulan."-01' ) - INTERVAL ( a.a + ( 10 * b.a ) + ( 100 * c.a ) ) DAY AS Date 
					FROM
						(
						SELECT
							0 AS a UNION ALL
						SELECT
							1 UNION ALL
						SELECT
							2 UNION ALL
						SELECT
							3 UNION ALL
						SELECT
							4 UNION ALL
						SELECT
							5 UNION ALL
						SELECT
							6 UNION ALL
						SELECT
							7 UNION ALL
						SELECT
							8 UNION ALL
						SELECT
							9 
						) AS a
						CROSS JOIN (
						SELECT
							0 AS a UNION ALL
						SELECT
							1 UNION ALL
						SELECT
							2 UNION ALL
						SELECT
							3 UNION ALL
						SELECT
							4 UNION ALL
						SELECT
							5 UNION ALL
						SELECT
							6 UNION ALL
						SELECT
							7 UNION ALL
						SELECT
							8 UNION ALL
						SELECT
							9 
						) AS b
						CROSS JOIN (
						SELECT
							0 AS a UNION ALL
						SELECT
							1 UNION ALL
						SELECT
							2 UNION ALL
						SELECT
							3 UNION ALL
						SELECT
							4 UNION ALL
						SELECT
							5 UNION ALL
						SELECT
							6 UNION ALL
						SELECT
							7 UNION ALL
						SELECT
							8 UNION ALL
						SELECT
							9 
						) AS c 
					) a 
				WHERE";

		if ($tgl1 == '') {
			$sql .= " a.Date BETWEEN '".$tahun."-".$bulan."-01' 
					AND last_day( '".$tahun."-".$bulan."-01' )";
		} else {
			if ($tgl2 == '') {
				$sql .= " a.Date BETWEEN '".$tahun."-".$bulan."-".$tgl1."' 
					AND last_day( '".$tahun."-".$bulan."-01' )";
			} else {
				$sql .= " a.Date BETWEEN '".$tahun."-".$bulan."-".$tgl1."' 
					AND '".$tahun."-".$bulan."-".$tgl2."'";
			}
		}

		$sql .= " ORDER BY
					a.Date";
		// $sql .= " FROM simka_data_scan
		// 		WHERE user_upload = '$user_upload'";
		// $sql .= (!empty($tahun)) ? " AND YEAR(simka_data_scan.tgl_scan) = '$tahun'" : "";
		// $sql .= "GROUP BY simka_data_scan.tgl_scan";

		return $this->db->query($sql)->result_array();
	}

}

/* End of file potensi_model.php */
/* Location: ./application/modules/grafik/models/potensi_model.php */