<?php 
	$data = site_component();
	echo $this->load->view('content_main/header', $data);
	echo $this->load->view('content_main/body');
	echo $this->load->view('content_main/search_panel', $data);
	echo $this->load->view('content_main/notification_section');
	echo (isset($content)) ? $content : $this->load->view('content_main/content');
	echo $this->load->view('content_main/footer', $data); 
?>