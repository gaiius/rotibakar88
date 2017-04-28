<div class="row">
<ol class="breadcrumb">
<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
<li class="active">My Profile</li>
</ol>
</div><!--/.row-->

<br>


<div class="row">

<div class="col-lg-12">
<div class="panel panel-default">

<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="<?php echo base_url();?>profile_resto/edit" style="text-decoration:none">Edit</a></div>
<div class="panel-body">

<div class="list-group">
<a href="<?php echo base_url();?>profile_resto/edit" class="list-group-item active">
  PROFILE RESTO
</a>

<form method="post" action="<?php echo base_url();?><?php echo $url;?>">

<a href="#" class="list-group-item">&nbsp;<input type="text" class="form-control" name="nama_resto" value="<?php echo $nama_resto;?>"></a>
<a href="#" class="list-group-item">&nbsp;<textarea name="alamat" class="form-control"><?php echo $alamat;?></textarea></a>
<a href="#" class="list-group-item">&nbsp;<textarea name="tentang" class="form-control"><?php echo $tentang;?></textarea></a>
<a href="#" class="list-group-item">&nbsp;<input type="text" class="form-control" name="nama_pemilik" value="<?php echo $nama_pemilik;?>"></a>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="<?php echo base_url();?>profile_resto/view"  class="btn btn-default">Batal</a>

</form>

</div>




</div>
</div>

</div><!--/.row-->	


