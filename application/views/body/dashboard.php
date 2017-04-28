		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Dashboard <?php echo $this->session->userdata('id_jabatan');?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jml_pemesanan;?></div>
							<div class="text-muted">Total Order</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jml_koki;?></div>
							<div class="text-muted">Total Koki</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jml_pelayan;?></div>
							<div class="text-muted">Total Pelayan</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $jml_produk;?></div>
							<div class="text-muted">Total Produk</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
	
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Order Solved</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $jml_order_solved;?>" ><span class="percent"><?php echo ceil($jml_order_solved);?> %</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Order On Process</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $jml_order_process;?>" ><span class="percent"><?php echo ceil($jml_order_process);?> %</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Order Receive</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $jml_order_receive;?>" ><span class="percent"><?php echo ceil($jml_order_receive);?> %</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Order Cancel</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $jml_order_cancel;?>" ><span class="percent"><?php echo ceil($jml_order_cancel);?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->


		<div class="row">



<?php $no = 0; foreach($datameja as $row) : $no++;?>

			<div class="col-xs-3 col-md-3">
				
<?php if($row->status==0){?>
				<div class="panel panel-teal panel-widget">

					<?php } else {?>

					<div class="panel panel-red panel-widget">
<?php }?>
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<b><?php if($row->status==0){ echo "AVAILABE";} else { echo "BOOKED";}?> </b>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $no;?> </div>
							<div class="text-muted"><?php echo $row->nama_meja;?></div>
						</div>
					</div>
				</div>

			</div>

		<?php  endforeach;?>
			


			

		</div><!--/.row-->
								
		
								
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->