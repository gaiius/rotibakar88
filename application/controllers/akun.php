<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

function __construct(){
        parent::__construct();
        $this->load->model('model_app');

      /*  if(!$this->session->userdata('id_akun'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
       </div>");
        redirect('login');
        }
        */
        
    }


 function akun_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/akun";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_akun'));

        $data['link'] = "akun/hapus";

        $dataakun = $this->model_app->dataakun();
	    $data['dataakun'] = $dataakun;
        
        $this->load->view('template', $data);

 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_akun', $id);
 	$this->db->delete('akun');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_akun";

        $data['dd_pegawai'] = $this->model_app->dropdown_pegawai();
		$data['id_pegawai'] = "";

		$data['dd_level'] = $this->model_app->dropdown_level();
		$data['id_level'] = "";

		$data['password'] = "";
		$data['id_akun'] = "";

		$data['url'] = "akun/save";

		$data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 function save()
 {

 	$getkodeakun = $this->model_app->getkodeakun();
	
	$id_akun = $getkodeakun;

 	$id_pegawai = strtoupper(trim($this->input->post('id_pegawai')));
 	$password = strtoupper(trim($this->input->post('password')));
 	$id_level = strtoupper(trim($this->input->post('id_level')));


 	$data['id_akun'] = $id_akun;
 	$data['username'] = $id_pegawai;
 	$data['password'] = md5($password);
 	$data['level'] = $id_level;
 	

 	$this->db->trans_start();

 	$this->db->insert('akun', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('akun/akun_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('akun/akun_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_akun";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_akun'));

        $sql = "SELECT * FROM akun WHERE id_akun = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "akun/update";
			
		$data['dd_karyawan'] = $this->model_app->dropdown_karyawan();
		$data['id_karyawan'] = "";

		$data['dd_level'] = $this->model_app->dropdown_level();
		$data['id_level'] = $row->level;

		$data['password'] = "";
		$data['id_akun'] = $row->id_akun;

		$data['flag'] = "edit";

        $this->load->view('template', $data);

 }

 function update()
 {

 	$id_akun = strtoupper(trim($this->input->post('id_akun')));


 	$id_level = strtoupper(trim($this->input->post('id_level')));
 	$data['level'] = $id_level;
 

 	$this->db->trans_start();

 	$this->db->where('id_akun', $id_akun);
 	$this->db->update('akun', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('akun/akun_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('akun/akun_list');	
			}

 }


    
}
