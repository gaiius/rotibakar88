			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Order List</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="#" style="text-decoration:none">Order List</a></div>
					<div class="panel-body">




						<table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true"  data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="no" data-sortable="true" width="10px"> No</th>
						        <th data-field="id" data-sortable="true">Id Pemesanan</th>
						        <th data-field="id2" data-sortable="true">Nama Pemesan</th>
						        <th data-field="id3" data-sortable="true">Meja</th>
						        <th data-field="id4" data-sortable="true">Bayar</th>
						        <th data-field="id5" data-sortable="true">Status</th>
						        <th data-field="id5d" data-sortable="true">Konfirmasi</th>
						        <th>Aksi</th>
						    </tr>
                            </thead>
                            <tbody>
                           <?php $no = 0; foreach($dataorder as $row) : $no++;?>
						     <tr>
						        <td data-field="no" width="10px"><?php echo $no;?></td>
						        <td data-field="id1"><a href="<?php echo base_url();?>daftar_order/view_detail/<?php echo $row->id_pemesanan;?>"><?php echo $row->id_pemesanan;?></a></td>
						        <td data-field="id2"><?php echo $row->nama_pemesan;?></td>
						        <td data-field="id3"><?php echo $row->nama_meja;?></td>
						        <td data-field="id4"><?php echo $row->bayar;?></td>
						        <td><?php
						        if($row->STATUS_PESAN==1)
						        { echo "PROSES MASAK";}
						    	else if($row->STATUS_PESAN=='2'){ echo "SUDAH DISAJIKAN"; }
						    	else if($row->STATUS_PESAN==0){echo "BATAL PEMESANAN";}else{echo "SUDAH DIBAYAR";}
						        ;?></td>
						        <td data-field="33" align="center">
						        	<?php if($row->STATUS_PESAN==1)
						        {?>
<a href="<?php echo base_url();?>daftar_order/antar/<?php echo $row->id_pemesanan;?>"><button type="button" class="btn btn-warning btn-sm">ANTAR PESANAN</button></a>
<?php }else if($row->STATUS_PESAN==2){?>
<a href="<?php echo base_url();?>daftar_order/trans_bayar/<?php echo $row->id_pemesanan;?>"><button type="button" class="btn btn-success btn-sm">PEMBAYARAN</button></a>
<?php }else  if($row->STATUS_PESAN==0){}else{?>	
<a href="<?php echo base_url();?>daftar_order/view_detail/<?php echo $row->id_pemesanan;?>"><button type="button" class="btn btn-primary btn-sm">SUDAH BAYAR</button></a>
<?php }?>
</td>

						         <td data-field="iwd5"> 

<?php if($row->STATUS_PESAN==3)
						        {}else{?>

<?php if($row->STATUS_PESAN==0)
{
	?>

	<a data-toggle="modal"  title="Hapus Pemesanan" class="hapus btn btn-danger btn-xs" href="#modKonfirmasi" data-id="<?php echo $row->id_pemesanan;?>"><span class="glyphicon glyphicon-trash"></span></a>
	
<?php }else {?>
<a  title="Batal Pemesanan" class="hapus btn btn-danger btn-xs" href="<?php echo base_url();?>daftar_order/batal/<?php echo $row->id_pemesanan;?>"><span class="glyphicon glyphicon-ban-circle"></span></a>
<?php }?><a class="ubah btn btn-primary btn-xs" href="<?php echo base_url();?>daftar_order/edit/<?php echo $row->id_pemesanan;?>"><span class="glyphicon glyphicon-edit" ></span></a>
<?php }?>
</td>

						    </tr>
						    <?php endforeach;?>
						    </tbody>
						    
						</table>


					</div>

		


					</div>
				</div>
			</div>
		</div><!--/.row-->	

		

	
						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>


<?php $this->load->view('konfirmasi');?>

<script type="text/javascript">
$(document).ready(function(){

$(".hapus").click(function(){
var id = $(this).data('id');

$(".modal-body #mod").text(id);

});

});
</script>





					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
