<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

function __construct(){
        parent::__construct();
        $this->load->model('model_app');

      /*  if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
       </div>");
        redirect('login');
        }
        */
        
    }


 function kategori_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/kategori";

        $data['link'] = "kategori/hapus";

        $datakategori = $this->model_app->datakategori();
	    $data['datakategori'] = $datakategori;
        
        $this->load->view('template', $data);

 }

  function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_kategori', $id);
 	$this->db->delete('kategori');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_kategori";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));


        $data['id_kategori'] = "";		
		$data['nama_kategori'] = "";

		$data['url'] = "kategori/save";
        

        $this->load->view('template', $data);

 }

 function save()
 {

 	$nama_kategori = strtoupper(trim($this->input->post('nama_kategori')));

 	$data['nama_kategori'] = $nama_kategori;

 	$this->db->trans_start();

 	$this->db->insert('kategori', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('kategori/kategori_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data  tersimpan.
			    </div>");
				redirect('kategori/kategori_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_kategori";


        $sql = "SELECT * FROM kategori WHERE id_kategori = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "kategori/update";
			
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
 	$this->db->update('kategori', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('kategori/kategori_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('kategori/kategori_list');	
			}

 }


    
}
