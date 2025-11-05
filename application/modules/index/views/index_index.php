<?php $foto_pegawai = ($this->session->userdata('foto_pegawai')) ? $this->session->userdata('foto_pegawai') : 'avatar.png'  ?>
<style type="text/css">
	.image_container{
		background-image: url("<?php echo base_url(); ?>public/foto_pegawai/<?php echo $foto_pegawai; ?>") !important;
		background-repeat: no-repeat;
		background-size: cover !important;
		background-position: center;
		display: block;
		height: 150px;
		width: 150px;
		overflow: hidden;
		border-radius: 50%;
		margin-top: -20px;
		margin-left: auto;
		margin-right: auto;
		z-index: 100;
  	}
</style>


<div class='panel panel-default' data-ng-app='remunerasi' data-ng-controller='index_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel-heading image_container'></div>
	<div class='panel-body' data-ng-init='getData()'>
		<h4 class='align_center'>Selamat Datang,<br>
			<small>
				<?php echo $this->session->userdata('id_user'); ?> &bullet; 
				<a><strong><?php echo strtoupper($this->session->userdata('nama_pegawai')); ?></strong></a><br>
				<strong><?php echo $this->session->userdata('nama_wilayah'); ?></strong><br>
			</small>
		</h4>
		<hr>
		<div class='col-lg-4'>
			<h4 class='pull-left'><img class='loading_bar loader_potensi' src='<?php echo _IMG_LOADER; ?>loader-lite-red.gif'/> 
				Potensi & Realisasi : 
			</h4>
			<a data-ng-click='getData_potensi();' class='btn btn-xs btn-link pull-right'><span class='glyphicon glyphicon-refresh'></span> Reload</a>
			<div class='clearfix'></div>
			<div class="panel panel-default">
				<div data-ng-if="dataPotensiRealisasi.length==0">
					<div class='empty-row'>
						Mohon Maaf<br>
						Data Potensi & Realisasi Kosong
					</div>
				</div>
			</div>
			<br>
			<h4 class='pull-left'><img class='loading_bar loader_potensi' src='<?php echo _IMG_LOADER; ?>loader-lite-red.gif'/> 
				Kinerja Anda : 
			</h4>
			<a data-ng-click='getData_potensi();' class='btn btn-xs btn-link pull-right'><span class='glyphicon glyphicon-refresh'></span> Reload</a>
			<div class='clearfix'></div>
			<div class="panel panel-default">
				<div data-ng-if="dataPotensiRealisasi.length==0">
					<div class='empty-row'>
						Mohon Maaf<br>
						Data Kinerja Anda Hari Ini Masih Kosong
					</div>
				</div>
			</div>
		</div>
		<div class='col-lg-8'>
			<h4 class='pull-left'><img class='loading_bar loader_pengumuman' src='<?php echo _IMG_LOADER; ?>loader-lite-red.gif'/> 
				Pengumuman : 
			</h4>
			<a data-ng-click='getData_pengumuman();' class='btn btn-xs btn-link pull-right'><span class='glyphicon glyphicon-refresh'></span> Reload</a>
			<div class='clearfix'></div>
				<div class="panel panel-default">
					<div data-ng-if="dataPengumuman.length==0">
						<div class='empty-row'>
							Mohon Maaf<br>
							Tidak Ada Pengumuman Untuk Anda
						</div>
					</div>
					<div data-ng-repeat='v_pengumuman in dataPengumuman'>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel" data-ng-class="($index==0) ? 'panel-primary' : 'panel-info'">
						    <div class="panel-heading" role="tab" id="heading{{$index}}">
						      <h4 class="panel-title">
						      	<span class='btn btn-xs btn-default'><span class='glyphicon glyphicon-search'></span></span> 
						        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$index}}" aria-expanded="true" aria-controls="collapse{{$index}}">
						          {{v_pengumuman.judul_pengumuman}}
						        </a>
						      </h4>
						    </div>
						    <div id="collapse{{$index}}" class="panel-collapse" data-ng-class="($index==0) ? 'in' : 'collapse'" role="tabpanel" aria-labelledby="heading{{$index}}">
						      <div class="panel-body">
						      	<a>Diposting: {{v_pengumuman.tgl_format | fullFormatDate}}, {{v_pengumuman.tgl_insrow}}</a><br><br>
						        {{v_pengumuman.isi_pengumuman | uppercase}}
						      </div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $js; ?>