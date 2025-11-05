<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	function proses_generated($tipe, $tahun, $produksi1, $produksi2, $wilayah1, $wilayah2, $kecamatan1, $kecamatan2, $pajak1, $pajak2, $stnk1, $stnk2) {
		$pajak1splt = explode("-", $pajak1);
		$pajak2splt = explode("-", $pajak2);
		$stnk1splt = explode("-", $stnk1);
		$stnk2splt = explode("-", $stnk2);
		$produksi1splt = explode("-", $produksi1);
		$produksi2splt = explode("-", $produksi2);

		if ($tipe == "proses") {
			$sql = "SELECT COUNT(simka_data_scan.id_scan_data) as total";
		} else {
			$sql = "SELECT 
				simka_data_scan.id_scan_data,
				simka_data_scan.no_scan,
				simka_data_scan.id_wilayah,
				simka_data_scan.id_kecamatan,
				simka_data_scan.no_polisi,
				simka_data_scan.file_image,
				simka_data_scan.user_upload,
				simka_data_scan.status_data,
				simka_data_scan.tgl_scan,
				simka_data_scan.tgl_akhir_pajak,
				simka_data_scan.tgl_akhir_stnkb,
				simka_data_scan.tgl_proses_daftar,
				simka_data_scan.tgl_proses_tetap,
				simka_data_scan.tgl_proses_bayar,
				simka_data_scan.tgl_akhir_pjklm,
				simka_data_scan.tgl_akhir_pjkbr,
				simka_data_scan.tgl_insrow,
				(SELECT no_rangka FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS no_rangka,
				(SELECT no_mesin FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS no_mesin,
				(SELECT no_polisi_format FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS no_polisi";
		}

		$sql .= " FROM simka_data_scan WHERE YEAR(simka_data_scan.tgl_scan) = '$tahun'";
		$sql .= (!empty($produksi1) && !empty($produksi2)) ? " AND MONTH(simka_data_scan.tgl_scan) BETWEEN ".$produksi1splt[0]." AND ".$produksi2splt[0]." AND DAY(simka_data_scan.tgl_scan) BETWEEN ".$produksi1splt[1]." AND ".$produksi2splt[1]."" : "";
		$sql .= (!empty($wilayah1) && !empty($wilayah2)) ? " AND simka_data_scan.id_wilayah BETWEEN '$wilayah1' AND '$wilayah2'" : "";
		$sql .= (!empty($kecamatan1) && !empty($kecamatan2)) ? " AND simka_data_scan.id_kecamatan BETWEEN '$kecamatan1' AND '$kecamatan2'" : "";
		$sql .= (!empty($pajak1) && !empty($pajak2)) ? " AND MONTH(simka_data_scan.tgl_akhir_pajak) BETWEEN ".$pajak1splt[0]." AND ".$pajak2splt[0]." AND DAY(simka_data_scan.tgl_akhir_pajak) BETWEEN ".$pajak1splt[1]." AND ".$pajak2splt[1]."" : "";
		$sql .= (!empty($stnk1) && !empty($stnk2)) ? " AND MONTH(simka_data_scan.tgl_akhir_stnkb) BETWEEN ".$stnk1splt[0]." AND ".$stnk2splt[0]." AND DAY(simka_data_scan.tgl_akhir_stnkb) BETWEEN ".$stnk1splt[1]." AND ".$stnk2splt[1]."" : "";
		$sql .= (!$this->session->userdata('is_admin')) ? " AND user_upload='".$this->session->userdata('id_user')."'" : "";
		$sql .= " ORDER BY simka_data_scan.id_scan_data DESC";

		return $this->db->query($sql)->result_array();
	}

	function proses_generated2($tipe, $tahun, $produksi1, $produksi2) {
		$produksi1splt = explode("-", $produksi1);
		$produksi2splt = explode("-", $produksi2);

		if ($tipe == "proses") {
			$sql = "SELECT COUNT(simka_data_scan.id_scan_data) as total";
		} else {
			$sql = "SELECT 
				-- simka_data_scan.id_scan_data,
				simka_data_scan.no_scan,
				-- simka_data_scan.id_wilayah,
				-- simka_data_scan.id_kecamatan,
				simka_data_scan.no_polisi,
				-- simka_data_scan.file_image,
				simka_data_scan.user_upload,
				-- simka_data_scan.status_data,
				simka_data_scan.tgl_scan,
				simka_data_scan.tgl_akhir_pajak,
				-- simka_data_scan.tgl_akhir_stnkb,
				-- simka_data_scan.tgl_proses_daftar,
				-- simka_data_scan.tgl_proses_tetap,
				-- simka_data_scan.tgl_proses_bayar,
				-- simka_data_scan.tgl_akhir_pjklm,
				-- simka_data_scan.tgl_akhir_pjkbr,
				-- simka_data_scan.tgl_insrow,
				(SELECT no_rangka FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS no_rangka,
				(SELECT no_mesin FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS no_mesin,
				(SELECT no_polisi_format FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS no_polisi,
				(SELECT nama_pemilik FROM simka_identitas_kendaraan WHERE no_polisi = simka_data_scan.no_polisi AND id_wilayah = simka_data_scan.id_wilayah AND id_kecamatan = simka_data_scan.id_kecamatan AND tgl_akhir_pajak = simka_data_scan.tgl_akhir_pajak ORDER BY id_identitas_kendaraan DESC LIMIT 1) AS nama_pemilik";
		}

		$sql .= " FROM simka_data_scan WHERE YEAR(simka_data_scan.tgl_scan) = '$tahun'";
		$sql .= (!empty($produksi1) && !empty($produksi2)) ? " AND MONTH(simka_data_scan.tgl_scan) BETWEEN ".$produksi1splt[0]." AND ".$produksi2splt[0]." AND DAY(simka_data_scan.tgl_scan) BETWEEN ".$produksi1splt[1]." AND ".$produksi2splt[1]."" : "";
		$sql .= (!$this->session->userdata('is_admin')) ? " AND user_upload='".$this->session->userdata('id_user')."'" : "";
		$sql .= " ORDER BY simka_data_scan.id_scan_data DESC";

		return $this->db->query($sql)->result_array();
	}

	function get_generated($id_wilayah, $id_kecamatan, $user_upload, $tgl_scan, $tgl_akhir_pajak, 
                        $tgl_akhir_stnkb, $tgl_proses_daftar) {
        $results = array();
        $sql = "SELECT * 
                    FROM drr_report 
                    WHERE drr_id_wilayah = '$id_wilayah' 
                        AND drr_id_kecamatan = '$id_kecamatan'                         
                        AND drr_user_upload = '$user_upload'
                        AND drr_tgl_scan = '$tgl_scan'
                        AND drr_tgl_akhir_pajak = '$tgl_akhir_pajak'
                        AND drr_tgl_akhir_stnk = '$tgl_akhir_stnkb'
                        AND drr_tgl_proses_daftar = '$tgl_proses_daftar'
                    GROUP BY id DESC";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

}

/* End of file report_model.php */
/* Location: ./application/modules/rekapitulasi/models/report_model.php */
