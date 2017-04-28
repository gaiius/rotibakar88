      
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


       <tr>
        <td colspan="4" align="right"><b>CASH</b></td>
        
        <td><?php echo $cash;?></td>
      </tr>

      <tr>
        <td colspan="4" align="right"><b>CASHBACK</b></td>
        
        <td><?php echo $cashback;?></td>
      </tr>
</table>

</div>


      <script language="javascript"> 
function printPage(printContent) { 
var display_setting="toolbar=yes,menubar=yes,"; 
display_setting+="scrollbars=yes,width=1150, height=2000, left=100, top=25"; 
var printpage=window.open("","",display_setting); 
printpage.document.open(); 
//printpage.document.write('<html><head><title>Print Page</title></head>'); 
printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>'); 
printpage.document.close(); 
printpage.focus(); 
} 
</script>


<br>
<a href="javascript:void(0);" onClick="printPage(printsection.innerHTML)"><button type="button" class="btn btn-primary">CETAK</button></a>

<a href="<?php echo base_url();?>daftar_order/order_list"><button type="button" class="btn btn-danger">BATAL</button></a>



          </div>
        </div>
      </div>
    </div><!--/.row-->  