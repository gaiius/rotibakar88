<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {

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


 function meja_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/meja";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));

        
        $data['link'] = "meja/hapus";

        $datameja = $this->model_app->datameja();
	    $data['datameja'] = $datameja;
        
        $this->load->view('template', $data);

 }

  function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_meja', $id);
 	$this->db->delete('meja');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_meja";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));


        $data['id_meja'] = "";		
		$data['nama_meja'] = "";

		$data['url'] = "meja/save";
        

        $this->load->view('template', $data);

 }

 function save()
 {

 	$nama_meja = strtoupper(trim($this->input->post('nama_meja')));

 	$data['nama_meja'] = $nama_meja;
 	$data['status'] = 0;

 	$this->db->trans_start();

 	$this->db->insert('meja', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('meja/meja_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data  tersimpan.
			    </div>");
				redirect('meja/meja_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_meja";

       
        $sql = "SELECT * FROM meja WHERE id_meja = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "meja/update";
			
		$data['id_meja'] = $id;		
		$data['nama_meja'] = $row->nama_meja;
 

        $this->load->view('template', $data);

 }

 function update()
 {

 	$id_meja = strtoupper(trim($this->input->post('id_meja')));
 	$nama_meja = strtoupper(trim($this->input->post('nama_meja')));

 	$data['nama_meja'] = $nama_meja;

 	$this->db->trans_start();

 	$this->db->where('id_meja', $id_meja);
 	$this->db->update('meja', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('meja/meja_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('meja/meja_list');	
			}

 }


    
}
