<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller {

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
        $data['body'] = "body/profile";

       
        $id = $this->session->userdata('id_user');

        $sql = 
        "SELECT A.id_pegawai, A.nama_pegawai, A.alamat, A.jk, B.level, B.level, C.nama_jabatan
        FROM pegawai A 
        LEFT JOIN akun B ON B.username = A.id_pegawai 
        LEFT JOIN jabatan C ON C.id_jabatan = A.id_jabatan 
        WHERE A.id_pegawai ='$id'";

        $row = $this->db->query($sql)->row();

        //general
        $data['id_pegawai'] = $row->id_pegawai;
        $data['nama_pegawai'] = $row->nama_pegawai;
        $data['alamat'] = $row->alamat;
        $data['jk'] = $row->jk;

        //info jabatan
        $data['jabatan'] = $row->nama_jabatan;
        $data['level'] = $row->level;
        

	
        $this->load->view('template', $data);
    }

    
}
