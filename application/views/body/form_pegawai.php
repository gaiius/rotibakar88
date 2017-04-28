	
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Data Pegawai</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="#" style="text-decoration:none">Tambah Pegawai</a></div>
					<div class="panel-body">
						
					<div class="col-md-6">
					<form method="post" action="<?php echo base_url();?><?php echo $url;?>">

					<input type="hidden" class="form-control" name="nip" value="<?php echo $nip;?>">

					<div class="form-group">
						<label>Nama</label>
						<input class="form-control" name="nama" placeholder="Nama" value="<?php echo $nama;?>" required>
					</div>

					<div class="form-group">
						<label>Jenis Kelamin</label>
						<?php echo form_dropdown('id_jk',$dd_jk, $id_jk, ' id="id_jk" required class="form-control"');?>
					</div>

					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="form-control" required><?php echo $alamat;?></textarea>
					</div>


					<div class="form-group">
						<label>Jabatan</label>
						<?php echo form_dropdown('id_jabatan',$dd_jabatan, $id_jabatan, 'required class="form-control"');?>
					</div>

					<div class="form-group">
						<label>Aktif</label>
						<?php echo form_dropdown('id_aktif',$dd_aktif, $id_aktif, 'required class="form-control"');?>
					</div>

					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?php echo base_url();?>pegawai/pegawai_list"  class="btn btn-default">Batal</a>
				    </div>

				     </form>


					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
