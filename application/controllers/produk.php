<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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


 function produk_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/produk";


        $data['link'] = "produk/hapus";

        $dataproduk = $this->model_app->dataproduk();
	    $data['dataproduk'] = $dataproduk;
        
        $this->load->view('template', $data);

 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('nik', $id);
 	$this->db->delete('produk');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_produk";

     
        $data['id_produk'] = "";		
		$data['nama_produk'] = "";
		$data['harga'] = "";
		
        $data['dd_aktif'] = $this->model_app->dropdown_aktif();
        $data['id_aktif'] = "";

        $data['dd_kategori'] = $this->model_app->dropdown_kategori();
		$data['id_kategori'] = "";


		$data['url'] = "produk/save";

		$data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 function save()
 {

 	$getkodeproduk = $this->model_app->getkodeproduk();
	
	$id_produk = $getkodeproduk;

 	$nama_produk = strtoupper(trim($this->input->post('nama_produk')));
 	$harga = strtoupper(trim($this->input->post('harga')));
 	$id_kategori = strtoupper(trim($this->input->post('id_kategori')));
    $id_aktif = strtoupper(trim($this->input->post('id_aktif')));

 	$data['id_produk'] = $id_produk;
 	$data['nama_produk'] = $nama_produk;
 	$data['harga'] = $harga;
 	$data['id_kategori'] = $id_kategori;
 	$data['aktif'] = $id_aktif;

 	$this->db->trans_start();

 	$this->db->insert('produk', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('produk/produk_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('produk/produk_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_produk";

        $sql = "SELECT * FROM produk A 
                LEFT JOIN kategori B ON B.id_kategori = A.id_kategori WHERE id_produk ='$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "produk/update";
			
		$data['id_produk'] = $row->id_produk;	
		$data['nama_produk'] = $row->nama_produk;
		$data['harga'] = $row->harga;
		
        $data['dd_aktif'] = $this->model_app->dropdown_aktif();
        $data['id_aktif'] = $row->aktif;

        $data['dd_kategori'] = $this->model_app->dropdown_kategori();
		$data['id_kategori'] = $row->id_kategori;

		$data['flag'] = "edit";

        $this->load->view('template', $data);

 }

 function update()
 {

 	$id_produk = strtoupper(trim($this->input->post('id_produk')));
 	$nama_produk = strtoupper(trim($this->input->post('nama_produk')));
 	$harga = strtoupper(trim($this->input->post('harga')));
 	$id_kategori = strtoupper(trim($this->input->post('id_kategori')));
    $id_aktif = strtoupper(trim($this->input->post('id_aktif')));

 	
 	$data['nama_produk'] = $nama_produk;
 	$data['harga'] = $harga;
 	$data['id_kategori'] = $id_kategori;
 	$data['aktif'] = $id_aktif;


 	$this->db->trans_start();

 	$this->db->where('id_produk', $id_produk);
 	$this->db->update('produk', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('produk/produk_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('produk/produk_list');	
			}

 }


    
}
