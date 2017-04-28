<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

function __construct(){
        parent::__construct();
        $this->load->model('model_app');

      if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
       </div>");
        redirect('login');
        }
        
        
    }


 function view()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/order";


        $data['url'] = "order/save";

        $data['dd_meja'] = $this->model_app->dropdown_meja();
		$data['id_meja'] = "";

        $dataproduk_makanan = $this->model_app->dataproduk_makanan();
	    $data['dataproduk_makanan'] = $dataproduk_makanan;

	    $dataproduk_minuman = $this->model_app->dataproduk_minuman();
	    $data['dataproduk_minuman'] = $dataproduk_minuman;
        
        $this->load->view('template', $data);

 }

  function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_kategori', $id);
 	$this->db->delete('order');

 	$this->db->trans_complete();
	
 }


 function save()
 {


 	$getkodepemesanan = $this->model_app->getkodepemesanan();
	$kode_pemesanan = $getkodepemesanan;

    $id_user = trim($this->session->userdata('id_user'));
 	$nama_pemesan = strtoupper(trim($this->input->post('nama_pemesan')));
 	$id_meja = strtoupper(trim($this->input->post('id_meja')));
 	$bayar = strtoupper(trim($this->input->post('bayar')));
 	$status = 1;


 	$id_produk = $this->input->post('id_produk');
 	$qty = $this->input->post('qty');

 	$sql_head = "INSERT INTO pemesanan (id_pemesanan, nama_pemesan, id_meja, bayar, id_pegawai, status)
 				 VALUES ('$kode_pemesanan', '$nama_pemesan', '$id_meja', '$bayar', '$id_user', '$status')";

    $this->db->query($sql_head);


 	for($i = 0; $i<count($id_produk); $i++)
                    :

              if($qty[$i]=='' || $qty[$i]==0 )
              {
              	$sql = "";
              }
              else
              {

	            $sql = "INSERT INTO pemesanan_detail (id_pemesanan, id_produk, qty) VALUES ('$kode_pemesanan', '$id_produk[$i]', '$qty[$i]')";

	            $this->db->query($sql);

               }

               endfor;


    $data['status'] = 1;

    $this->db->where('id_meja', $id_meja);
 	$this->db->update('meja', $data);



 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('order/review');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data  tersimpan.
			    </div>");
				redirect('order/view');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_kategori";


        $sql = "SELECT * FROM order WHERE id_kategori = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "order/update";
			
		$data['id_kategori'] = $id;		
		$data['nama_kategori'] = $row->nama_kategori;
 

        $this->load->view('template', $data);

 }

 function update()
 {

 	$id_kategori = strtoupper(trim($this->input->post('id_kategori')));
 	$nama_kategori = strtoupper(trim($this->input->post('nama_kategori')));

 	$data['nama_kategori'] = $nama_kategori;

 	$this->db->trans_start();

 	$this->db->where('id_kategori', $id_kategori);
 	$this->db->update('order', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('order/kategori_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('order/kategori_list');	
			}

 }


    
}
