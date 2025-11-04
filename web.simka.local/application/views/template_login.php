<?php 
	$data = site_component();
	echo $this->load->view('content_main/header', $data);
	echo $content;
?>