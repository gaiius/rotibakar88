	
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Data Produk</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="#" style="text-decoration:none">Tambah Produk</a></div>
					<div class="panel-body">
						
					<div class="col-md-6">
					<form method="post" action="<?php echo base_url();?><?php echo $url;?>">

					<input type="hidden" class="form-control" name="id_produk" value="<?php echo $id_produk;?>">

					<div class="form-group">
						<label>Nama Produk</label>
						<input class="form-control" name="nama_produk" value="<?php echo $nama_produk;?>" required>
					</div>

					<div class="form-group">
						<label>Kategori</label>
						<?php echo form_dropdown('id_kategori',$dd_kategori, $id_kategori, ' id="id_kategori" required class="form-control"');?>
					</div>

					<div class="form-group">
						<label>Harga</label>
						<input class="form-control" name="harga"  value="<?php echo $harga;?>" required>
					</div>


					<div class="form-group">
						<label>Aktif</label>
						<?php echo form_dropdown('id_aktif',$dd_aktif, $id_aktif, 'required class="form-control"');?>
					</div>

					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?php echo base_url();?>produk/produk_list"  class="btn btn-default">Batal</a>
				    </div>

				     </form>


					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
