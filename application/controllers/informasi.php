<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

function __construct(){
        parent::__construct();
        $this->load->model('model_app');

       /*if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
       </div>");
        redirect('login');
        }*/
        
    }


 function informasi_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/informasi";

         $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));

        $data['link'] = "informasi/hapus";
        
        $datainformasi = $this->model_app->datainformasi();
	    $data['datainformasi'] = $datainformasi;
        
        $this->load->view('template', $data);

 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_informasi', $id);
 	$this->db->delete('informasi');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_informasi";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));

        $data['id_informasi'] ="";
        $data['subject'] ="";
        $data['pesan'] ="";


        $data['url'] = "informasi/save";
       
        $this->load->view('template', $data);

 }

  

 function save()
 {
 	$id_user = trim($this->session->userdata('id_user'));
 	$subject = strtoupper(trim($this->input->post('subject')));
 	$pesan = strtoupper(trim($this->input->post('pesan')));
 	$tanggal = $time = date("Y-m-d  H:i:s");

 	$data['subject'] = $subject;
 	$data['pesan'] = $pesan;
 	$data['id_pegawai'] = $id_user;
 	$data['tanggal'] = $tanggal;
 	$data['aktif'] = 1;

 	$this->db->trans_start();

 	$this->db->insert('informasi', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('informasi/informasi_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data  tersimpan.
			    </div>");
				redirect('informasi/informasi_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_informasi";

    
        $sql = "SELECT * FROM informasi WHERE id_informasi = '$id'";
		$row = $this->db->query($sql)->row();

		$data['id_informasi'] = $row->id_informasi;
        $data['subject'] = $row->subject;
        $data['pesan'] = $row->pesan;

		$data['url'] = "informasi/update";
		 

        $this->load->view('template', $data);

 }

 function update()
 {
 	$id_informasi = strtoupper(trim($this->input->post('id_informasi')));

 	$id_user = trim($this->session->userdata('id_user'));
 	$subject = strtoupper(trim($this->input->post('subject')));
 	$pesan = strtoupper(trim($this->input->post('pesan')));
 	$tanggal = $time = date("Y-m-d  H:i:s");

 	$data['subject'] = $subject;
 	$data['pesan'] = $pesan;
 	$data['id_pegawai'] = $id_user;
 	$data['tanggal'] = $tanggal;

 	$this->db->trans_start();

 	$this->db->where('id_informasi', $id_informasi);
 	$this->db->update('informasi', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('informasi/informasi_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('informasi/informasi_list');	
			}

 }


    
}
