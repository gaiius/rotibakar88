      
    
  <script type="text/javascript">

  function Bayar()
  {

    var total_bayar = $("#total_bayar").val() || 0;
    var cash = $("#cash").val() || 0;
    var cashback = $("#cashback").val() || 0;

    

      var transaksi = parseFloat(cash) - parseFloat(total_bayar);

      $("#cashback").val(transaksi);



      }
</script>


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
<a href="#" style="text-decoration:none">Pembayaran</a></div>
          <div class="panel-body">


            <div id="printsection"> 
<style>

.scroll{
  width: 98%;
  background: white;
  padding: 10px;
  margin:0 0 0 0px; 
  overflow: scroll;
  height: 450px;
  font-size: 8px;
  align:center;
}

.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;border-top-width:1px;border-bottom-width:1px;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;border-top-width:1px;border-bottom-width:1px;}
.tg .tg-yw4l{vertical-align:top}
.tg .tg-b7b8{background-color:#f9f9f9;vertical-align:top}

@media print {
    @page {
        size: letter portrait;
        margin: 0cm 0.5cm 0cm 0.5cm;
    }
}

</style>

<h4><b><u><?php echo $nama_resto;?></b></u></h4>
<h5><?php echo $alamat;?></h5>

<table class="tg" width="40%">
  
  <tr>
    <td class="">NO</td>
    <td class=""><?php echo $id_pemesanan;?></td>
  </tr>
  <tr>
    <td class="">NAMA</td>
    <td class=""><?php echo $nama_pemesan;?></td>
  </tr>
</table>

<br>
<table class="tg" width="100%">
  <tr>
    <th class="tg-031e">NO</th>
    <th class="tg-yw4l">NAMA PRODUK</th>
    <th class="tg-yw4l">HARGA</th>
    <th class="tg-yw4l">QTY</th>
    <th class="tg-yw4l">TOTAL BAYAR</th>
  </tr>

  <?php 
    $no = 0; 
    $total_bayar = 0;

foreach($data_detailorder->result() as $row): $no++;
    $total_bayar += $row->harga;
$total_harga = $row->harga * $row->qty;


?>
  <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $row->nama_produk;?></td>
        <td><?php echo $row->harga;?></td>
        <td><?php echo $row->qty;?></td>
        <td><?php echo $total_harga;?></td>
      </tr>

      <?php endforeach;?>

      

      <tr>
        <td colspan="4" style="text-align:right"><b>TOTAL BAYAR</b></td>
        <td><b><?php echo $total_bayar;?></b></td>
      </tr>

<form method="post" action="<?php echo base_url();?>daftar_order/bayar">

      <tr>
        <td colspan="4" align="right"><b>CASH</b></td>
        <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $total_bayar;?>">
        <td><input type="text" name="cash" id="cash" onkeyup="Bayar()"></td>
      </tr>

      <tr>
        <td colspan="4" align="right"><b>CASHBACK</b></td>
        
        <td><input type="text" readonly name="cashback" id="cashback"></td>
      </tr>
</table>

</div>



<br>


   <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?php echo $id_pemesanan;?>">

<button type="submit" id="bayar" class="btn btn-primary">BAYAR</button>

<a href="<?php echo base_url();?>daftar_order/order_list"><button type="button" class="btn btn-danger">BATAL</button></a>

</form>





          </div>
        </div>
      </div>
    </div><!--/.row-->  