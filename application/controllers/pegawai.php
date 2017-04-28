<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

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


 function pegawai_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/pegawai";

        $data['link'] = "pegawai/hapus";

        $datapegawai = $this->model_app->datapegawai();
	    $data['datapegawai'] = $datapegawai;
        
        $this->load->view('template', $data);

 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('nik', $id);
 	$this->db->delete('pegawai');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_pegawai";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));

        
        $data['nip'] = "";		
		$data['nama'] = "";
		$data['alamat'] = "";
		

		$data['dd_jk'] = $this->model_app->dropdown_jk();
		$data['id_jk'] = "";

        $data['dd_aktif'] = $this->model_app->dropdown_aktif();
        $data['id_aktif'] = "";

        $data['dd_jabatan'] = $this->model_app->dropdown_jabatan();
		$data['id_jabatan'] = "";


		$data['url'] = "pegawai/save";

		$data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 function save()
 {

 	$getkodepegawai = $this->model_app->getkodepegawai();
	
	$nip = $getkodepegawai;

 	$nama = strtoupper(trim($this->input->post('nama')));
 	$jk = strtoupper(trim($this->input->post('id_jk')));
 	$alamat = strtoupper(trim($this->input->post('alamat')));
 	$id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));
    $id_aktif = strtoupper(trim($this->input->post('id_aktif')));

 	$data['id_pegawai'] = $nip;
 	$data['nama_pegawai'] = $nama;
 	$data['jk'] = $jk;
 	$data['alamat'] = $alamat;
 	$data['id_jabatan'] = $id_jabatan;

 	$this->db->trans_start();

 	$this->db->insert('pegawai', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('pegawai/pegawai_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('pegawai/pegawai_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_pegawai";

        $sql = "SELECT * FROM pegawai A 
                LEFT JOIN jabatan B ON B.id_jabatan = A.id_jabatan";
		$row = $this->db->query($sql)->row();

		$id_dept = trim($this->session->userdata('id_dept'));
       // $id = trim($this->session->userdata('id_user'));

       

		$data['url'] = "pegawai/update";
			
		$data['nip'] = $id;		
		$data['nama'] = $row->nama_pegawai;
		$data['alamat'] = $row->alamat;

		$data['dd_jk'] = $this->model_app->dropdown_jk();
		$data['id_jk'] = $row->jk;

		$data['dd_jabatan'] = $this->model_app->dropdown_jabatan();
		$data['id_jabatan'] = $row->id_jabatan;

        $data['dd_aktif'] = $this->model_app->dropdown_aktif();
        $data['id_aktif'] = $row->aktif;


		$data['flag'] = "edit";

        $this->load->view('template', $data);

 }

 function update()
 {

 	$nip = strtoupper(trim($this->input->post('nip')));

 	$nama = strtoupper(trim($this->input->post('nama')));
 	$jk = strtoupper(trim($this->input->post('id_jk')));
 	$alamat = strtoupper(trim($this->input->post('alamat')));
 	$id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));
    $aktif = strtoupper(trim($this->input->post('id_aktif')));
 	
 	
 	$data['nama_pegawai'] = $nama;
 	$data['jk'] = $jk;
 	$data['alamat'] = $alamat;
 	$data['id_jabatan'] = $id_jabatan;
    $data['aktif'] = $aktif;

 	$this->db->trans_start();

 	$this->db->where('id_pegawai', $nip);
 	$this->db->update('pegawai', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('pegawai/pegawai_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('pegawai/pegawai_list');	
			}

 }


    
}
